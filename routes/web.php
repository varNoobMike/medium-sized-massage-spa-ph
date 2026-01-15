<?php

use Illuminate\Support\Facades\Route;


// Guest Routes 
Route::middleware('redir_authenticated_by_role')->group(function () {

    // Home
    Route::get('/', App\Http\Controllers\Guest\HomeController::class)
        ->name('guest.home.index');
});



// Login, Logout Routes
Route::controller(App\Http\Controllers\Auth\loginController::class)->group(function () {

    // Login
    Route::middleware('redir_authenticated_by_role')->group(function () {
        Route::get('login', 'showLoginForm')->name('login'); // built-in name 'login' by laravel
        Route::post('login', 'login')->name('login.submit');
    });

    // Logout
    Route::middleware('auth')->group(function () {
        Route::post('logout', 'logout')->name('logout');
    });
});


// Register Routes
Route::middleware('redir_authenticated_by_role')
        ->prefix('register')->name('register.')->group(function () {

    // Register Client
    Route::get('user', [App\Http\Controllers\Auth\Client\RegisterController::class, 'showRegisterForm'])
        ->name('client');
    Route::post('user', [App\Http\Controllers\Auth\Client\RegisterController::class, 'register'])
        ->name('client.submit');


    // Register Therapist
    Route::get('therapist', [App\Http\Controllers\Auth\Therapist\RegisterController::class, 'showRegisterForm'])
        ->name('therapist');
    Route::post('therapist', [App\Http\Controllers\Auth\Therapist\RegisterController::class, 'register'])
        ->name('therapist.submit');
});


// Admin Routes
Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)
            ->name('dashboard.index');
        Route::redirect('/', 'dashboard');

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

        // Spa Weekly Schedules (index, store, update) only
        Route::resource('spa-weekly-schedules', \App\Http\Controllers\Admin\SpaWeeklyScheduleController::class)
            ->only(['index', 'store', 'update'])
            ->parameters([
                'spa-weekly-schedules' => 'schedule'
            ]);
    });


// Therapist Routes
Route::middleware(['auth', 'role:Therapist'])
    ->prefix('therapist')
    ->name('therapist.')
    ->group(function () {

        // Dashboard
        Route::get('dashboard', \App\Http\Controllers\Therapist\DashboardController::class)
            ->name('dashboard.index');
        Route::redirect('/', 'dashboard');

        // Spa's Weekly Schedules (read only)
        Route::get('spa-weekly-schedules', \App\Http\Controllers\Therapist\SpaWeeklyScheduleController::class)
            ->name('spa-weekly-schedules.index');

        // Spa's Services (read only)
        Route::get('spa-services', \App\Http\Controllers\Therapist\ServiceController::class)
            ->name('services.index');
    });


// Client Routes (note: url disguised as 'user' instead of 'client' for better UX)
Route::middleware(['auth', 'role:Client'])
    ->prefix('user')
    ->name('client.')
    ->group(function () {

        // Home
        Route::get('home', \App\Http\Controllers\Client\HomeController::class)
            ->name('home.index');
        Route::redirect('/', 'home');

        // Bookings
        Route::get('bookings', [\App\Http\Controllers\Client\BookingController::class, 'index'])
            ->name('bookings.index');
        Route::get('bookings/book-session', [\App\Http\Controllers\Client\BookingController::class, 'create'])
            ->name('bookings.create');
        Route::post('bookings/book-session', [\App\Http\Controllers\Client\BookingController::class, 'store'])
            ->name('bookings.store');


    });
