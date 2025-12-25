<?php

// Admin
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSpaProfileController;
use App\Http\Controllers\Admin\AdminWeeklyScheduleController;
// Client
use App\Http\Controllers\AuthShared\AuthSharedLogoutController;
use App\Http\Controllers\Client\ClientHomeController;
// Guest
use App\Http\Controllers\Guest\GuestHomeController;
use App\Http\Controllers\Guest\GuestLoginController;
use Illuminate\Support\Facades\Route;

// Testings
Route::get('spa-profile', [AdminSpaProfileController::class, 'read']);
Route::get('weekly-schedules', [AdminWeeklyScheduleController::class, 'read']);



// Authentication
// Login (custom middleware 'redir_authenticated' used instead of default 'guest')
Route::middleware('redir_authenticated')->group(function () {

    // Home
    Route::get('/', GuestHomeController::class)->name('home');
    Route::redirect('/home', '/', 301);

    // Login
    Route::get('/login', [GuestLoginController::class, 'create'])
        ->name('login');  // note: use laravel default route name 'login'
    Route::post('/login', [GuestLoginController::class, 'store'])
        ->name('login.store');

});

// Logout
Route::post('/logout', AuthSharedLogoutController::class)
    ->middleware('auth')
    ->name('logout');

// Admin
Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::redirect('/dashboard', '/', 301);
        Route::redirect('/home', '/', 301);

        // Spa Profile
        Route::get('spa-profile', AdminSpaProfileController::class)->name('spa-profile');

        // Weekly Schedules
        Route::get('weekly-schedules', AdminWeeklyScheduleController::class)->name('weekly-schedules');

    });

// Client
Route::middleware(['auth', 'role:Client'])
    ->prefix('client')
    ->name('client.')
    ->group(function () {

        // Home
        Route::get('/', ClientHomeController::class)->name('home');
        Route::redirect('/home', '/', 301);

    });
