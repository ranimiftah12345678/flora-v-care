<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            $request->merge(['username' => trim($request->input('username'))]);
        }

        if (is_string($request->input('inisial')) && trim($request->input('inisial')) !== '') {
            $request->merge(['inisial' => Str::upper(trim($request->input('inisial')))]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'inisial' => ['nullable', 'string', 'max:10', 'regex:/^[\pL][\pL .\'-]*$/u'],
            'kelas' => ['required', Rule::in(['X', 'XI', 'XII'])],
            'usia' => ['required', 'integer', 'between:10,25'],
            'sekolah' => ['required', 'string', 'max:150'],
            'privacy_notice_acknowledged' => ['accepted'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Nama pengguna wajib diisi.',
            'username.unique' => 'Nama pengguna ini sudah terdaftar. Silakan pilih nama pengguna lain.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'kelas.required' => 'Silakan pilih jenjang kelas.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.between' => 'Usia harus berada di antara 10 hingga 25 tahun.',
            'sekolah.required' => 'Nama sekolah wajib diisi.',
            'privacy_notice_acknowledged.accepted' => 'Kamu wajib menyetujui pemberitahuan privasi sebelum mendaftar.',
        ]);

        $inisial = $validated['inisial'] ?? null;
        if (blank($inisial)) {
            $words = preg_split('/\s+/u', trim($validated['name']), -1, PREG_SPLIT_NO_EMPTY);
            $initials = '';
            foreach ($words as $word) {
                $initials .= Str::upper(mb_substr($word, 0, 1));
                if (mb_strlen($initials) >= 4) {
                    break;
                }
            }
            $inisial = mb_substr($initials !== '' ? $initials : 'S', 0, 10);
        }

        $user = DB::transaction(function () use ($validated, $inisial): User {
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
                'inisial' => $inisial,
                'kelas' => $validated['kelas'],
                'usia' => $validated['usia'],
                'sekolah' => trim($validated['sekolah']),
            ]);

            return $user;
        });

        // Pendaftaran berhasil, arahkan ke halaman login dengan pesan status
        return redirect()->route('login')->with('status', 'Pendaftaran berhasil! Silakan masuk menggunakan nama pengguna dan kata sandi yang telah kamu daftarkan.');
    }
}
