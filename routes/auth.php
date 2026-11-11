<?php

use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Satu-satunya pintu masuk login: Portal Admin
    Route::get('admin/masuk', [AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('admin/masuk', [AdminAuthenticatedSessionController::class, 'store']);

    // Redirect rute login lama ke admin login
    Route::get('login', fn () => redirect()->route('admin.login'))->name('login');
    Route::get('register', fn () => redirect()->route('home'))->name('register');
});

Route::middleware(['auth', 'active', 'activity', 'password.changed'])->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
