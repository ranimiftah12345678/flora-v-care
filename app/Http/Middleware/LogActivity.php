<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user instanceof User && $user->exists) {
            $user->newQuery()
                ->whereKey($user->getKey())
                ->toBase()
                ->update(['last_activity_at' => now()]);
        }

        return $next($request);
    }
}
