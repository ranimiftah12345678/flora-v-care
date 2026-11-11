<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Video;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        // 1. Total Kunjungan Halaman Publik
        $totalVisits = ActivityLog::query()
            ->where('action', 'kunjungan_halaman')
            ->count();

        $todayVisits = ActivityLog::query()
            ->where('action', 'kunjungan_halaman')
            ->whereDate('created_at', today())
            ->count();

        // 2. Halaman Terbuka Terbanyak
        $topPages = ActivityLog::query()
            ->where('action', 'kunjungan_halaman')
            ->select('description', DB::raw('count(*) as total'))
            ->groupBy('description')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // 3. Video Diputar
        $videoPlays = ActivityLog::query()
            ->where('action', 'putar_video')
            ->count();

        $todayVideoPlays = ActivityLog::query()
            ->where('action', 'putar_video')
            ->whereDate('created_at', today())
            ->count();

        // 4. Grafik Kunjungan 7 Hari Terakhir
        $dailyVisits = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);
            $count = ActivityLog::query()
                ->where('action', 'kunjungan_halaman')
                ->whereDate('created_at', $date)
                ->count();

            return [
                'date' => $date->format('d M'),
                'count' => $count,
            ];
        });

        // 5. Aktivitas Terbaru
        $recentActivities = ActivityLog::query()
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', [
            'totalVisits' => $totalVisits,
            'todayVisits' => $todayVisits,
            'topPages' => $topPages,
            'videoPlays' => $videoPlays,
            'todayVideoPlays' => $todayVideoPlays,
            'dailyVisits' => $dailyVisits,
            'recentActivities' => $recentActivities,
            'totalVideos' => Video::count(),
        ]);
    }
}
