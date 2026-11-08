<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(string $role): void
    {
        $this->ensureIsNotRateLimited($role);

        $credentials = [
            'username' => Str::lower(trim($this->string('username')->toString())),
            'password' => $this->string('password')->toString(),
            'role' => $role,
            'is_active' => true,
        ];

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey($role), 60);

            throw ValidationException::withMessages([
                'username' => 'Nama pengguna atau kata sandi tidak sesuai.',
            ]);
        }

        RateLimiter::clear($this->throttleKey($role));

        $this->user()?->forceFill([
            'last_login_at' => now(),
        ])->save();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(string $role): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($role), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey($role));

        throw ValidationException::withMessages([
            'username' => "Terlalu banyak percobaan masuk. Coba lagi dalam {$seconds} detik.",
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(string $role): string
    {
        return Str::transliterate(
            $role.'|'.Str::lower(trim($this->string('username')->toString())).'|'.$this->ip(),
        );
    }
}
