<?php

namespace App\Http\Controllers\Auth\Therapist;

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
     * Show register therapist form
     * 
     */
    public function showRegisterForm()
    {

        return view('auth.therapist.register', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home.index')],
                ['title' => 'Register as Therapist', 'url' => null],
            ],
        ]);
    }

    /** 
     * Register therapist
     * 
     */
    public function register(RegisterUserRequest $request)
    {
        $this->service->register($request->validated(), User::ROLE_THERAPIST);
    }
}
