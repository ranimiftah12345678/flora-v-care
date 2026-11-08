<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->password_change_required
            && ! in_array($request->route()?->getName(), [
                'password.change-required',
                'password.update',
                'logout',
            ], true)) {
            return redirect()->route('password.change-required');
        }

        return $next($request);
    }
}
