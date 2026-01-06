<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;

class RegisterClientUserController extends Controller
{

    /* constructor */
    public function __construct(private AuthService $authService) {}


    /* show register form */
    public function showRegisterForm()
    {

        return view('auth.client.register', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home.index')],
                ['title' => 'Register as User', 'url' => null],
            ],
        ]);
    }

    /* register */
    public function register(RegisterUserRequest $request)
    {

        $this->authService->register(
            $request->validated(),
            'Client' // role
        );

        // Redirect to Login
        return redirect()
            ->route('login')
            ->with('register_success', 'Registration successful. You can now log in.');
    }
}
