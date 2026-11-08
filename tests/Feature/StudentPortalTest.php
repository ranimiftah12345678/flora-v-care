<?php

namespace Tests\Feature;

use App\Models\Material;
use App\Models\Question;
use App\Models\Test as LearningTest;
use App\Models\User;
use App\Models\Video;
use App\Services\ProgressService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class StudentPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_learning_pages_redirect_guests_to_login(): void
    {
        $paths = [
            '/dashboard',
            '/siswi/pretest',
            '/siswi/posttest',
            '/siswi/video',
            '/siswi/hasil',
            '/siswi/materi/keputihan',
            '/profile',
        ];

        foreach ($paths as $path) {
            $this->get($path)->assertRedirect(route('login'));
        }
    }

    public function test_student_must_complete_pretest_before_opening_learning_content(): void
    {
        $student = User::factory()->create();
        $material = Material::query()->create([
            'title' => 'Materi Contoh',
            'slug' => 'materi-contoh',
            'category' => 'apa_itu',
            'body' => 'Isi materi.',
            'sort_order' => 1,
            'is_published' => true,
        ]);
        Video::query()->create([
            'title' => 'Video Contoh',
            'description' => null,
            'file_path' => 'videos/contoh.mp4',
            'mime_type' => 'video/mp4',
            'file_size' => 100,
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $this->actingAs($student)
            ->get(route('student.lesson.show', $material->slug))
            ->assertRedirect(route('student.locked'))
            ->assertSessionHas('aliran', 'pretest');
        $this->get(route('student.video'))->assertRedirect(route('student.locked'));
        $this->get(route('student.posttest'))->assertRedirect(route('student.locked'));
    }

    public function test_student_can_complete_pretest_learn_content_and_view_posttest(): void
    {
        $student = User::factory()->create();
        $material = Material::query()->create([
            'title' => 'Materi Dinamis',
            'slug' => 'materi-dinamis',
            'category' => 'apa_itu',
            'body' => 'Materi diterbitkan.',
            'sort_order' => 1,
            'is_published' => true,
        ]);
        $video = Video::query()->create([
            'title' => 'Video Dinamis',
            'description' => 'Video edukasi.',
            'file_path' => 'videos/dinamis.mp4',
            'mime_type' => 'video/mp4',
            'file_size' => 100,
            'sort_order' => 1,
            'is_published' => true,
        ]);
        $pretest = $this->makeOpenTest('pretest');
        $this->makeOpenTest('posttest', $pretest->questions);

        $this->actingAs($student)
            ->get(route('student.pretest'))
            ->assertOk()
            ->assertSee('31 pertanyaan')
            ->assertSee('Jawaban tersimpan otomatis');

        $attempt = $student->testAttempts()->firstOrFail();
        foreach ($pretest->questions as $question) {
            $this->postJson(route('student.test.answer', ['testType' => 'pretest']), [
                'question_id' => $question->id,
                'answer_value' => 4,
            ])->assertOk()->assertJson(['saved' => true]);
        }

        $this->post(route('student.test.complete', ['testType' => 'pretest']))
            ->assertRedirect(route('student.results'));
        $this->assertSame(121, $attempt->fresh()->total_score);
        $this->assertDatabaseHas('attempt_answers', [
            'attempt_id' => $attempt->id,
            'question_id' => $pretest->questions->first()->id,
            'answer_value' => 4,
            'score' => 1,
        ]);

        $this->get(route('student.lesson.show', $material->slug))
            ->assertOk()
            ->assertSee('Materi Dinamis')
            ->assertSee('Materi diterbitkan.');
        $this->postJson(route('student.lesson.complete', $material), ['completed' => true])->assertNoContent();
        $this->get(route('student.video'))->assertOk()->assertSee('Video Dinamis');
        $this->postJson(route('student.video.playback'), ['video_id' => $video->id])->assertNoContent();
        $this->assertSame(100, app(ProgressService::class)->percentage($student));

        $this->get(route('student.posttest'))->assertOk()->assertSee('Posttest');
        $this->get(route('student.results'))->assertOk()->assertSee('Hasil Belajar & Evaluasi');
    }

    public function test_student_cannot_submit_test_with_missing_answers_or_change_a_submitted_answer(): void
    {
        $student = User::factory()->create();
        $test = $this->makeOpenTest('pretest');

        $this->actingAs($student)->get(route('student.pretest'))->assertOk();
        $attempt = $student->testAttempts()->firstOrFail();
        $question = $test->questions->firstOrFail();

        $this->post(route('student.test.complete', ['testType' => 'pretest']))
            ->assertSessionHasErrors();
        $this->assertNull($attempt->fresh()->submitted_at);

        foreach ($test->questions as $testQuestion) {
            $this->postJson(route('student.test.answer', ['testType' => 'pretest']), [
                'question_id' => $testQuestion->id,
                'answer_value' => 2,
            ])->assertOk();
        }

        $this->post(route('student.test.complete', ['testType' => 'pretest']))->assertRedirect(route('student.results'));
        $this->postJson(route('student.test.answer', ['testType' => 'pretest']), [
            'question_id' => $question->id,
            'answer_value' => 3,
        ])->assertConflict();
    }

    public function test_student_cannot_answer_question_outside_assigned_test(): void
    {
        $student = User::factory()->create();
        $this->makeOpenTest('pretest');
        $this->actingAs($student)->get(route('student.pretest'))->assertOk();
        $outsideQuestion = Question::query()->create([
            'question_text' => 'Apakah pertanyaan ini tidak terpasang?',
            'aspect' => 'kognitif',
            'sort_order' => 99,
        ]);

        $this->postJson(route('student.test.answer', ['testType' => 'pretest']), [
            'question_id' => $outsideQuestion->id,
            'answer_value' => 2,
        ])->assertNotFound();
    }

    public function test_student_results_show_score_delta_and_attitude_category(): void
    {
        $student = User::factory()->create();
        $material = Material::query()->create([
            'title' => 'Materi Hasil',
            'slug' => 'materi-hasil',
            'category' => 'apa_itu',
            'body' => 'Materi untuk hasil evaluasi.',
            'sort_order' => 1,
            'is_published' => true,
        ]);
        $video = Video::query()->create([
            'title' => 'Video Hasil',
            'description' => 'Video edukasi.',
            'file_path' => 'videos/hasil.mp4',
            'mime_type' => 'video/mp4',
            'file_size' => 100,
            'sort_order' => 1,
            'is_published' => true,
        ]);
        $pretest = $this->makeOpenTest('pretest');
        $posttest = $this->makeOpenTest('posttest', $pretest->questions);
        $posttest->forceFill(['attitude_threshold' => 30])->save();

        $this->actingAs($student)->get(route('student.pretest'))->assertOk();
        $pretestAttempt = $student->testAttempts()->firstOrFail();
        foreach ($pretest->questions as $question) {
            $this->postJson(route('student.test.answer', ['testType' => 'pretest']), [
                'question_id' => $question->id,
                'answer_value' => 4,
            ])->assertOk();
        }
        $this->post(route('student.test.complete', ['testType' => 'pretest']))->assertRedirect(route('student.results'));
        $this->assertSame(121, $pretestAttempt->fresh()->total_score);

        $this->get(route('student.lesson.show', $material->slug))->assertOk();
        $this->postJson(route('student.lesson.complete', $material), ['completed' => true])->assertNoContent();
        $this->get(route('student.video'))->assertOk();
        $this->postJson(route('student.video.playback'), ['video_id' => $video->id])->assertNoContent();
        $this->assertSame(100, app(ProgressService::class)->percentage($student));

        $this->get(route('student.posttest'))->assertOk();
        $posttestAttempt = $student->testAttempts()->whereHas('test', fn ($query) => $query->where('type', 'posttest'))->firstOrFail();
        foreach ($posttest->questions as $question) {
            $this->postJson(route('student.test.answer', ['testType' => 'posttest']), [
                'question_id' => $question->id,
                'answer_value' => 1,
            ])->assertOk();
        }
        $this->post(route('student.test.complete', ['testType' => 'posttest']))->assertRedirect(route('student.results'));
        $this->assertSame(34, $posttestAttempt->fresh()->total_score);

        $this->get(route('student.results'))
            ->assertOk()
            ->assertSee('Selisih evaluasi belajar')
            ->assertSee('-87')
            ->assertSee('Mampu memenuhi ambang sikap positif');
    }

    private function makeOpenTest(string $type, ?Collection $questions = null): LearningTest
    {
        $test = LearningTest::query()->where('type', $type)->firstOrFail();
        $questions ??= collect(range(1, 31))->map(fn (int $order): Question => Question::query()->create([
            'question_text' => "Apakah pertanyaan nomor {$order} sudah jelas?",
            'aspect' => 'kognitif',
            'is_unfavorable' => $order === 1,
            'sort_order' => $order,
        ]));
        $test->questions()->sync($questions->values()->mapWithKeys(fn (Question $question, int $index): array => [
            $question->id => ['sort_order' => $index + 1],
        ])->all());
        $test->forceFill(['is_open' => true])->save();

        return $test->load('questions');
    }
}
