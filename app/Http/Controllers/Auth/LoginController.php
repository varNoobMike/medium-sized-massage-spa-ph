<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Exceptions\CustomDomainException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;


class LoginController extends Controller
{

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
    public function login(LoginRequest $request, LoginUserAction $action)
    {

        try {
            $user = $action->run($request->validated());

            return match ($user->role) {
                'Admin' => redirect()->route('admin.dashboard.index'),
                'Therapist' => redirect()->route('therapist.dashboard.index'),
                'Client' => redirect()->route('client.home.index'),
                default => abort(403, 'Unauthorized role.'),
            };
        } catch (CustomDomainException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['auth_error' => 'Invalid email or password.']);
        }
    }



    /**
     * Logout user
     */
    public function logout(LogoutUserAction $action)
    {
        $action->run();
        return redirect()->route('login')
            ->with('logout_success', 'You have been logged out successfully.');
    }
}
