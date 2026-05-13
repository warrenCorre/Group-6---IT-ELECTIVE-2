<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;

// Public routes
Route::get('/', function () {
    return view('home');
})->name('home');

// Storage proxy – serves files from storage/app/public directly.
// This bypasses the Windows symlink issue when using `php artisan serve`.
Route::get('/storage-file/{folder}/{filename}', function (string $folder, string $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $mime = mime_content_type($path);
    return response()->file($path, ['Content-Type' => $mime]);
})->where(['folder' => '[a-zA-Z0-9_\-]+', 'filename' => '[a-zA-Z0-9_\-\.]+'])->name('storage.file');

// Public View Team - Anyone can view (no login required)
Route::get('/team', [MemberController::class, 'publicIndex'])->name('team.public');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Members list (View Team for logged-in users)
    Route::get('/members', [MemberController::class, 'index'])->name('members.list');

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    });

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/members', [AdminController::class, 'members'])->name('members');
        Route::get('/members/create', [AdminController::class, 'createMember'])->name('members.create');
        Route::post('/members', [AdminController::class, 'storeMember'])->name('members.store');
        Route::get('/members/{user}/edit', [AdminController::class, 'editMember'])->name('members.edit');
        Route::post('/members/{user}/update', [AdminController::class, 'updateMember'])->name('members.update');
        Route::post('/members/{user}/destroy', [AdminController::class, 'destroy'])->name('members.destroy');
    });
});