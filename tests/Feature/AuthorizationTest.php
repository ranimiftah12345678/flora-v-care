<?php

namespace Tests\Feature;

use App\Models\AttemptAnswer;
use App\Models\Question;
use App\Models\Test as LearningTest;
use App\Models\TestAttempt;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_cannot_access_admin_dashboard(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_posttest_is_locked_until_learning_progress_is_complete(): void
    {
        $student = User::factory()->create();
        $this->completePretest($student);

        $this->actingAs($student)
            ->get(route('student.posttest'))
            ->assertRedirect(route('student.locked'))
            ->assertSessionHas('aliran', 'progres');
    }

    public function test_admin_cannot_delete_question_that_was_already_answered(): void
    {
        $admin = User::factory()->admin()->create();
        $student = User::factory()->create();
        $question = Question::query()->create([
            'question_text' => 'Apakah pertanyaan ini jelas?',
            'aspect' => 'kognitif',
            'sort_order' => 1,
        ]);
        $test = LearningTest::query()->where('type', 'pretest')->firstOrFail();
        $test->questions()->attach($question->id, ['sort_order' => 1]);
        $attempt = TestAttempt::query()->create([
            'user_id' => $student->id,
            'test_id' => $test->id,
        ]);
        AttemptAnswer::query()->create([
            'attempt_id' => $attempt->id,
            'question_id' => $question->id,
            'answer_value' => 2,
            'score' => 2,
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.questions.destroy', $question))
            ->assertRedirect();

        $this->assertModelExists($question->fresh());
    }

    private function completePretest(User $student): void
    {
        $test = LearningTest::query()->where('type', 'pretest')->firstOrFail();
        TestAttempt::query()->create([
            'user_id' => $student->id,
            'test_id' => $test->id,
            'started_at' => now()->subMinute(),
            'submitted_at' => now(),
            'total_score' => 30,
        ]);
    }
}
