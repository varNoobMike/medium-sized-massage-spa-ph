<?php

use Illuminate\Support\Facades\Auth;

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

/******************************************************************************************** */



/* Login (note: use custom middleware 'redir_authenticated_by_role' to redirect based on role 
instead of using default 'guest' middleware) */
Route::middleware('redir_authenticated_by_role')->group(function () {

    Route::get('/', GuestHomeController::class)
        ->name('guest.home');

    Route::get('login', [GuestLoginController::class, 'create'])
        ->name('login');  // Note: default route name 'login' for auth middleware redirection
    Route::post('login', [GuestLoginController::class, 'store'])
        ->name('login.store');

});


// Logout
Route::post('/logout', AuthSharedLogoutController::class)
    ->middleware('auth')
    ->name('logout.index');


// Admin
Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('dashboard', AdminDashboardController::class)->name('dashboard.index');

        // Spa Profile
        Route::get('spa-profile', [AdminSpaProfileController::class, 'index'])->name('spa-profile.index');

        // Weekly Schedules
        Route::get('weekly-schedules', [AdminWeeklyScheduleController::class, 'index'])->name('weekly-schedules.index');

        // Create Weekly Schedules
        Route::post('weekly-schedules', [AdminWeeklyScheduleController::class, 'store'])->name('weekly-schedules.store');


    });



// Client (note: url disguised as 'user' instead of 'client' for better UX)
Route::middleware(['auth', 'role:Client'])
    ->prefix('user')
    ->name('client.')
    ->group(function () {

        // Home
        Route::get('/home', ClientHomeController::class)->name('home.index');

    });

