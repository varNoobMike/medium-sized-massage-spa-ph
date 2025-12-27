<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSpaProfileController;
use App\Http\Controllers\Admin\AdminTherapistController;
use App\Http\Controllers\Admin\AdminWeeklyScheduleController;
use App\Http\Controllers\AuthShared\AuthSharedLogoutController;
// Therapist
use App\Http\Controllers\Therapist\TherapistDashboardController;

// Client
use App\Http\Controllers\Client\ClientHomeController;
use App\Http\Controllers\Guest\GuestHomeController;
// Guest
use App\Http\Controllers\Guest\GuestLoginController;

/******************************************************************************************** */


// Testings
Route::get('spa-profile', [AdminSpaProfileController::class, 'read']);
Route::get('spa-weekly-schedules', [AdminWeeklyScheduleController::class, 'read']);
Route::get('clients', [AdminClientController::class, 'read']);
Route::get('therapists', [AdminTherapistController::class, 'read']);
/******************************************************************************************** */

/* Guest Routes (note: use custom middleware 'redir_authenticated_by_role' to redirect based on role
instead of using default 'guest' middleware) */
Route::middleware('redir_authenticated_by_role')->group(function () {

    // Guest Home
    Route::get('/', GuestHomeController::class)
        ->name('guest.home');

    // Guest Shared Login
    Route::get('login', [GuestLoginController::class, 'create'])
        ->name('login');  // Note: default route name 'login' for auth middleware redirection
    Route::post('login', [GuestLoginController::class, 'store'])
        ->name('login.store');

});
/******************************************************************************************** */


// Authenticated User Shared Logout
Route::post('/logout', AuthSharedLogoutController::class)
    ->middleware('auth')
    ->name('logout.index');
/******************************************************************************************** */


// Admin
Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('dashboard', AdminDashboardController::class)->name('dashboard.index');

        // Clients
        Route::get('clients', [AdminClientController::class, 'index'])->name('clients.index');

        // Spa Profile
        Route::get('spa-profile', [AdminSpaProfileController::class, 'index'])->name('spa-profile.index');

        // Therapists
        Route::get('therapists', [AdminTherapistController::class, 'index'])->name('therapists.index');

        // Spa Weekly Schedules
        Route::get('spa-weekly-schedules', [AdminWeeklyScheduleController::class, 'index'])->name('spa-weekly-schedules.index');

        // Create Spa Weekly Schedules
        Route::post('spa-weekly-schedules', [AdminWeeklyScheduleController::class, 'store'])->name('spa-weekly-schedules.store');

    });
/******************************************************************************************** */


// Therapist (note: url disguised as 'massage-therapist' instead of 'therapist' for better UX)
Route::middleware(['auth', 'role:Therapist'])
    ->prefix('massage-therapist')
    ->name('therapist.')
    ->group(function () {

        // Dashboard
        Route::get('dashboard', TherapistDashboardController::class)->name('dashboard.index');

        // My Weekly Schedules
        // Route::get('my-weekly-schedules', [AdminWeeklyScheduleController::class, 'index'])->name('my-weekly-schedules.index');

        // Create My Weekly Schedules
        // Route::post('my-weekly-schedules', [AdminWeeklyScheduleController::class, 'store'])->name('my-weekly-schedules.store');

    });
/******************************************************************************************** */


// Client (note: url disguised as 'user' instead of 'client' for better UX)
Route::middleware(['auth', 'role:Client'])
    ->prefix('user')
    ->name('client.')
    ->group(function () {

        // Home
        Route::get('/home', ClientHomeController::class)->name('home.index');

    });
/******************************************************************************************** */
