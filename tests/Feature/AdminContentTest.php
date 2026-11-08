<?php

namespace Tests\Feature;

use App\Models\AttemptAnswer;
use App\Models\Material;
use App\Models\Question;
use App\Models\Test as LearningTest;
use App\Models\TestAttempt;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_creates_question_and_it_is_added_to_pretest(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.questions.store'), [
            'question_text' => 'Apakah informasi ini membantu?',
            'aspect' => 'kognitif',
            'is_unfavorable' => '1',
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.questions'));
        $question = Question::query()->firstOrFail();
        $this->assertSame('Apakah informasi ini membantu?', $question->question_text);
        $this->assertTrue($question->is_unfavorable);
        $this->assertTrue($question->tests()->where('type', 'pretest')->exists());
    }

    public function test_admin_cannot_save_a_statement_as_a_question(): void
    {
        $response = $this->actingAs(User::factory()->admin()->create())
            ->from(route('admin.questions.create'))
            ->post(route('admin.questions.store'), [
                'question_text' => 'Saya memahami materi ini.',
                'aspect' => 'kognitif',
                'sort_order' => 1,
            ]);

        $response->assertSessionHasErrors([
            'question_text' => 'Tuliskan butir sebagai pertanyaan dan akhiri dengan tanda tanya.',
        ]);
        $this->assertDatabaseCount('questions', 0);
    }

    public function test_answered_question_cannot_be_deleted_or_have_its_negative_scoring_changed(): void
    {
        $admin = User::factory()->admin()->create();
        $student = User::factory()->create();
        $question = Question::query()->create([
            'question_text' => 'Apakah kamu memahami materi?',
            'aspect' => 'afektif',
            'is_unfavorable' => true,
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
            'answer_value' => 1,
            'score' => 4,
        ]);

        $this->actingAs($admin)
            ->patch(route('admin.questions.update', $question), [
                'question_text' => 'Apakah kamu memahami materi dengan baik?',
                'aspect' => 'afektif',
                'sort_order' => 1,
                'is_unfavorable' => '0',
            ])
            ->assertRedirect(route('admin.questions'));

        $this->assertTrue($question->fresh()->is_unfavorable);

        $this->delete(route('admin.questions.destroy', $question))
            ->assertRedirect();
        $this->assertModelExists($question->fresh());
    }

    public function test_admin_cannot_open_a_test_with_thirty_or_fewer_questions(): void
    {
        $admin = User::factory()->admin()->create();
        $test = LearningTest::query()->where('type', 'pretest')->firstOrFail();
        $questionIds = [];

        foreach (range(1, 30) as $order) {
            $questionIds[] = Question::query()->create([
                'question_text' => "Apakah pertanyaan nomor {$order} sudah siap?",
                'aspect' => 'kognitif',
                'sort_order' => $order,
            ])->id;
        }

        $response = $this->actingAs($admin)
            ->from(route('admin.tests'))
            ->put(route('admin.tests.update', $test->type), [
                'title' => 'Pretest',
                'instructions' => 'Jawab pertanyaan.',
                'max_attempts' => 1,
                'question_ids' => $questionIds,
                'is_open' => '1',
            ]);

        $response->assertSessionHasErrors([
            'question_ids' => 'Tes hanya dapat dibuka jika memiliki lebih dari 30 pertanyaan.',
        ]);
        $this->assertFalse($test->fresh()->is_open);
        $this->assertDatabaseCount('test_questions', 0);
    }

    public function test_admin_cannot_change_test_question_list_after_answers_exist(): void
    {
        $admin = User::factory()->admin()->create();
        $student = User::factory()->create();
        $test = LearningTest::query()->where('type', 'pretest')->firstOrFail();
        $question = Question::query()->create([
            'question_text' => 'Apakah pertanyaan ini jelas?',
            'aspect' => 'kognitif',
            'sort_order' => 1,
        ]);
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

        $response = $this->actingAs($admin)
            ->from(route('admin.tests'))
            ->put(route('admin.tests.update', $test->type), [
                'title' => 'Pretest',
                'instructions' => 'Jawab pertanyaan.',
                'max_attempts' => 1,
                'question_ids' => [],
            ]);

        $response->assertSessionHasErrors([
            'question_ids' => 'Daftar pertanyaan tidak dapat diubah setelah siswi mengirim jawaban.',
        ]);
        $this->assertDatabaseHas('test_questions', [
            'test_id' => $test->id,
            'question_id' => $question->id,
        ]);
    }

    public function test_published_material_is_visible_to_students_and_its_slug_cannot_be_changed(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.materials.store'), [
            'title' => 'Materi Baru',
            'slug' => 'materi-baru',
            'category' => 'apa_itu',
            'body' => 'Isi materi yang telah ditinjau.',
            'sort_order' => 1,
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.materials'));
        $material = Material::query()->where('slug', 'materi-baru')->firstOrFail();

        $this->patch(route('admin.materials.update', $material), [
            'title' => 'Materi Diperbarui',
            'slug' => 'slug-tidak-boleh-berubah',
            'category' => 'pencegahan',
            'body' => 'Isi yang diperbarui.',
            'sort_order' => 2,
            'is_published' => '1',
        ])->assertRedirect(route('admin.materials'));

        $this->assertSame('materi-baru', $material->fresh()->slug);

        $student = User::factory()->create();
        $pretest = LearningTest::query()->where('type', 'pretest')->firstOrFail();
        $pretest->forceFill(['is_open' => true])->save();
        TestAttempt::query()->create([
            'user_id' => $student->id,
            'test_id' => $pretest->id,
            'started_at' => now()->subMinute(),
            'submitted_at' => now(),
            'total_score' => 0,
        ]);

        $this->actingAs($student)
            ->get(route('student.lesson.show', 'materi-baru'))
            ->assertOk()
            ->assertSee('Materi Diperbarui')
            ->assertSee('Isi yang diperbarui.');
    }

    public function test_admin_can_upload_and_publish_an_mp4_video(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.videos.store'), [
            'title' => 'Video Edukasi',
            'description' => 'Video yang sudah ditinjau.',
            'video_file' => UploadedFile::fake()->create('edukasi.mp4', 100, 'video/mp4'),
            'sort_order' => 1,
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.videos'));
        $video = Video::query()->firstOrFail();
        $this->assertTrue($video->is_published);
        $this->assertSame('video/mp4', $video->mime_type);
        Storage::disk('public')->assertExists($video->file_path);
    }

    public function test_admin_can_add_student_with_one_time_password(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.students.store'), [
            'name' => 'Siswi Contoh',
            'username' => 'siswi.baru',
            'email' => 'siswi.baru@example.test',
            'inisial' => 'SB',
            'kelas' => 'XI',
            'usia' => 16,
            'sekolah' => 'SMK Arga Husada',
        ]);

        $student = User::query()->where('username', 'siswi.baru')->firstOrFail();
        $response->assertRedirect(route('admin.students.edit', $student));
        $response->assertSessionHas('temporary_password');
        $this->assertSame('siswi', $student->role);
        $this->assertTrue($student->password_change_required);
        $this->assertTrue(Hash::check((string) session('temporary_password'), $student->password));
        $this->assertSame('SB', $student->studentProfile->inisial);
        $this->assertTrue($student->is_active);
    }

    public function test_resetting_student_password_clears_database_sessions(): void
    {
        $admin = User::factory()->admin()->create();
        $student = User::factory()->create();
        $sessionId = 'student-session-id';
        DB::table('sessions')->insert([
            'id' => $sessionId,
            'user_id' => $student->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'test',
            'payload' => '',
            'last_activity' => now()->timestamp,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.students.reset-password', $student));

        $response->assertSessionHas('temporary_password');
        $this->assertDatabaseMissing('sessions', ['id' => $sessionId]);
        $this->assertTrue($student->fresh()->password_change_required);
        $this->assertTrue(Hash::check((string) session('temporary_password'), $student->fresh()->password));
    }
}
