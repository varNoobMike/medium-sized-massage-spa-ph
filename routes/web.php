<?php
// Shared
use App\Http\Controllers\AuthShared\AuthSharedLogoutController;

// Admin
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSpaProfileController;
use App\Http\Controllers\Admin\AdminTherapistController;
use App\Http\Controllers\Admin\AdminWeeklyScheduleController;

// Guest
use App\Http\Controllers\Guest\GuestHomeController;
use App\Http\Controllers\Guest\GuestLoginController;
use App\Http\Controllers\Guest\GuestRegisterClientController;


// Client
use App\Http\Controllers\Client\ClientHomeController;


// Therapist
use App\Http\Controllers\Therapist\TherapistDashboardController;
use App\Http\Controllers\Therapist\TherapistWeeklyScheduleController;

use Illuminate\Support\Facades\Route;

/******************************************************************************************** */

// Testings
Route::get('spa-profile', [AdminSpaProfileController::class, 'getSpaProfile']);
Route::get('spa-weekly-schedules', [AdminWeeklyScheduleController::class, 'getSpaWeeklySchedules']);
Route::get('my-weekly-schedules', [TherapistWeeklyScheduleController::class, 'getTherapistWeeklySchedules']);
Route::get('clients', [AdminClientController::class, 'getClients']);
Route::get('therapists', [AdminTherapistController::class, 'getTherapists']);

Route::get('/admin-id', function () {
    echo \App\Services\UserContext::getAdminID();
});
/******************************************************************************************** */

/* Guest Routes (note: use custom middleware 'redir_authenticated_by_role' to redirect based on role
instead of using default 'guest' middleware) */
Route::middleware('redir_authenticated_by_role')->group(function () {

    // Home
    Route::get('/', GuestHomeController::class)
        ->name('guest.home');

    // shared Login
    Route::get('login', [GuestLoginController::class, 'index'])
        ->name('login');  // Note: default route name 'login' for auth middleware redirection
    Route::post('login', [GuestLoginController::class, 'store'])
        ->name('login.store');

    // Client Register
    Route::get('register/user', [GuestRegisterClientController::class, 'index'])
        ->name('guest.register.client.index');
    Route::post('register/user', [GuestRegisterClientController::class, 'store'])
        ->name('guest.register.client.store');

});
/******************************************************************************************** */

// authenticated user shared Logout
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

        // create Spa Weekly Schedules
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
        Route::get('my-weekly-schedules', [TherapistWeeklyScheduleController::class, 'index'])->name('weekly-schedules.index');

        // create My Weekly Schedules
        // Route::post('my-weekly-schedules', [TherapistWeeklyScheduleController::class, 'store'])->name('weekly-schedules.store');

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
