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

class QuestionController extends Controller
{
    private const ASPECTS = ['kognitif', 'afektif', 'konatif'];

    public function index(): View
    {
        return view('admin.questions', [
            'questions' => Question::query()->withCount('attemptAnswers')->orderBy('sort_order')->orderBy('id')->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.question-form', [
            'question' => new Question,
            'aspects' => self::ASPECTS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge(['question_text' => is_string($request->input('question_text'))
            ? trim($request->input('question_text'))
            : $request->input('question_text')]);

        $validated = $request->validate([
            'question_text' => ['required', 'string', 'max:1000', 'regex:/\?$/u'],
            'aspect' => ['nullable', Rule::in(self::ASPECTS)],
            'is_unfavorable' => ['nullable', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
        ], [
            'question_text.regex' => 'Tuliskan butir sebagai pertanyaan dan akhiri dengan tanda tanya.',
        ]);

        DB::transaction(function () use ($validated): void {
            $question = Question::query()->create([
                ...$validated,
                'is_unfavorable' => (bool) ($validated['is_unfavorable'] ?? false),
            ]);

            foreach (['pretest', 'posttest'] as $type) {
                $test = Test::query()->where('type', $type)->firstOrFail();
                $test->questions()->attach($question->id, [
                    'sort_order' => $test->questions()->count() + 1,
                ]);
            }
        });

        return redirect()->route('admin.questions')->with('status', 'Pertanyaan berhasil ditambahkan ke pretest dan posttest.');
    }

    public function edit(Question $question): View
    {
        $question->loadCount('attemptAnswers');

        return view('admin.question-form', [
            'question' => $question,
            'aspects' => self::ASPECTS,
        ]);
    }

    public function update(Request $request, Question $question): RedirectResponse
    {
        $request->merge(['question_text' => is_string($request->input('question_text'))
            ? trim($request->input('question_text'))
            : $request->input('question_text')]);

        $rules = [
            'question_text' => ['required', 'string', 'max:1000', 'regex:/\?$/u'],
            'aspect' => ['nullable', Rule::in(self::ASPECTS)],
            'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
        ];

        if (! $question->attemptAnswers()->exists()) {
            $rules['is_unfavorable'] = ['nullable', 'boolean'];
        }

        $validated = $request->validate($rules, [
            'question_text.regex' => 'Tuliskan butir sebagai pertanyaan dan akhiri dengan tanda tanya.',
        ]);

        if (! $question->attemptAnswers()->exists()) {
            $validated['is_unfavorable'] = (bool) ($validated['is_unfavorable'] ?? false);
        }

        $question->update($validated);

        return redirect()->route('admin.questions')->with('status', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(Question $question): RedirectResponse
    {
        if ($question->attemptAnswers()->exists()) {
            return back()->withErrors([
                'question' => 'Pertanyaan yang sudah dijawab tidak dapat dihapus.',
            ]);
        }

        $question->delete();

        return redirect()->route('admin.questions')->with('status', 'Pertanyaan berhasil dihapus.');
    }
}
