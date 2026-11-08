<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TestSettingController extends Controller
{
    public function index(): View
    {
        return view('admin.test-settings', [
            'tests' => Test::query()->withCount('questions')->orderBy('type')->get(),
            'questions' => Question::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function update(string $type, Request $request): RedirectResponse
    {
        abort_unless(in_array($type, ['pretest', 'posttest'], true), 404);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'instructions' => ['nullable', 'string', 'max:5000'],
            'max_attempts' => ['required', 'integer', 'between:1,10'],
            'attitude_threshold' => ['nullable', 'integer', 'between:30,120'],
            'is_open' => ['nullable', 'boolean'],
            'question_ids' => ['nullable', 'array'],
            'question_ids.*' => ['required', 'integer', 'distinct', Rule::exists('questions', 'id')],
        ]);

        $test = Test::query()->where('type', $type)->firstOrFail();
        $questionIds = array_map('intval', $validated['question_ids'] ?? []);

        if (($validated['is_open'] ?? false) && count($questionIds) <= 30) {
            return back()->withErrors([
                'question_ids' => 'Tes hanya dapat dibuka jika memiliki lebih dari 30 pertanyaan.',
            ])->withInput();
        }

        if ($test->attempts()->whereHas('answers')->exists()) {
            $currentQuestionIds = $test->questions()->pluck('questions.id')->map(fn ($id): int => (int) $id)->all();
            sort($currentQuestionIds);
            $submittedQuestionIds = $questionIds;
            sort($submittedQuestionIds);

            if ($currentQuestionIds !== $submittedQuestionIds) {
                return back()->withErrors([
                    'question_ids' => 'Daftar pertanyaan tidak dapat diubah setelah siswi mengirim jawaban.',
                ])->withInput();
            }
        }

        DB::transaction(function () use ($test, $validated, $questionIds): void {
            $test->update([
                'title' => $validated['title'],
                'instructions' => $validated['instructions'] ?? null,
                'max_attempts' => $validated['max_attempts'],
                'attitude_threshold' => $validated['attitude_threshold'] ?? null,
                'is_open' => (bool) ($validated['is_open'] ?? false),
            ]);

            $test->questions()->sync(collect($questionIds)
                ->mapWithKeys(fn (int $questionId, int $index): array => [
                    $questionId => ['sort_order' => $index + 1],
                ])->all());
        });

        return redirect()->route('admin.tests')->with('status', 'Pengaturan tes berhasil disimpan.');
    }
}
