<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class PasswordController extends Controller
{
    public function create(): View
    {
        return view('auth.password-required');
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->forceFill([
            'password' => $validated['password'],
            'password_change_required' => false,
        ])->save();

        return redirect()->route(
            $request->user()->role === 'admin' ? 'admin.dashboard' : 'dashboard',
        )->with('status', 'password-updated');
    }
}
