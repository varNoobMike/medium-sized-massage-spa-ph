<?php

namespace App\Actions\Auth;

use App\Exceptions\CustomDomainException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LoginUserAction
{

    /**
     * Login user
     * 
     */
    public function run(array $credentials): User
    {

        // Attempt to authenticate the user
        if (! Auth::attempt($credentials)) {
            throw new CustomDomainException();
        }

        request()->session()->regenerate();

        return Auth::user();
    }
}
