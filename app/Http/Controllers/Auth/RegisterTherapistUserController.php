<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\RegisterUserAction;
use App\Exceptions\CustomDomainException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;


class RegisterTherapistUserController extends Controller
{

    /**
     * Show register use form
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
     * Register therapist user
     * 
     */
    public function register(RegisterUserRequest $request, RegisterUserAction $action)
    {

        try {
            $action->run($request->validated(), 'Therapist');

            // Redirect to login
            return redirect()
                ->route('login')
                ->with('register_success', 'Registration successful. You can now log in.');
        } catch (CustomDomainException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['register_error' =>  "Failed to register as 'therapist'."]);
        }
    }
}
