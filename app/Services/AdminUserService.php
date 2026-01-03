<?php

namespace App\Services;

use App\Models\User;


class AdminUserService
{

    // the one and only admin
    public function getOne()
    {
        return User::where('role', 'Admin')
            ->first();
    }

   

}
