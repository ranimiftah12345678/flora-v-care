<?php

namespace Tests\Feature\Auth;

use App\Models\Question;
use App\Models\Test as LearningTest;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_authenticate_only_through_the_admin_login(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->post(route('admin.login'), [
            'username' => $admin->username,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_student_account_cannot_authenticate_through_admin_login(): void
    {
        $student = User::factory()->create();

        $response = $this->post(route('admin.login'), [
            'username' => $student->username,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('username');
    }

    public function test_student_cannot_access_admin_routes_and_admin_cannot_access_student_routes(): void
    {
        $student = User::factory()->create();

        $this->actingAs($student)
            ->get(route('admin.dashboard'))
            ->assertForbidden();

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('dashboard'))
            ->assertForbidden();
    }

    public function test_inactive_authenticated_user_is_logged_out_on_the_next_request(): void
    {
        $user = User::factory()->inactive()->create();

        $response = $this->actingAs($user)->get(route('dashboard'));

        $this->assertGuest();
        $response->assertRedirect(route('login'));
    }

    public function test_inactive_admin_is_logged_out_and_sent_to_admin_login(): void
    {
        $admin = User::factory()->admin()->inactive()->create();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $this->assertGuest();
        $response->assertRedirect(route('admin.login'));
    }

    public function test_password_change_required_blocks_protected_pages_until_password_is_changed(): void
    {
        $user = User::factory()->mustChangePassword()->create();

        $response = $this->actingAs($user)->get(route('student.pretest'));

        $response->assertRedirect(route('password.change-required'));
        $this->get(route('password.change-required'))->assertOk();
        $this->get('/confirm-password')->assertRedirect(route('password.change-required'));

        $response = $this->put(route('password.update'), [
            'current_password' => 'password',
            'password' => 'Siswitest_02',
            'password_confirmation' => 'Siswitest_02',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertFalse($user->fresh()->password_change_required);

        $pretest = LearningTest::query()->where('type', 'pretest')->firstOrFail();
        $pretest->forceFill(['is_open' => true])->save();
        $questions = collect(range(1, 31))->map(fn (int $order): Question => Question::query()->create([
            'question_text' => "Apakah pertanyaan nomor {$order} sudah jelas?",
            'aspect' => 'kognitif',
            'is_unfavorable' => $order === 1,
            'sort_order' => $order,
        ]));
        $pretest->questions()->sync($questions->values()->mapWithKeys(fn (Question $question, int $index): array => [
            $question->id => ['sort_order' => $index + 1],
        ])->all());

        $this->get(route('student.pretest'))->assertOk();
    }

    public function test_admin_seed_creates_an_admin_that_must_change_its_configured_password(): void
    {
        Config::set('flora.admin', [
            'name' => 'Admin Flora',
            'username' => 'admin.flora',
            'email' => 'admin@example.test',
            'password' => 'initial-secret-123',
        ]);

        $this->seed(AdminUserSeeder::class);

        $admin = User::query()->where('username', 'admin.flora')->firstOrFail();

        $this->assertSame('admin', $admin->role);
        $this->assertTrue($admin->is_active);
        $this->assertTrue($admin->password_change_required);
        $this->assertTrue(Hash::check('initial-secret-123', $admin->password));

        $admin->password = 'changed-admin-secret';
        $admin->password_change_required = false;
        $admin->save();
        $this->seed(AdminUserSeeder::class);

        $admin->refresh();
        $this->assertFalse($admin->password_change_required);
        $this->assertTrue(Hash::check('changed-admin-secret', $admin->password));
    }

    public function test_admin_seed_rejects_passwords_shorter_than_twelve_characters(): void
    {
        Config::set('flora.admin', [
            'name' => 'Admin Flora',
            'username' => 'admin.flora',
            'email' => 'admin@example.test',
            'password' => 'short-12345',
        ]);

        $this->expectException(RuntimeException::class);

        $this->seed(AdminUserSeeder::class);
    }

    public function test_admin_login_requires_password_change_before_accessing_admin_routes(): void
    {
        $admin = User::factory()->admin()->mustChangePassword()->create();

        $response = $this->post(route('admin.login'), [
            'username' => $admin->username,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('password.change-required'));
        $this->get(route('admin.dashboard'))->assertRedirect(route('password.change-required'));
    }
}
