<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(LoginService $authService){
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

        $this->authService->login($request->validated());

        // Redirect based on role
        return match (Auth::user()->role) {
            'Admin' => redirect()->route('admin.dashboard.index'),
            'Therapist' => redirect()->route('therapist.dashboard.index'),
            'Client' => redirect()->route('client.home.index'),
            default => redirect('/'),
        };

    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login');
    }
    
}
