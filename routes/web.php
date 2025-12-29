<?php

// Shared
use App\Http\Controllers\Admin\AdminClientController;
// Admin
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSpaProfileController;
use App\Http\Controllers\Admin\AdminSpaWeeklyScheduleController;
use App\Http\Controllers\Admin\AdminTherapistController;
use App\Http\Controllers\AuthShared\AuthSharedLogoutController;
// Guest
use App\Http\Controllers\Client\ClientHomeController;
use App\Http\Controllers\Guest\GuestHomeController;
use App\Http\Controllers\Guest\GuestLoginController;
// Client
use App\Http\Controllers\Guest\GuestRegisterClientController;
// Therapist
use App\Http\Controllers\Therapist\TherapistDashboardController;
use App\Http\Controllers\Therapist\TherapistWeeklyScheduleController;
use Illuminate\Support\Facades\Route;

/******************************************************************************************** */

// Testings via URL
Route::get('spa-profile', [AdminSpaProfileController::class, 'getSpaProfile']);
Route::get('spa-weekly-schedules', [AdminSpaWeeklyScheduleController::class, 'getSpaWeeklySchedules']);
Route::get('my-weekly-schedules', [TherapistWeeklyScheduleController::class, 'getTherapistWeeklySchedules']);
Route::get('clients', [AdminClientController::class, 'getClients']);
Route::get('therapists', [AdminTherapistController::class, 'getTherapists']);

Route::get('/admin-id', function () {
    echo \App\Services\UserContextService::getAdminID();
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
        Route::get('dashboard', AdminDashboardController::class)
            ->name('dashboard.index');

        // Clients
        Route::get('clients', [AdminClientController::class, 'index'])
            ->name('clients.index');

        // Spa Profile
        Route::get('spa-profile', [AdminSpaProfileController::class, 'index'])
            ->name('spa-profile.index');

        // Therapists
        Route::get('therapists', [AdminTherapistController::class, 'index'])
            ->name('therapists.index');

        // Spa Weekly Schedules (index, update) only
        Route::resource('spa-weekly-schedules', AdminSpaWeeklyScheduleController::class)
            ->only(['index', 'update']);

    });

/******************************************************************************************** */

// Therapist (note: url disguised as 'massage-therapist' instead of 'therapist' for better UX)
Route::middleware(['auth', 'role:Therapist'])
    ->prefix('massage-therapist')
    ->name('therapist.')
    ->group(function () {

        // Dashboard
        Route::get('dashboard', TherapistDashboardController::class)->name('dashboard.index');

        // Weekly Schedules (index, update) only
        Route::resource('weekly-schedules', TherapistWeeklyScheduleController::class)
            ->only(['index', 'update']);

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
