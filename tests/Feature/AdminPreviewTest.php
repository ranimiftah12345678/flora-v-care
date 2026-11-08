<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPreviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_admin_preview_pages_render_with_sample_data_notice(): void
    {
        $pages = [
            'admin.dashboard' => 'Dasbor Utama Administrator',
            'admin.students' => 'Manajemen Data Siswi',
            'admin.student-detail' => 'Siswi Tes Detail',
            'admin.materials' => 'Manajemen Materi Edukasi',
            'admin.materials.create' => 'Tambah Materi',
            'admin.videos' => 'Manajemen Video Edukasi',
            'admin.questions' => 'Manajemen Pertanyaan Kuesioner',
            'admin.paired-results' => 'Hasil Evaluasi & Analisis Data',
            'admin.reports' => 'Pusat Laporan & Ekspor',
            'admin.activity' => 'Pemantauan Aktivitas & Log',
            'admin.settings' => 'Konfigurasi & Identitas Situs',
            'admin.profile' => 'Profil Administrator & Keamanan',
        ];

        $this->actingAs(User::factory()->admin()->create());
        $student = User::factory()->create(['name' => 'Siswi Tes Detail']);

        foreach ($pages as $routeName => $heading) {
            $response = $routeName === 'admin.student-detail'
                ? $this->get(route($routeName, $student))
                : $this->get(route($routeName));

            $response->assertOk()
                ->assertSee($heading)
                ->assertSee('PANEL ADMIN');
        }
    }

    public function test_admin_login_form_is_available(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertOk()
            ->assertSee('Masuk ke Dasbor Admin')
            ->assertSee('name="username"', false);
    }

    public function test_admin_preview_routes_require_admin_authentication(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));

        $this->actingAs(User::factory()->create())
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }
}
