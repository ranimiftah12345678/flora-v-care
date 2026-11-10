<?php

namespace App\Http\Controllers\Admin;

use App\Exports\QuestionsExport;
use App\Exports\StudentReportExport;
use App\Http\Controllers\Controller;
use App\Imports\QuestionsImport;
use App\Imports\StudentsImport;
use App\Models\AttemptAnswer;
use App\Models\User;
use App\Services\ActivityLogger;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $rows = $this->pairedRows($request);

        return view('admin.reports', [
            'rows' => $rows,
            'classSummaries' => $rows->groupBy('kelas')->map(fn (Collection $classRows): array => [
                'count' => $classRows->count(),
                'pretest' => round($classRows->avg('pretest'), 2),
                'posttest' => round($classRows->avg('posttest'), 2),
            ]),
        ]);
    }

    public function pairedResults(Request $request): View
    {
        $rows = $this->pairedRows($request);
        $attemptIds = $rows->flatMap(fn (array $row): array => [$row['pretest_attempt_id'], $row['posttest_attempt_id']])->all();
        $answers = $attemptIds === []
            ? collect()
            : AttemptAnswer::query()->with(['question', 'attempt.test'])->whereIn('attempt_id', $attemptIds)->get();
        $itemAnalysis = $answers->groupBy(fn (AttemptAnswer $answer): string => $answer->attempt->test->type.':'.$answer->question_id)
            ->map(function (Collection $questionAnswers): array {
                $first = $questionAnswers->first();

                return [
                    'question' => $first->question,
                    'type' => $first->attempt->test->type,
                    'count' => $questionAnswers->count(),
                    'average' => round($questionAnswers->avg('score'), 2),
                ];
            })
            ->values()
            ->groupBy(fn (array $item): int => $item['question']->id)
            ->map(function (Collection $versions): array {
                $question = $versions->first()['question'];

                return [
                    'question' => $question,
                    'pretest' => $versions->firstWhere('type', 'pretest')['average'] ?? null,
                    'posttest' => $versions->firstWhere('type', 'posttest')['average'] ?? null,
                    'responses' => $versions->sum('count'),
                ];
            })
            ->values();

        return view('admin.paired-results', [
            'rows' => $rows,
            'itemAnalysis' => $itemAnalysis,
            'wilcoxon' => $this->wilcoxon($rows),
            'meanPretest' => $rows->isEmpty() ? null : round($rows->avg('pretest'), 2),
            'meanPosttest' => $rows->isEmpty() ? null : round($rows->avg('posttest'), 2),
            'meanDifference' => $rows->isEmpty() ? null : round($rows->avg('difference'), 2),
        ]);
    }

    public function exportExcel(Request $request): BinaryFileResponse
    {
        $rows = $this->pairedRows($request);

        return Excel::download(new StudentReportExport($rows), 'hasil-tes-berpasangan.xlsx');
    }

    public function exportPdf(Request $request): Response
    {
        $rows = $this->pairedRows($request);
        $wilcoxon = $this->wilcoxon($rows);

        return Pdf::loadView('admin.report-pdf', compact('rows', 'wilcoxon'))->download('laporan-hasil-tes.pdf');
    }

    public function exportQuestions(): BinaryFileResponse
    {
        $rows = AttemptAnswer::query()
            ->with('question')
            ->whereHas('attempt', fn (Builder $query) => $query->whereNotNull('submitted_at'))
            ->get()
            ->groupBy('question_id')
            ->map(function (Collection $answers): array {
                $question = $answers->first()->question;

                return [
                    $question->question_text,
                    $question->aspect,
                    $question->is_unfavorable ? 'Negatif (skor dibalik)' : 'Positif',
                    $answers->count(),
                    round($answers->avg('score'), 2),
                ];
            })
            ->values();

        return Excel::download(new QuestionsExport($rows), 'analisis-pertanyaan.xlsx');
    }

    public function importStudents(Request $request, ActivityLogger $logger): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'],
        ]);
        $import = new StudentsImport;

        DB::transaction(fn () => Excel::import($import, $request->file('file')));
        $logger->log('impor_siswi', $request->user(), $import->importedCount.' akun diimpor');

        return back()->with('status', $import->importedCount.' akun siswi berhasil diimpor.');
    }

    public function importQuestions(Request $request, ActivityLogger $logger): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'],
        ]);
        $import = new QuestionsImport;

        DB::transaction(fn () => Excel::import($import, $request->file('file')));
        $logger->log('impor_pertanyaan', $request->user(), $import->importedCount.' pertanyaan diimpor');

        return back()->with('status', $import->importedCount.' pertanyaan berhasil diimpor ke pretest dan posttest.');
    }

    /**
     * @return Collection<int, array{
     *     user_id: int,
     *     name: string,
     *     inisial: string,
     *     kelas: string,
     *     usia: int|null,
     *     pretest: int,
     *     posttest: int,
     *     difference: int,
     *     pretest_at: string,
     *     posttest_at: string,
     *     pretest_attempt_id: int,
     *     posttest_attempt_id: int
     * }>
     */
    private function pairedRows(Request $request): Collection
    {
        $students = User::query()
            ->where('role', 'siswi')
            ->with('studentProfile')
            ->with(['testAttempts' => fn ($query) => $query
                ->whereNotNull('submitted_at')
                ->whereHas('test', fn (Builder $testQuery) => $testQuery->whereIn('type', ['pretest', 'posttest']))
                ->with('test')
                ->orderByDesc('submitted_at')])
            ->when($request->filled('kelas'), fn (Builder $query) => $query->whereHas(
                'studentProfile',
                fn (Builder $profileQuery) => $profileQuery->where('kelas', $request->string('kelas')->toString()),
            ))
            ->when($request->filled('q'), function (Builder $query) use ($request): void {
                $search = '%'.$request->string('q')->toString().'%';
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('name', 'like', $search)
                        ->orWhere('username', 'like', $search)
                        ->orWhereHas('studentProfile', fn (Builder $profile) => $profile->where('inisial', 'like', $search));
                });
            })
            ->get();

        return $students->map(function (User $student): ?array {
            $attemptsByType = $student->testAttempts->groupBy(fn ($attempt): string => $attempt->test->type);
            $pretest = $attemptsByType->get('pretest')?->first();
            $posttest = $attemptsByType->get('posttest')?->first();

            if ($pretest === null || $posttest === null || $pretest->total_score === null || $posttest->total_score === null) {
                return null;
            }

            return [
                'user_id' => $student->id,
                'name' => $student->name,
                'inisial' => $student->studentProfile?->inisial ?? '',
                'kelas' => $student->studentProfile?->kelas ?? '—',
                'usia' => $student->studentProfile?->usia,
                'pretest' => (int) $pretest->total_score,
                'posttest' => (int) $posttest->total_score,
                'difference' => (int) $posttest->total_score - (int) $pretest->total_score,
                'pretest_at' => $pretest->submitted_at->toDateTimeString(),
                'posttest_at' => $posttest->submitted_at->toDateTimeString(),
                'pretest_attempt_id' => $pretest->id,
                'posttest_attempt_id' => $posttest->id,
            ];
        })->filter()->values();
    }

    /**
     * @param  Collection<int, array{difference: int}>  $rows
     * @return array{n: int, statistic: float|null, p_value: float|null}
     */
    private function wilcoxon(Collection $rows): array
    {
        $differences = $rows->pluck('difference')->filter(fn (int $difference): bool => $difference !== 0)->values();
        $n = $differences->count();

        if ($n === 0) {
            return ['n' => 0, 'statistic' => null, 'p_value' => null];
        }

        $absoluteDifferences = $differences->map(fn (int $difference): int => abs($difference))->all();
        $sorted = $absoluteDifferences;
        sort($sorted);
        $ranks = [];

        for ($index = 0; $index < $n;) {
            $end = $index;
            while ($end + 1 < $n && $sorted[$end + 1] === $sorted[$index]) {
                $end++;
            }
            $averageRank = (($index + 1) + ($end + 1)) / 2;
            for ($rankIndex = $index; $rankIndex <= $end; $rankIndex++) {
                $ranks[(string) $sorted[$rankIndex]] = $averageRank;
            }
            $index = $end + 1;
        }

        $positiveRankSum = 0.0;
        $negativeRankSum = 0.0;
        $scaledRanks = [];

        foreach ($differences as $difference) {
            $rank = $ranks[(string) abs($difference)];
            $scaledRanks[] = (int) round($rank * 2);
            if ($difference > 0) {
                $positiveRankSum += $rank;
            } else {
                $negativeRankSum += $rank;
            }
        }

        $totalScaledRank = array_sum($scaledRanks);
        $observedDistance = abs(($positiveRankSum * 2) - ($totalScaledRank / 2));
        $distribution = [0 => 1.0];
        foreach ($scaledRanks as $rank) {
            $nextDistribution = [];
            foreach ($distribution as $sum => $probability) {
                $nextDistribution[$sum] = ($nextDistribution[$sum] ?? 0.0) + ($probability / 2);
                $nextDistribution[$sum + $rank] = ($nextDistribution[$sum + $rank] ?? 0.0) + ($probability / 2);
            }
            $distribution = $nextDistribution;
        }

        $pValue = 0.0;
        foreach ($distribution as $sum => $probability) {
            if (abs($sum - ($totalScaledRank / 2)) >= $observedDistance - 1.0e-9) {
                $pValue += $probability;
            }
        }

        return [
            'n' => $n,
            'statistic' => min($positiveRankSum, $negativeRankSum),
            'p_value' => min(1.0, $pValue),
        ];
    }
}
