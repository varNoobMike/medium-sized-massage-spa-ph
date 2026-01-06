<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;


class LoginController extends Controller
{

    /* constructor */
    public function __construct(private AuthService $authService) {}


    /* show login form */
    public function showLoginForm()
    {
        return view('auth.login', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home.index')],
                ['title' => 'Login', 'url' => null],
            ],
        ]);
    }

    /* login */
    public function login(LoginRequest $request)
    {

        $user = $this->authService->login($request->validated());

        // Redirect based on role
        return match ($user->role) {
            'Admin' => redirect()->route('admin.dashboard.index'),
            'Therapist' => redirect()->route('therapist.dashboard.index'),
            'Client' => redirect()->route('client.home.index'),
            default => redirect('/'), // or change to abort later...
        };
    }

    /* logout */
    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login');
    }
}
