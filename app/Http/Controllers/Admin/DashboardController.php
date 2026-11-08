<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Material;
use App\Models\TestAttempt;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $pairedStudentIds = User::query()
            ->where('role', 'siswi')
            ->whereHas('testAttempts', fn (Builder $query) => $query
                ->whereNotNull('submitted_at')
                ->whereHas('test', fn (Builder $testQuery) => $testQuery->where('type', 'pretest')))
            ->whereHas('testAttempts', fn (Builder $query) => $query
                ->whereNotNull('submitted_at')
                ->whereHas('test', fn (Builder $testQuery) => $testQuery->where('type', 'posttest')))
            ->select('id');

        $pretestAverage = TestAttempt::query()
            ->whereNotNull('submitted_at')
            ->whereHas('test', fn (Builder $query) => $query->where('type', 'pretest'))
            ->avg('total_score');
        $posttestAverage = TestAttempt::query()
            ->whereNotNull('submitted_at')
            ->whereHas('test', fn (Builder $query) => $query->where('type', 'posttest'))
            ->avg('total_score');

        return view('admin.dashboard', [
            'studentCount' => User::query()->where('role', 'siswi')->count(),
            'activeStudentCount' => User::query()->where('role', 'siswi')->where('is_active', true)->count(),
            'pairedCount' => (clone $pairedStudentIds)->count(),
            'pretestAverage' => $pretestAverage,
            'posttestAverage' => $posttestAverage,
            'activityCount' => ActivityLog::query()->whereDate('created_at', today())->count(),
            'recentActivities' => ActivityLog::query()->with('user')->latest()->limit(8)->get(),
            'publishedMaterialCount' => Material::query()->where('is_published', true)->count(),
            'publishedVideoCount' => Video::query()->where('is_published', true)->count(),
        ]);
    }
}
