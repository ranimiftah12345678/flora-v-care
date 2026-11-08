<?php

namespace Tests\Feature;

use App\Models\ActivityLog;
use App\Models\LoginHistory;
use App\Models\Material;
use App\Models\Question;
use App\Models\Test as LearningTest;
use App\Models\TestAttempt;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityLoggingTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_login_records_login_history_and_activity(): void
    {
        $user = User::factory()->create();

        $response = $this->withHeader('User-Agent', 'Flora-V test browser')
            ->post(route('login'), [
                'username' => $user->username,
                'password' => 'password',
            ]);

        $response->assertRedirect(route('dashboard'));

        $loginHistory = LoginHistory::query()->where('user_id', $user->id)->firstOrFail();
        $this->assertNotNull($loginHistory->logged_in_at);
        $this->assertNotNull($loginHistory->ip_address);
        $this->assertSame('Flora-V test browser', $loginHistory->user_agent);

        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action' => 'login',
        ]);
    }

    public function test_logout_closes_the_current_login_history_and_records_activity(): void
    {
        $user = User::factory()->create();

        $this->post(route('login'), [
            'username' => $user->username,
            'password' => 'password',
        ]);

        $loginHistory = LoginHistory::query()->where('user_id', $user->id)->firstOrFail();
        $this->assertNull($loginHistory->logged_out_at);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertNotNull($loginHistory->fresh()->logged_out_at);
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action' => 'logout',
        ]);
    }

    public function test_unknown_login_attempt_records_a_failed_login_without_user_identity(): void
    {
        $response = $this->post(route('login'), [
            'username' => 'unknown.user',
            'password' => 'incorrect-password',
        ]);

        $response->assertSessionHasErrors('username');

        $this->assertDatabaseHas('activity_logs', [
            'user_id' => null,
            'action' => 'login_gagal',
        ]);

        $failedLogin = ActivityLog::query()->where('action', 'login_gagal')->firstOrFail();
        $this->assertNotNull($failedLogin->ip_address);
    }

    public function test_authenticated_requests_update_last_activity_without_changing_user_updated_at(): void
    {
        $this->travelTo('2026-11-08 10:00:00');
        $user = User::factory()->create([
            'last_activity_at' => now()->subHour(),
        ]);
        $updatedAt = $user->updated_at;

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $this->assertSame('2026-11-08 10:00:00', $user->fresh()->last_activity_at->toDateTimeString());
        $this->assertSame($updatedAt->toDateTimeString(), $user->fresh()->updated_at->toDateTimeString());
    }

    public function test_opening_a_lesson_records_the_lesson_activity(): void
    {
        $user = User::factory()->create();
        $this->completePretestPrerequisite($user);
        $material = Material::query()->create([
            'title' => 'Materi Aktivitas',
            'slug' => 'materi-aktivitas',
            'category' => 'apa_itu',
            'body' => 'Isi materi.',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $response = $this->actingAs($user)->get(route('student.lesson.show', $material->slug));

        $response->assertOk();
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action' => 'buka_materi',
            'description' => 'Materi Aktivitas',
        ]);
    }

    public function test_starting_and_finishing_a_test_records_both_activities(): void
    {
        $user = User::factory()->create();
        $test = $this->createOpenPretest();

        $this->actingAs($user)
            ->get(route('student.pretest'))
            ->assertOk()
            ->assertSee('Kirim Pretest');

        foreach ($test->questions as $question) {
            $this->postJson(route('student.test.answer', ['testType' => 'pretest']), [
                'question_id' => $question->id,
                'answer_value' => 1,
            ])->assertOk();
        }

        $response = $this->post(route('student.test.complete', ['testType' => 'pretest']));

        $response->assertRedirect(route('student.results'));
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action' => 'mulai_tes',
            'description' => 'Pretest',
        ]);
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action' => 'selesai_tes',
            'description' => 'Pretest',
        ]);
    }

    public function test_video_playback_endpoint_records_activity(): void
    {
        $user = User::factory()->create();
        $this->completePretestPrerequisite($user);
        $video = Video::query()->create([
            'title' => 'Video Aktivitas',
            'file_path' => 'videos/activity.mp4',
            'mime_type' => 'video/mp4',
            'file_size' => 1024,
            'sort_order' => 1,
            'is_published' => true,
        ]);

        $response = $this->actingAs($user)->post(route('student.video.playback'), ['video_id' => $video->id]);

        $response->assertNoContent();
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action' => 'putar_video',
        ]);
    }

    public function test_profile_update_records_activity_after_saving(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch(route('profile.update'), [
            'name' => 'Updated Profile',
            'email' => 'updated@example.test',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action' => 'ubah_profil',
            'subject_type' => User::class,
            'subject_id' => $user->id,
        ]);
    }

    public function test_profile_validation_failure_does_not_record_profile_activity(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('profile.edit'))
            ->patch(route('profile.update'), [
                'name' => '',
                'email' => 'not-an-email',
            ]);

        $response->assertSessionHasErrors(['name', 'email']);
        $this->assertDatabaseMissing('activity_logs', [
            'user_id' => $user->id,
            'action' => 'ubah_profil',
        ]);
    }

    public function test_video_playback_endpoint_rejects_guests_and_admins(): void
    {
        $this->post(route('student.video.playback'))->assertRedirect(route('login'));

        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->post(route('student.video.playback'))
            ->assertForbidden();

        $this->assertDatabaseMissing('activity_logs', [
            'action' => 'putar_video',
        ]);
    }

    private function createOpenPretest(): LearningTest
    {
        $test = LearningTest::query()->where('type', 'pretest')->firstOrFail();
        $questions = collect(range(1, 31))->map(fn (int $order): Question => Question::query()->create([
            'question_text' => "Apakah pertanyaan nomor {$order} sudah jelas?",
            'aspect' => 'kognitif',
            'sort_order' => $order,
        ]));
        $test->questions()->sync($questions->values()->mapWithKeys(fn (Question $question, int $index): array => [
            $question->id => ['sort_order' => $index + 1],
        ])->all());
        $test->forceFill(['is_open' => true])->save();

        return $test->load('questions');
    }

    private function completePretestPrerequisite(User $user): void
    {
        $test = LearningTest::query()->where('type', 'pretest')->firstOrFail();
        $test->forceFill(['is_open' => true])->save();
        TestAttempt::query()->create([
            'user_id' => $user->id,
            'test_id' => $test->id,
            'started_at' => now()->subMinute(),
            'submitted_at' => now(),
            'total_score' => 31,
        ]);
    }
}
