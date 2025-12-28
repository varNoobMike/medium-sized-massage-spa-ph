<?php

namespace App\Services;

use App\Models\User;

class UserContext
{
    public static function getAdminID()
    {
        return User::where('role', 'Admin')->first()->id;
    }

    public static function getFirstTherapistID()
    {
        return User::where('role', 'Therapist')->first()->id;
    }

    public static function getSecondTherapistID()
    {
        return User::where('role', 'Therapist')->skip(1)->first()?->id; // second
    }

    public static function getThirdTherapistID()
    {
        return User::where('role', 'Therapist')->skip(2)->first()?->id; // third
    }

}
