<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use App\Services\SpaService;


class RegisterTherapistUserController extends Controller
{

    protected AuthService $authService;
    protected SpaService $spaService;

    public function __construct(AuthService $authService,
                                SpaService $spaService)
    {
        $this->authService = $authService;
        $this->spaService = $spaService;
    }

    
    public function showRegisterForm()
    {

        return view('auth.therapist.register', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home.index')],
                ['title' => 'Register as Therapist', 'url' => null],
            ],
        ]);
    }

  
    public function register(RegisterUserRequest $request)
    {

        $validated = $request->validated();
        $role = 'Therapist';
        $spaId = $this->spaService->getMainBranch()->id;

        $this->authService->register($validated, $role, $spaId);

        // Redirect to Login 
        return redirect()
            ->route('login')
            ->with('register_success', 'Registration successful. You can now log in.');
            
    }



}
