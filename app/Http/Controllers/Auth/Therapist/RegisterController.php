<?php

namespace App\Http\Controllers\Auth\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Therapist\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Auth\RegisterTherapistService;

class RegisterController extends Controller
{

    protected $registerTherapistService;

    public function __construct(RegisterTherapistService $registerTherapistService){
        $this->registerTherapistService = $registerTherapistService;
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

  
    public function register(RegisterRequest $request)
    {
        
        $this->registerTherapistService->register($request->validated());
        // Redirect to login with success message
        return redirect()
            ->route('login')
            ->with('register_success', 'Registration successful. You can now log in.');

    }


}
