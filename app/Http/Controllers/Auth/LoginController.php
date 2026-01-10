<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Services\AuthService;


class LoginController extends Controller
{

    /**
     * Constructor
     * 
     */
    public function __construct(private AuthService $service) {}


    /**
     * Show login user form
     * 
     */
    public function showLoginForm()
    {
        return view('auth.login', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home.index')],
                ['title' => 'Login', 'url' => null],
            ],
        ]);
    }

    /**
     * Login user
     * 
     */
    public function login(LoginUserRequest $request)
    {

        $user = $this->service->login($request->validated());

        return match ($user->role) {
            'Admin' => redirect()->route('admin.dashboard.index'),
            'Therapist' => redirect()->route('therapist.dashboard.index'),
            'Client' => redirect()->route('client.home.index'),
            default => abort(403, 'Unauthorized role.'),
        };
    }



    /**
     * Logout user
     */
    public function logout()
    {
        $this->service->logout();
        return redirect()->route('login')
            ->with('logout_success', 'You have been logged out successfully.');
    }
}
