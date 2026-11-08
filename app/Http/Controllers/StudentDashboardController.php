<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Test;
use App\Models\TestAttempt;
use App\Models\Video;
use App\Services\ProgressService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentDashboardController extends Controller
{
    public function __invoke(Request $request, ProgressService $progressService): View
    {
        $user = $request->user();
        $latestAttempts = $user->testAttempts()
            ->with('test')
            ->whereNotNull('submitted_at')
            ->latest('submitted_at')
            ->get()
            ->groupBy(fn (TestAttempt $attempt): string => $attempt->test->type)
            ->map(fn ($attempts): TestAttempt => $attempts->first());

        return view('dashboard', [
            'materials' => Material::query()->where('is_published', true)->orderBy('sort_order')->orderBy('id')->get(),
            'videosCount' => Video::query()->where('is_published', true)->count(),
            'progressPercent' => $progressService->percentage($user),
            'pretestComplete' => isset($latestAttempts['pretest']),
            'posttestComplete' => isset($latestAttempts['posttest']),
            'latestAttempts' => $latestAttempts,
            'tests' => Test::query()->get()->keyBy('type'),
        ]);
    }
}
