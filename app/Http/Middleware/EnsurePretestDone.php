<?php

namespace App\Http\Middleware;

use App\Models\TestAttempt;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePretestDone
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hasCompletedPretest = TestAttempt::query()
            ->where('user_id', $request->user()->id)
            ->whereHas('test', fn ($query) => $query->where('type', 'pretest'))
            ->whereNotNull('submitted_at')
            ->exists();

        if ($hasCompletedPretest) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            abort(403, 'Selesaikan pretest sebelum membuka materi dan video.');
        }

        return redirect()->route('student.locked')->with('aliran', 'pretest');
    }
}
