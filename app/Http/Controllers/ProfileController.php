<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if ($request->user()->role === 'admin') {
            return view('admin.profile', [
                'user' => $request->user(),
                'loginHistories' => $request->user()->loginHistories()->latest('logged_in_at')->limit(10)->get(),
            ]);
        }

        return view('profile.edit', [
            'user' => $request->user()->load('studentProfile'),
            'loginHistories' => $request->user()->loginHistories()->latest('logged_in_at')->limit(5)->get(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, ActivityLogger $logger): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        $logger->log('ubah_profil', $request->user(), 'Profil pengguna diperbarui', $request->user());

        return Redirect::route($request->user()->role === 'admin' ? 'admin.profile' : 'profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile avatar.
     */
    public function updateAvatar(Request $request, ActivityLogger $logger): RedirectResponse
    {
        $validated = $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'avatar.required' => 'Silakan pilih foto profil terlebih dahulu.',
            'avatar.image' => 'Berkas yang diunggah harus berupa gambar.',
            'avatar.mimes' => 'Foto profil harus berformat JPG, PNG, atau WebP.',
            'avatar.max' => 'Ukuran foto profil maksimal 2 MB.',
        ]);

        $user = $request->user();

        if (filled($user->avatar_path)) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $user->avatar_path = $validated['avatar']->store('avatars', 'public');
        $user->save();

        $logger->log('ubah_foto_profil', $user, 'Foto profil diperbarui', $user);

        return Redirect::route($user->role === 'admin' ? 'admin.profile' : 'profile.edit')
            ->with('status', 'avatar-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
