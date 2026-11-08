<?php

namespace App\Services;

use App\Models\LearningProgress;
use App\Models\Material;
use App\Models\User;
use App\Models\Video;

class ProgressService
{
    public function markOpened(User $user, Material $material): LearningProgress
    {
        return LearningProgress::query()->firstOrCreate(
            ['user_id' => $user->id, 'content_type' => 'material', 'content_id' => $material->id],
            ['opened_at' => now()],
        );
    }

    public function markCompleted(User $user, Material $material): LearningProgress
    {
        $progress = LearningProgress::query()
            ->where('user_id', $user->id)
            ->where('content_type', 'material')
            ->where('content_id', $material->id)
            ->firstOrFail();

        $progress->forceFill(['completed_at' => $progress->completed_at ?? now()])->save();

        return $progress;
    }

    public function markVideoPlayed(User $user, Video $video): LearningProgress
    {
        $progress = LearningProgress::query()->firstOrCreate(
            ['user_id' => $user->id, 'content_type' => 'video', 'content_id' => $video->id],
            ['opened_at' => now()],
        );

        $progress->forceFill(['played_at' => $progress->played_at ?? now()])->save();

        return $progress;
    }

    public function percentage(User $user): int
    {
        $publishedMaterialIds = Material::query()->where('is_published', true)->select('id');
        $publishedVideoIds = Video::query()->where('is_published', true)->select('id');
        $total = (clone $publishedMaterialIds)->count() + (clone $publishedVideoIds)->count();

        if ($total === 0) {
            return 0;
        }

        $completed = $user->learningProgress()
            ->where(function ($query) use ($publishedMaterialIds, $publishedVideoIds): void {
                $query->where(function ($query) use ($publishedMaterialIds): void {
                    $query->where('content_type', 'material')
                        ->whereNotNull('completed_at')
                        ->whereIn('content_id', $publishedMaterialIds);
                })->orWhere(function ($query) use ($publishedVideoIds): void {
                    $query->where('content_type', 'video')
                        ->whereNotNull('played_at')
                        ->whereIn('content_id', $publishedVideoIds);
                });
            })
            ->count();

        return (int) floor(($completed / $total) * 100);
    }
}
