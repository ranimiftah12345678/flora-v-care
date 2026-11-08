<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (is_string($request->input('username'))) {
            $request->merge(['username' => Str::lower(trim($request->input('username')))]);
        }

        if (is_string($request->input('inisial'))) {
            $request->merge(['inisial' => Str::upper(trim($request->input('inisial')))]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[a-z0-9._-]+$/', 'unique:users,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'inisial' => ['required', 'string', 'max:10', 'regex:/^[\pL][\pL .\'-]*$/u'],
            'kelas' => ['required', Rule::in(['X', 'XI', 'XII'])],
            'usia' => ['required', 'integer', 'between:10,25'],
            'sekolah' => ['required', 'string', 'max:150'],
            'privacy_notice_acknowledged' => ['accepted'],
        ]);

        $user = DB::transaction(function () use ($validated): User {
            $user = new User;
            $user->name = $validated['name'];
            $user->username = $validated['username'];
            $user->email = $validated['email'];
            $user->password = $validated['password'];
            $user->role = 'siswi';
            $user->is_active = true;
            $user->password_change_required = false;
            $user->save();

            $user->studentProfile()->create([
                'inisial' => $validated['inisial'],
                'kelas' => $validated['kelas'],
                'usia' => $validated['usia'],
                'sekolah' => trim($validated['sekolah']),
            ]);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect(route('dashboard', absolute: false));
    }
}
