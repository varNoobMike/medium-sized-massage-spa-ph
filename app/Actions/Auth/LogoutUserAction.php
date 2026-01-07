<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutUserAction
{

    /**
     * Logout user
     * 
     */
    public function run()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return true;
    }
}
