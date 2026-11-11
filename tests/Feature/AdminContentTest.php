<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_content_list(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
            'password_change_required' => false,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.content'))
            ->assertStatus(200)
            ->assertSee('Kelola Konten Publik');
    }

    public function test_admin_can_update_content_section(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
            'password_change_required' => false,
        ]);

        $response = $this->actingAs($admin)
            ->put(route('admin.content.update', 'jenis'), [
                'title' => 'Judul Baru Jenis Keputihan',
                'body' => 'Uraian baru materi jenis keputihan',
            ]);

        $response->assertRedirect(route('admin.content.edit', 'jenis'));
        $this->assertDatabaseHas('materials', [
            'slug' => 'jenis-keputihan',
            'title' => 'Judul Baru Jenis Keputihan',
        ]);
    }
}
