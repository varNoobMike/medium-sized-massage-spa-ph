<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use App\Services\AuthService;


class RegisterController extends Controller
{

    /**
     * Constructor
     * 
     */
    public function __construct(private AuthService $service) {}


    /** 
     * Show register client form 
     * 
     */
    public function showRegisterForm()
    {

        return view('auth.client.register', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home.index')],
                ['title' => 'Register as User', 'url' => null],
            ],
        ]);
    }


    /** 
     * Register client
     * 
     */
    public function register(RegisterUserRequest $request)
    {
        $this->service->register($request->validated(), User::ROLE_CLIENT);

        return redirect()
            ->route('login')
            ->with('register_success', 'Registration successful. You can now log in.');
    }
}
