<?php

namespace App\Exports;

use App\Models\Question;
use App\Models\TestAttempt;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class RawAnswersExport implements FromCollection, WithHeadings, WithTitle
{
    private Collection $questions;

    public function __construct(private string $testType)
    {
        $this->questions = Question::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    public function collection(): Collection
    {
        $attempts = TestAttempt::query()
            ->with(['user.studentProfile', 'answers.question'])
            ->whereHas('test', fn ($query) => $query->where('type', $this->testType))
            ->whereNotNull('submitted_at')
            ->orderByDesc('submitted_at')
            ->get();

        $valueLabels = [
            4 => '4 (SS)',
            3 => '3 (S)',
            2 => '2 (TS)',
            1 => '1 (STS)',
        ];

        return $attempts->map(function (TestAttempt $attempt) use ($valueLabels): array {
            $answersByQuestion = $attempt->answers->keyBy('question_id');

            $row = [
                $attempt->user->name,
                $attempt->user->studentProfile?->inisial ?? '—',
                $attempt->user->studentProfile?->kelas ?? $attempt->kelas ?? '—',
                $attempt->user->studentProfile?->usia ?? $attempt->usia ?? '—',
                $attempt->submitted_at?->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') ?? '—',
            ];

            foreach ($this->questions as $question) {
                $answer = $answersByQuestion->get($question->id);
                $row[] = $answer ? ($valueLabels[$answer->answer_value] ?? (string) $answer->answer_value) : '—';
            }

            return $row;
        });
    }

    public function headings(): array
    {
        $headings = [
            'Nama Siswi',
            'Inisial',
            'Kelas',
            'Usia',
            'Waktu Selesai',
        ];

        foreach ($this->questions as $index => $question) {
            $itemNum = $index + 1;
            $headings[] = "Q{$itemNum}: ".Str::limit($question->question_text, 35);
        }

        return $headings;
    }

    public function title(): string
    {
        return ucfirst($this->testType);
    }
}
