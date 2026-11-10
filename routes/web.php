<?php

use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MaterialController as AdminMaterialController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\TestSettingController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentActivityController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentLessonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/privacy-policy', 'legal.privacy')->name('privacy');

Route::get('/password/update-required', [PasswordController::class, 'create'])
    ->middleware(['auth', 'active', 'activity'])
    ->name('password.change-required');
Route::put('/password', [PasswordController::class, 'update'])
    ->middleware(['auth', 'active', 'activity', 'password.changed'])
    ->name('password.update');

Route::get('/dashboard', StudentDashboardController::class)
    ->middleware(['auth', 'active', 'role:siswi', 'activity', 'password.changed'])
    ->name('dashboard');

Route::middleware(['auth', 'active', 'role:siswi', 'activity', 'password.changed'])->group(function () {
    Route::get('/siswi/pretest', [StudentActivityController::class, 'showTest'])
        ->defaults('testType', 'pretest')
        ->name('student.pretest');
    Route::get('/siswi/posttest', [StudentActivityController::class, 'showTest'])
        ->defaults('testType', 'posttest')
        ->middleware('material.done')
        ->name('student.posttest');
    Route::post('/siswi/{testType}/jawaban', [StudentActivityController::class, 'saveAnswer'])
        ->whereIn('testType', ['pretest', 'posttest'])
        ->middleware('material.done')
        ->name('student.test.answer');
    Route::post('/siswi/{testType}/selesai', [StudentActivityController::class, 'completeTest'])
        ->whereIn('testType', ['pretest', 'posttest'])
        ->middleware('material.done')
        ->name('student.test.complete');
    Route::post('/siswi/video/playback', [StudentActivityController::class, 'recordVideoPlayback'])
        ->middleware('pretest.done')
        ->name('student.video.playback');
    Route::get('/siswi/video', [StudentActivityController::class, 'videos'])
        ->middleware('pretest.done')
        ->name('student.video');
    Route::get('/siswi/hasil', [StudentActivityController::class, 'results'])->name('student.results');
    Route::get('/siswi/terkunci', [StudentActivityController::class, 'locked'])->name('student.locked');

    Route::get('/siswi/materi/{slug}', [StudentLessonController::class, 'show'])
        ->middleware('pretest.done')
        ->name('student.lesson.show');
    Route::post('/siswi/materi/{material}/selesai', [StudentActivityController::class, 'completeLesson'])
        ->middleware('pretest.done')
        ->name('student.lesson.complete');

    Route::get('/siswi/profil', [ProfileController::class, 'edit'])->name('student.profile');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'active', 'activity', 'password.changed'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});

Route::middleware(['auth', 'active', 'role:admin', 'activity', 'password.changed'])->prefix('admin')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('admin.dashboard');
    Route::get('/siswi', [AdminStudentController::class, 'index'])->name('admin.students');
    Route::get('/siswi/tambah', [AdminStudentController::class, 'create'])->name('admin.students.create');
    Route::post('/siswi', [AdminStudentController::class, 'store'])->name('admin.students.store');
    Route::get('/siswi/{user}/ubah', [AdminStudentController::class, 'edit'])->name('admin.students.edit');
    Route::patch('/siswi/{user}', [AdminStudentController::class, 'update'])->name('admin.students.update');
    Route::patch('/siswi/{user}/status', [AdminStudentController::class, 'updateStatus'])->name('admin.students.status');
    Route::post('/siswi/{user}/reset-sandi', [AdminStudentController::class, 'resetPassword'])->name('admin.students.reset-password');
    Route::get('/siswi/{user}', [AdminStudentController::class, 'show'])->name('admin.student-detail');
    Route::post('/siswi/impor', [AdminReportController::class, 'importStudents'])->name('admin.students.import');
    Route::get('/materi', [AdminMaterialController::class, 'index'])->name('admin.materials');
    Route::get('/materi/tambah', [AdminMaterialController::class, 'create'])->name('admin.materials.create');
    Route::post('/materi', [AdminMaterialController::class, 'store'])->name('admin.materials.store');
    Route::get('/materi/{material}/ubah', [AdminMaterialController::class, 'edit'])->name('admin.materials.edit');
    Route::patch('/materi/{material}', [AdminMaterialController::class, 'update'])->name('admin.materials.update');
    Route::delete('/materi/{material}', [AdminMaterialController::class, 'destroy'])->name('admin.materials.destroy');
    Route::get('/materi/editor-contoh', fn () => redirect()->route('admin.materials.create'));
    Route::get('/video', [AdminVideoController::class, 'index'])->name('admin.videos');
    Route::get('/video/tambah', [AdminVideoController::class, 'create'])->name('admin.videos.create');
    Route::post('/video', [AdminVideoController::class, 'store'])->name('admin.videos.store');
    Route::get('/video/{video}/ubah', [AdminVideoController::class, 'edit'])->name('admin.videos.edit');
    Route::patch('/video/{video}', [AdminVideoController::class, 'update'])->name('admin.videos.update');
    Route::delete('/video/{video}', [AdminVideoController::class, 'destroy'])->name('admin.videos.destroy');
    Route::get('/soal', [AdminQuestionController::class, 'index'])->name('admin.questions');
    Route::post('/soal/impor', [AdminReportController::class, 'importQuestions'])->name('admin.questions.import');
    Route::get('/soal/ekspor', [AdminReportController::class, 'exportQuestions'])->name('admin.questions.export');
    Route::get('/soal/tambah', [AdminQuestionController::class, 'create'])->name('admin.questions.create');
    Route::post('/soal', [AdminQuestionController::class, 'store'])->name('admin.questions.store');
    Route::get('/soal/{question}/ubah', [AdminQuestionController::class, 'edit'])->name('admin.questions.edit');
    Route::patch('/soal/{question}', [AdminQuestionController::class, 'update'])->name('admin.questions.update');
    Route::delete('/soal/{question}', [AdminQuestionController::class, 'destroy'])->name('admin.questions.destroy');
    Route::get('/kuesioner', fn () => redirect()->route('admin.questions'));
    Route::get('/tes', [TestSettingController::class, 'index'])->name('admin.tests');
    Route::put('/tes/{type}', [TestSettingController::class, 'update'])->name('admin.tests.update');
    Route::get('/hasil-tes', [AdminReportController::class, 'pairedResults'])->name('admin.paired-results');
    Route::get('/hasil-tes/ekspor/excel', [AdminReportController::class, 'exportExcel'])->name('admin.reports.excel');
    Route::get('/hasil-tes/ekspor/pdf', [AdminReportController::class, 'exportPdf'])->name('admin.reports.pdf');
    Route::get('/laporan', [AdminReportController::class, 'index'])->name('admin.reports');
    Route::get('/aktivitas', [AdminActivityController::class, 'index'])->name('admin.activity');
    Route::get('/pengaturan-situs', [SiteSettingController::class, 'index'])->name('admin.settings');
    Route::put('/pengaturan-situs', [SiteSettingController::class, 'update'])->name('admin.settings.update');
    Route::get('/profil', [ProfileController::class, 'edit'])->name('admin.profile');
});

require __DIR__.'/auth.php';
