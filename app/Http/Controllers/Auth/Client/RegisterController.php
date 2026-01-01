<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Client\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Auth\RegisterClientService;

class RegisterController extends Controller
{

    protected $registerClientService;

    public function __construct(RegisterClientService $registerClientService){
        $this->registerClientService = $registerClientService;
    }

    
    public function showRegisterForm()
    {

        return view('auth.client.register', [
            'breadcrumbs' => [
                ['title' => 'Home', 'url' => route('guest.home.index')],
                ['title' => 'Register as User', 'url' => null],
            ],
        ]);
    }

  
    public function register(RegisterRequest $request)
    {
        
        $this->registerClientService->register($request->validated());
        // Redirect to login with success message
        return redirect()
            ->route('login')
            ->with('register_success', 'Registration successful. You can now log in.');

    }


}
