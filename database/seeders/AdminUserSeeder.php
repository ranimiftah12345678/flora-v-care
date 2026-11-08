<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = config('flora.admin');

        foreach (['name', 'username', 'password'] as $requiredSetting) {
            if (! is_string($admin[$requiredSetting] ?? null) || trim($admin[$requiredSetting]) === '') {
                throw new RuntimeException('Set FLORA_ADMIN_'.strtoupper($requiredSetting).' before seeding the administrator account.');
            }
        }

        if (mb_strlen($admin['password']) < 12) {
            throw new RuntimeException('FLORA_ADMIN_PASSWORD must contain at least 12 characters.');
        }

        $username = mb_strtolower(trim($admin['username']));
        $user = User::query()->where('username', $username)->first();

        if ($user !== null && $user->role !== 'admin') {
            throw new RuntimeException('The configured admin username already belongs to a non-admin account.');
        }

        if ($user !== null) {
            return;
        }

        if (User::query()->where('role', 'admin')->where('username', '!=', $username)->exists()) {
            throw new RuntimeException('Another admin account already exists; refusing to create a second administrator.');
        }

        $user = new User;
        $user->name = trim($admin['name']);
        $user->username = $username;
        $user->email = is_string($admin['email'] ?? null) && trim($admin['email']) !== ''
            ? mb_strtolower(trim($admin['email']))
            : null;
        $user->password = Hash::make($admin['password']);
        $user->role = 'admin';
        $user->is_active = true;
        $user->password_change_required = true;
        $user->save();
    }
}
