<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'Test.User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'inisial' => 'tu',
            'kelas' => 'X',
            'usia' => 16,
            'sekolah' => 'SMK Arga Husada',
            'privacy_notice_acknowledged' => '1',
            'role' => 'admin',
            'password_change_required' => true,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertDatabaseHas('users', [
            'username' => 'test.user',
            'role' => 'siswi',
            'is_active' => true,
            'password_change_required' => false,
        ]);
        $this->assertDatabaseHas('student_profiles', [
            'inisial' => 'TU',
            'kelas' => 'X',
            'usia' => 16,
            'sekolah' => 'SMK Arga Husada',
        ]);
    }

    public function test_registration_validation_does_not_create_partial_accounts(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'test.user',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'inisial' => 'TU',
            'kelas' => 'XIII',
            'usia' => 16,
            'sekolah' => 'SMK Arga Husada',
            'privacy_notice_acknowledged' => '1',
        ]);

        $response->assertSessionHasErrors('kelas');
        $this->assertSame(0, DB::table('users')->count());
        $this->assertSame(0, DB::table('student_profiles')->count());
    }

    public function test_registration_is_limited_to_ten_requests_per_minute(): void
    {
        foreach (range(1, 10) as $attempt) {
            $this->post('/register', []);
        }

        $response = $this->post('/register', []);

        $response->assertStatus(429);
    }
}
