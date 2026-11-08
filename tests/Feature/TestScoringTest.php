<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\Test as LearningTest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestScoringTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_sangat_setuju_answers_score_87(): void
    {
        $student = User::factory()->create();
        $test = $this->makeOpenPretest();

        $this->actingAs($student)->get(route('student.pretest'));
        $attempt = $student->testAttempts()->firstOrFail();

        foreach ($test->questions as $question) {
            $this->postJson(route('student.test.answer', ['testType' => 'pretest']), [
                'question_id' => $question->id,
                'answer_value' => 4,
            ])->assertOk();
        }

        $this->post(route('student.test.complete', ['testType' => 'pretest']))->assertRedirect(route('student.results'));

        $this->assertSame(91, $attempt->fresh()->total_score);
    }

    public function test_all_tidak_setuju_answers_score_63(): void
    {
        $student = User::factory()->create();
        $test = $this->makeOpenPretest();

        $this->actingAs($student)->get(route('student.pretest'));
        $attempt = $student->testAttempts()->firstOrFail();

        foreach ($test->questions as $question) {
            $this->postJson(route('student.test.answer', ['testType' => 'pretest']), [
                'question_id' => $question->id,
                'answer_value' => 1,
            ])->assertOk();
        }

        $this->post(route('student.test.complete', ['testType' => 'pretest']))->assertRedirect(route('student.results'));

        $this->assertSame(64, $attempt->fresh()->total_score);
    }

    private function makeOpenPretest(): LearningTest
    {
        $test = LearningTest::query()->where('type', 'pretest')->firstOrFail();
        $questions = collect(range(1, 31))->map(fn (int $order): Question => Question::query()->create([
            'question_text' => "Apakah pertanyaan nomor {$order} sudah jelas?",
            'aspect' => 'kognitif',
            'is_unfavorable' => $order <= 11,
            'sort_order' => $order,
        ]));
        $test->questions()->sync($questions->values()->mapWithKeys(fn (Question $question, int $index): array => [
            $question->id => ['sort_order' => $index + 1],
        ])->all());
        $test->forceFill(['is_open' => true])->save();

        return $test->load('questions');
    }
}
