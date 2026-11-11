<?php

namespace App\Services;

use App\Models\AttemptAnswer;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestAttempt;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TestService
{
    public function startAttempt(User $user, string $type): TestAttempt
    {
        $test = Test::query()->where('type', $type)->firstOrFail();
        abort_unless($test->is_open && $test->questions()->count() > 0, 403, 'Tes belum dibuka atau belum memiliki pertanyaan.');

        $attempt = $user->testAttempts()->where('test_id', $test->id)->whereNull('submitted_at')->latest('id')->first();

        if ($attempt !== null) {
            return $attempt->load(['answers', 'test.questions']);
        }

        $completedAttempts = $user->testAttempts()->where('test_id', $test->id)->whereNotNull('submitted_at')->count();
        if ($completedAttempts >= $test->max_attempts) {
            return $user->testAttempts()
                ->where('test_id', $test->id)
                ->whereNotNull('submitted_at')
                ->latest('id')
                ->firstOrFail()
                ->load(['answers', 'test.questions']);
        }

        $profile = $user->studentProfile;

        return $user->testAttempts()->create([
            'test_id' => $test->id,
            'started_at' => now(),
            'kelas' => $profile?->kelas,
            'usia' => $profile?->usia,
        ])->load(['answers', 'test.questions']);
    }

    public function saveAnswer(TestAttempt $attempt, Question $question, int $answerValue): AttemptAnswer
    {
        return DB::transaction(function () use ($attempt, $question, $answerValue): AttemptAnswer {
            $lockedAttempt = TestAttempt::query()->with('test')->lockForUpdate()->findOrFail($attempt->id);
            abort_if($lockedAttempt->submitted_at !== null, 409, 'Tes ini sudah dikirim.');
            abort_unless($lockedAttempt->test->is_open, 403, 'Tes telah ditutup.');
            abort_unless($lockedAttempt->test->questions()->whereKey($question->id)->exists(), 404);
            abort_unless($answerValue >= 1 && $answerValue <= 4, 422, 'Nilai jawaban harus antara 1 dan 4.');

            $score = $question->is_unfavorable ? 5 - $answerValue : $answerValue;

            return $lockedAttempt->answers()->updateOrCreate(
                ['question_id' => $question->id],
                ['answer_value' => $answerValue, 'score' => $score],
            );
        });
    }

    public function submit(TestAttempt $attempt): TestAttempt
    {
        return DB::transaction(function () use ($attempt): TestAttempt {
            $lockedAttempt = TestAttempt::query()->with('test')->lockForUpdate()->findOrFail($attempt->id);
            abort_if($lockedAttempt->submitted_at !== null, 409, 'Tes ini sudah dikirim.');
            abort_unless($lockedAttempt->test->is_open, 403, 'Tes telah ditutup.');

            $expectedCount = $lockedAttempt->test->questions()->count();
            $answers = $lockedAttempt->answers()->lockForUpdate()->get();
            abort_if($expectedCount === 0, 403, 'Tes belum memiliki pertanyaan.');
            if ($answers->count() !== $expectedCount) {
                throw ValidationException::withMessages([
                    'answers' => 'Jawab semua pertanyaan sebelum mengirim tes.',
                ]);
            }

            $lockedAttempt->forceFill([
                'total_score' => $answers->sum('score'),
                'submitted_at' => now(),
            ])->save();

            return $lockedAttempt->refresh();
        });
    }
}
