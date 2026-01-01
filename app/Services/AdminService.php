<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    // is for seeding also and so is set to 'static'
    public static function getAdmin()
    {
        return User::where('role', 'Admin')->first();
    }

   

}
