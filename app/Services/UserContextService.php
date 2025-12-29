<?php

namespace App\Services;

use App\Models\User;

class UserContextService
{
     // for seeding + testings
    public static function getAdminID()
    {
        return User::where('role', 'Admin')->first()->id;
    }

    // for testings
    public static function getFirstTherapistID()
    {
        return User::where('role', 'Therapist')->first()->id;
    }

    // for testings
    public static function getSecondTherapistID()
    {
        return User::where('role', 'Therapist')->skip(1)->first()?->id; // second
    }

    // for testings
    public static function getThirdTherapistID()
    {
        return User::where('role', 'Therapist')->skip(2)->first()?->id; // third
    }

}
