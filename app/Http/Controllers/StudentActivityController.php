<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestAttempt;
use App\Models\Video;
use App\Services\ActivityLogger;
use App\Services\ProgressService;
use App\Services\TestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class StudentActivityController extends Controller
{
    public function locked(Request $request): View
    {
        $aliran = $request->query('aliran');
        $reason = in_array($aliran, ['pretest', 'progres'], true) ? $aliran : 'pretest';

        return view('student.locked', [
            'reason' => $reason,
        ]);
    }

    public function results(Request $request, ProgressService $progressService): View
    {
        $attempts = $request->user()->testAttempts()
            ->with('test')
            ->whereNotNull('submitted_at')
            ->latest('submitted_at')
            ->get()
            ->groupBy(fn (TestAttempt $attempt): string => $attempt->test->type)
            ->map(fn ($userAttempts): TestAttempt => $userAttempts->first());

        $pretestAttempt = $attempts->get('pretest');
        $posttestAttempt = $attempts->get('posttest');

        return view('student.results', [
            'attempts' => $attempts,
            'progressPercent' => $progressService->percentage($request->user()),
            'pretestAttempt' => $pretestAttempt,
            'posttestAttempt' => $posttestAttempt,
            'scoreDelta' => ($pretestAttempt && $posttestAttempt)
                ? ((int) $posttestAttempt->total_score - (int) $pretestAttempt->total_score)
                : null,
            'attitudeCategory' => $this->attitudeCategory($posttestAttempt),
        ]);
    }

    private function attitudeCategory(?TestAttempt $attempt): string
    {
        if ($attempt === null) {
            return 'belum_selesai';
        }

        if ($attempt->test?->attitude_threshold === null) {
            return 'belum_ditetapkan';
        }

        return ((int) $attempt->total_score >= (int) $attempt->test->attitude_threshold) ? 'mampu' : 'belum_mampu';
    }

    public function videos(Request $request): View
    {
        return view('student.video', [
            'videos' => Video::query()
                ->where('is_published', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get(),
            'playedVideoIds' => $request->user()->learningProgress()
                ->where('content_type', 'video')
                ->whereNotNull('played_at')
                ->pluck('content_id')
                ->map(fn ($id): int => (int) $id)
                ->all(),
        ]);
    }

    public function showTest(string $testType, Request $request, ActivityLogger $logger, TestService $testService): View
    {
        abort_unless(in_array($testType, ['pretest', 'posttest'], true), 404);

        $attempt = $testService->startAttempt($request->user(), $testType);
        $quizType = $attempt->test->title;
        $logger->log('mulai_tes', $request->user(), $quizType, $attempt);

        return view('student.quiz', [
            'quizType' => $quizType,
            'test' => $attempt->test,
            'attempt' => $attempt,
            'answers' => $attempt->answers->keyBy('question_id'),
        ]);
    }

    public function saveAnswer(string $testType, Request $request, TestService $testService): JsonResponse
    {
        abort_unless(in_array($testType, ['pretest', 'posttest'], true), 404);

        $validated = $request->validate([
            'question_id' => ['required', 'integer', 'exists:questions,id'],
            'answer_value' => ['required', 'integer', 'between:1,4'],
        ]);
        $attempt = $request->user()->testAttempts()
            ->whereHas('test', fn ($query) => $query->where('type', $testType))
            ->latest('id')
            ->firstOrFail();
        abort_if($attempt->submitted_at !== null, 409, 'Tes ini sudah dikirim.');
        $answer = $testService->saveAnswer(
            $attempt,
            Question::query()->findOrFail($validated['question_id']),
            (int) $validated['answer_value'],
        );

        return response()->json([
            'saved' => true,
            'question_id' => $answer->question_id,
            'answer_value' => $answer->answer_value,
        ]);
    }

    public function completeTest(string $testType, Request $request, ActivityLogger $logger, TestService $testService, ProgressService $progressService): RedirectResponse
    {
        abort_unless(in_array($testType, ['pretest', 'posttest'], true), 404);
        $test = Test::query()->where('type', $testType)->firstOrFail();
        abort_unless($test->is_open && $test->questions()->count() > 30, 403, 'Tes belum dibuka atau belum memiliki jumlah pertanyaan yang cukup.');
        if ($testType === 'posttest') {
            $hasCompletedPretest = $request->user()->testAttempts()
                ->whereHas('test', fn ($query) => $query->where('type', 'pretest'))
                ->whereNotNull('submitted_at')
                ->exists();
            abort_unless($hasCompletedPretest && $progressService->percentage($request->user()) === 100, 403, 'Selesaikan pretest, seluruh materi, dan video sebelum mengirim posttest.');
        }

        $attempt = $request->user()->testAttempts()
            ->whereHas('test', fn ($query) => $query->where('type', $testType))
            ->whereNull('submitted_at')
            ->latest('id')
            ->firstOrFail();
        $submittedAttempt = $testService->submit($attempt);
        $logger->log('selesai_tes', $request->user(), $submittedAttempt->test->title, $submittedAttempt);

        return redirect()->route('student.results')->with('status', 'Jawaban tes berhasil disimpan.');
    }

    public function recordVideoPlayback(Request $request, ActivityLogger $logger, ProgressService $progressService): Response
    {
        $validated = $request->validate([
            'video_id' => ['required', 'integer', 'exists:videos,id'],
        ]);
        $video = Video::query()->findOrFail($validated['video_id']);
        abort_unless($video->is_published, 404);
        $progressService->markVideoPlayed($request->user(), $video);
        $logger->log('putar_video', $request->user(), $video->title, $video);

        return response()->noContent();
    }

    public function completeLesson(Material $material, Request $request, ProgressService $progressService): Response
    {
        abort_unless($material->is_published, 404);
        $request->validate(['completed' => ['required', 'accepted']]);
        $progressService->markCompleted($request->user(), $material);

        return response()->noContent();
    }
}
