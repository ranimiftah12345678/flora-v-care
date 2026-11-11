<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSiteReworkTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_are_accessible_without_authentication(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Flora-V Care');
        $response->assertSee('kenali • pahami • cegah');

        $response = $this->get('/jenis');
        $response->assertStatus(200);
        $response->assertSee('Jenis-Jenis Keputihan');
        $response->assertSee('Candida');

        $response = $this->get('/tanda-gejala');
        $response->assertStatus(200);
        $response->assertSee('Tanda dan Gejala Keputihan');
        $response->assertSee('Yuk Kenali Warna Keputihanmu');

        $response = $this->get('/cara-pencegahan');
        $response->assertStatus(200);
        $response->assertSee('Cara Pencegahan Keputihan');
        $response->assertSee('Vulva Hygiene');

        $response = $this->get('/video');
        $response->assertStatus(200);
        $response->assertSee('Video Edukasi');
    }

    public function test_old_student_login_and_register_redirect_cleanly(): void
    {
        $this->get('/login')->assertRedirect(route('admin.login'));
        $this->get('/register')->assertRedirect(route('home'));
    }

    public function test_admin_portal_is_accessible_only_by_authenticated_admin(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));

        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
            'password_change_required' => false,
        ]);

        $this->actingAs($admin)
            ->get('/admin')
            ->assertStatus(200)
            ->assertSee('Dasbor Administrator');

        $this->actingAs($admin)
            ->get('/admin/konten')
            ->assertStatus(200)
            ->assertSee('Kelola Konten Publik');

        $this->actingAs($admin)
            ->get('/admin/aktivitas')
            ->assertStatus(200)
            ->assertSee('Log Aktivitas Portal');
    }
}
