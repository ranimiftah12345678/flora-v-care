<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityLoggingTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_page_visit_is_logged_without_user_identity(): void
    {
        $this->get(route('home'));

        $this->assertDatabaseHas('activity_logs', [
            'action' => 'kunjungan_halaman',
            'user_id' => null,
            'description' => 'Membuka Beranda',
        ]);
    }

    public function test_video_play_is_logged(): void
    {
        $this->postJson(route('public.video.track'), [
            'video_id' => 1,
            'video_title' => 'Video Vulva Hygiene',
        ])->assertStatus(200);

        $this->assertDatabaseHas('activity_logs', [
            'action' => 'putar_video',
            'user_id' => null,
            'description' => 'Memutar video: Video Vulva Hygiene',
        ]);
    }

    public function test_visitor_identification_is_logged_and_persisted_to_session(): void
    {
        $response = $this->postJson(route('public.visitor.identify'), [
            'visitor_name' => 'Siti Rahma',
            'visitor_email' => 'siti@example.com',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'identifikasi_pengunjung',
            'visitor_name' => 'Siti Rahma',
            'visitor_email' => 'siti@example.com',
        ]);

        // Subsequent page visits in the same session should record the visitor identity
        $this->get(route('public.jenis'));
        $this->assertDatabaseHas('activity_logs', [
            'action' => 'kunjungan_halaman',
            'visitor_name' => 'Siti Rahma',
            'visitor_email' => 'siti@example.com',
            'description' => 'Membuka Halaman Jenis',
        ]);
    }
}
