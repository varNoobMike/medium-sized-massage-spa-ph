<?php

use Illuminate\Support\Facades\Route;


/******************************************************************************************** */
// Guest Routes 
Route::middleware('redir_authenticated_by_role')->group(function () {

    // Home
    Route::get('/', App\Http\Controllers\Guest\HomeController::class)
        ->name('guest.home.index');
});


/******************************************************************************************** */
// Login & Logout
Route::controller(App\Http\Controllers\Auth\loginController::class)->group(function () {

    // Login
    Route::middleware('redir_authenticated_by_role')->group(function () {
        Route::get('login', 'showLoginForm')->name('login'); // use built-in route name 'login' by laravel
        Route::post('login', 'login')->name('login.submit');
    });

    // Logout
    Route::middleware('auth')->group(function () {
        Route::post('logout', 'logout')->name('logout');
    });
});


/******************************************************************************************** */
// Registration Routes
Route::prefix('register')->name('register.')->group(function () {

    // Client (User) Registration
    Route::get('user', [App\Http\Controllers\Auth\RegisterClientUserController::class, 'showRegisterForm'])
        ->name('client');
    Route::post('user', [App\Http\Controllers\Auth\RegisterClientUserController::class, 'register'])
        ->name('client.submit');


    // Therapist Registration
    Route::get('therapist', [App\Http\Controllers\Auth\RegisterTherapistUserController::class, 'showRegisterForm'])
        ->name('therapist');
    Route::post('therapist', [App\Http\Controllers\Auth\RegisterTherapistUserController::class, 'register'])
        ->name('therapist.submit');
});


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
        Route::get('clients', [\App\Http\Controllers\Admin\CLientController::class, 'index'])
            ->name('clients.index');

        // Spa Profile
        Route::get('spa-profile', [\App\Http\Controllers\Admin\SpaProfileController::class, 'index'])
            ->name('spa-profile.index');

        // Services
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)
            ->only('index');

        // Therapists
        Route::get('therapists', [\App\Http\Controllers\Admin\TherapistController::class, 'index'])
            ->name('therapists.index');
        Route::put('therapists/{therapist}', [\App\Http\Controllers\Admin\TherapistController::class, 'approve'])
            ->name('therapists.approve');

        // Spa Weekly Schedules (index, update) only
        Route::resource('spa-weekly-schedules', \App\Http\Controllers\Admin\SpaWeeklyScheduleController::class)
            ->only(['index', 'update']);
    });


/******************************************************************************************** */
// Therapist
Route::middleware(['auth', 'role:Therapist'])
    ->prefix('therapist')
    ->name('therapist.')
    ->group(function () {

        // Dashboard
        Route::get('dashboard', \App\Http\Controllers\Therapist\DashboardController::class)
            ->name('dashboard.index');

        // Weekly Schedules (index, update) only
        Route::resource('weekly-schedules', \App\Http\Controllers\Therapist\WeeklyScheduleController::class)
            ->only(['index', 'update']);

        // Spa's Weekly Schedules (read only)
        Route::get('spa-weekly-schedules', \App\Http\Controllers\Therapist\SpaWeeklyScheduleController::class)
            ->name('spa-weekly-schedules.index');

        // Spa's Services (read only)
        Route::get('spa-services', \App\Http\Controllers\Therapist\ServiceController::class)
            ->name('services.index');
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
