<?php

namespace App\Services;

use App\Models\User;

// for testings only via seeds, remove later...
class TestService
{

    
    public function getFirstTherapist()
    {
        return User::where('role', 'Therapist')->first();
    }

    public function getSecondTherapist()
    {
        return User::where('role', 'Therapist')->skip(1)->first(); // second
    }

    public function getThirdTherapist()
    {
        return User::where('role', 'Therapist')->skip(2)->first(); // third
    }

}
