<?php

namespace Tests\Feature;

use App\Models\AttemptAnswer;
use App\Models\Question;
use App\Models\StudentProfile;
use App\Models\Test as LearningTest;
use App\Models\TestAttempt;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_sees_only_complete_pairs_and_actual_item_analysis(): void
    {
        $admin = User::factory()->admin()->create();
        $student = $this->createStudent('RA');
        $this->createPairedResults($student, 31, 62);
        $incompleteStudent = $this->createStudent('IN');
        $this->createAttempt($incompleteStudent, 'pretest', 40);

        $this->actingAs($admin)
            ->get(route('admin.paired-results'))
            ->assertOk()
            ->assertSee('Ringkasan Responden')
            ->assertSee('RA')
            ->assertSee('31')
            ->assertSee('62')
            ->assertSee('31')
            ->assertSee('Rerata Skor Item')
            ->assertDontSee('IN</td>')
            ->assertSee('nilai p exact dua sisi');
    }

    public function test_admin_can_filter_report_by_class_and_export_excel_and_pdf(): void
    {
        $admin = User::factory()->admin()->create();
        $student = $this->createStudent('RA', 'XI');
        $this->createPairedResults($student, 1, 2);

        $this->actingAs($admin)
            ->get(route('admin.reports', ['kelas' => 'XI']))
            ->assertOk()
            ->assertSee('Ringkasan per Kelas')
            ->assertSee('XI')
            ->assertSee('1');

        $this->get(route('admin.reports.excel', ['kelas' => 'XI']))
            ->assertOk()
            ->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->assertHeader('content-disposition', 'attachment; filename=hasil-tes-berpasangan.xlsx');

        $this->get(route('admin.reports.pdf', ['kelas' => 'XI']))
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf')
            ->assertHeader('content-disposition', 'attachment; filename=laporan-hasil-tes.pdf');
    }

    private function createStudent(string $initials, string $class = 'X'): User
    {
        $student = User::factory()->create(['name' => 'Siswi '.$initials]);
        StudentProfile::query()->create([
            'user_id' => $student->id,
            'inisial' => $initials,
            'kelas' => $class,
            'usia' => 16,
            'sekolah' => 'SMK Arga Husada',
        ]);

        return $student;
    }

    private function createPairedResults(User $student, int $pretestAnswer, int $posttestAnswer): void
    {
        $question = Question::query()->create([
            'question_text' => 'Apakah pertanyaan yang diuji jelas?',
            'aspect' => 'kognitif',
            'sort_order' => 1,
        ]);

        foreach (['pretest' => $pretestAnswer, 'posttest' => $posttestAnswer] as $type => $score) {
            $attempt = $this->createAttempt($student, $type, $score);
            AttemptAnswer::query()->create([
                'attempt_id' => $attempt->id,
                'question_id' => $question->id,
                'answer_value' => $score,
                'score' => $score,
            ]);
        }
    }

    private function createAttempt(User $student, string $type, int $score): TestAttempt
    {
        $test = LearningTest::query()->where('type', $type)->firstOrFail();

        return TestAttempt::query()->create([
            'user_id' => $student->id,
            'test_id' => $test->id,
            'started_at' => now()->subMinutes(2),
            'submitted_at' => now()->subMinute(),
            'total_score' => $score,
        ]);
    }
}
