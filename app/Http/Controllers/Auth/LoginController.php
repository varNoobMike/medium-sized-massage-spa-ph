<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;


class LoginController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }


    public function showLoginForm()
    {
        return view('auth.login', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home.index')],
                ['title' => 'Login', 'url' => null],
            ],
        ]);
    }


    public function login(LoginRequest $request)
    {
     
        $validated = $request->validated();
        $user = $this->authService->login($validated);

        // Redirect based on role
        return match ($user->role) {
            'Admin' => redirect()->route('admin.dashboard.index'),
            'Therapist' => redirect()->route('therapist.dashboard.index'),
            'Client' => redirect()->route('client.home.index'),
             default => redirect('/'), // or change to abort later...
        };
        
    }


    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login');
    }

    
}
