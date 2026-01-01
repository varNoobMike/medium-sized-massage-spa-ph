<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginService
{

    public function login(array $credentials)
    { 
        // Attempt to authenticate the user
        if (! Auth::attempt($credentials)) {

            throw ValidationException::withMessages([
                'auth_error' => 'Incorrect credentials.'
            ]);
            
        }

        // Regenerate session to prevent fixation
        session()->regenerate();
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }

}
