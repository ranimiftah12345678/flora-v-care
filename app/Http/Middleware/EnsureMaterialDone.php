<?php

namespace App\Http\Middleware;

use App\Models\TestAttempt;
use App\Services\ProgressService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMaterialDone
{
    public function __construct(private ProgressService $progressService) {}

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route('testType') !== 'posttest') {
            return $next($request);
        }

        $hasCompletedPretest = TestAttempt::query()
            ->where('user_id', $request->user()->id)
            ->whereHas('test', fn ($query) => $query->where('type', 'pretest'))
            ->whereNotNull('submitted_at')
            ->exists();

        if (! $hasCompletedPretest) {
            if ($request->expectsJson()) {
                abort(403, 'Selesaikan pretest sebelum melanjutkan.');
            }

            return redirect()->route('student.locked')->with('aliran', 'pretest');
        }

        if ($this->progressService->percentage($request->user()) < 100) {
            if ($request->expectsJson()) {
                abort(403, 'Selesaikan seluruh materi dan video sebelum membuka posttest.');
            }

            return redirect()->route('student.locked')->with('aliran', 'progres');
        }

        return $next($request);
    }
}
