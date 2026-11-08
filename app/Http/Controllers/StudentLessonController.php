<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Services\ActivityLogger;
use App\Services\ProgressService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentLessonController extends Controller
{
    public function show(string $slug, Request $request, ActivityLogger $logger, ProgressService $progressService): View
    {
        $material = Material::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $progress = $progressService->markOpened($request->user(), $material);
        $logger->log('buka_materi', $request->user(), $material->title, $material);

        return view('student.material', [
            'material' => $material,
            'isCompleted' => $progress->completed_at !== null,
        ]);
    }
}
