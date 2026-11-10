<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminAuthenticatedSessionController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        // Jika sedang login sebagai siswi dan membuka login admin, logout siswi terlebih dahulu
        if (Auth::check() && $request->user()?->role === 'siswi') {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } elseif (Auth::check() && $request->user()?->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin-login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate('admin');
        $request->session()->regenerate();

        return redirect()->route(
            $request->user()?->password_change_required ? 'password.change-required' : 'admin.dashboard',
        );
    }
}
