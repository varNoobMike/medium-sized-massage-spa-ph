<?php

namespace App\Services;

use App\Models\User;

class TestService
{
    
    // for testing seed so is set to 'static'
    public static function getFirstTherapist()
    {
        return User::where('role', 'Therapist')->first();
    }

    // for testing seed so is set to 'static'
    public static function getSecondTherapist()
    {
        return User::where('role', 'Therapist')->skip(1)->first(); // second
    }

    // for testing seed so is set to 'static'
    public static function getThirdTherapist()
    {
        return User::where('role', 'Therapist')->skip(2)->first(); // third
    }

}
