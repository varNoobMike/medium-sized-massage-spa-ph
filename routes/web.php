<?php

// Shared
// Admin
use App\Http\Controllers\Admin\AdminSpaWeeklyScheduleController;
// Guest
use App\Http\Controllers\Guest\GuestHomeController;
use App\Http\Controllers\Guest\GuestRegisterClientController;
// Client
use App\Http\Controllers\Guest\GuestRegisterTherapistController;
// Therapist
use App\Http\Controllers\Therapist\TherapistDashboardController;
use App\Http\Controllers\Therapist\TherapistWeeklyScheduleController;
// Route facade
use Illuminate\Support\Facades\Route;

/******************************************************************************************** */


/******************************************************************************************** */

// Guest Routes 
Route::middleware('redir_authenticated_by_role')->group(function () {

    // Home
    Route::get('/', GuestHomeController::class)
        ->name('guest.home');

    // Registration Routes
    Route::prefix('register')->name('guest.register.')->group(function () {

        // Client (User) Registration
        Route::get('user', [GuestRegisterClientController::class, 'create'])
            ->name('client.create');
        Route::post('user', [GuestRegisterClientController::class, 'store'])
            ->name('client.store');

        // Therapist Registration
        Route::get('massage-therapist', [GuestRegisterTherapistController::class, 'create'])
            ->name('therapist.create');
        Route::post('massage-therapist', [GuestRegisterTherapistController::class, 'store'])
            ->name('therapist.store');

    });

});

/******************************************************************************************** */
// Authentication Routes at Guest State
Route::middleware('redir_authenticated_by_role')->group(function () {
    // Login
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showForm'])
        ->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'submitForm'])
        ->name('login');
});

// Authentication Routes at Auth State
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
        ->name('logout');
});
/******************************************************************************************** */

/******************************************************************************************** */

// Admin
Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)
            ->name('dashboard.index');

        // Clients
        Route::get('clients', [\App\Http\Controllers\Admin\ClientController::class, 'index'])
            ->name('clients.index');

        // Spa Profile
        Route::get('spa-profile', [\App\Http\Controllers\Admin\SpaProfileController::class, 'index'])
            ->name('spa-profile.index');

        // Therapists
        Route::get('therapists', [\App\Http\Controllers\Admin\TherapistController::class, 'index'])
            ->name('therapists.index');

        // Spa Weekly Schedules (index, update) only
        Route::resource('spa-weekly-schedules', \App\Http\Controllers\Admin\SpaWeeklyScheduleController::class)
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
        Route::get('home', \App\Http\Controllers\Client\HomeController::class)->name('home.index');

    });
/******************************************************************************************** */
