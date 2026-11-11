<?php

use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicContentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Login, Mobile-First)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicContentController::class, 'home'])->name('home');
Route::get('/jenis', [PublicContentController::class, 'jenis'])->name('public.jenis');
Route::get('/tanda-gejala', [PublicContentController::class, 'tandaGejala'])->name('public.tanda-gejala');
Route::get('/cara-pencegahan', [PublicContentController::class, 'caraPencegahan'])->name('public.cara-pencegahan');
Route::get('/video', [PublicContentController::class, 'video'])->name('public.video');
Route::post('/video/track', [PublicContentController::class, 'trackVideo'])->name('public.video.track');
Route::post('/visitor/identify', [PublicContentController::class, 'identifyVisitor'])->name('public.visitor.identify');

Route::view('/privacy-policy', 'legal.privacy')->name('privacy');

/*
|--------------------------------------------------------------------------
| Admin Authentication & Profile
|--------------------------------------------------------------------------
*/
Route::get('/password/update-required', [PasswordController::class, 'create'])
    ->middleware(['auth', 'active', 'activity'])
    ->name('password.change-required');
Route::put('/password', [PasswordController::class, 'update'])
    ->middleware(['auth', 'active', 'activity', 'password.changed'])
    ->name('password.update');

Route::middleware(['auth', 'active', 'activity', 'password.changed'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});

/*
|--------------------------------------------------------------------------
| Admin Portal (Satu-satunya area login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active', 'role:admin', 'activity', 'password.changed'])->prefix('admin')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('admin.dashboard');

    // Aktivitas
    Route::get('/aktivitas', [AdminActivityController::class, 'index'])->name('admin.activity');

    // Kelola Konten
    Route::get('/konten', [AdminContentController::class, 'index'])->name('admin.content');
    Route::get('/konten/{section}/edit', [AdminContentController::class, 'edit'])->name('admin.content.edit');
    Route::put('/konten/{section}', [AdminContentController::class, 'update'])->name('admin.content.update');
    Route::post('/konten/preview', [AdminContentController::class, 'preview'])->name('admin.content.preview');

    // Kelola Video
    Route::get('/video', [AdminVideoController::class, 'index'])->name('admin.videos');
    Route::get('/video/tambah', [AdminVideoController::class, 'create'])->name('admin.videos.create');
    Route::post('/video', [AdminVideoController::class, 'store'])->name('admin.videos.store');
    Route::get('/video/{video}/ubah', [AdminVideoController::class, 'edit'])->name('admin.videos.edit');
    Route::patch('/video/{video}', [AdminVideoController::class, 'update'])->name('admin.videos.update');
    Route::delete('/video/{video}', [AdminVideoController::class, 'destroy'])->name('admin.videos.destroy');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('admin.profile');
});

require __DIR__.'/auth.php';
