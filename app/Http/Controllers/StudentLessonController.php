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

        $allMaterials = Material::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $completedMaterialIds = $request->user()->learningProgress()
            ->where('content_type', 'material')
            ->whereNotNull('completed_at')
            ->pluck('content_id')
            ->map(fn ($id): int => (int) $id)
            ->all();

        $progress = $progressService->markOpened($request->user(), $material);
        $logger->log('buka_materi', $request->user(), $material->title, $material);

        $currentIndex = $allMaterials->search(fn ($m) => $m->id === $material->id);
        $prevMaterial = $currentIndex > 0 ? $allMaterials->get($currentIndex - 1) : null;
        $nextMaterial = $currentIndex < ($allMaterials->count() - 1) ? $allMaterials->get($currentIndex + 1) : null;

        $hasCompletedAll = $progressService->hasCompletedAllMaterials($request->user());

        return view('student.material', [
            'material' => $material,
            'isCompleted' => $progress->completed_at !== null,
            'allMaterials' => $allMaterials,
            'completedMaterialIds' => $completedMaterialIds,
            'prevMaterial' => $prevMaterial,
            'nextMaterial' => $nextMaterial,
            'hasCompletedAll' => $hasCompletedAll,
        ]);
    }
}
