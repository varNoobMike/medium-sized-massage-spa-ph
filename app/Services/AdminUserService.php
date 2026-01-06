<?php

namespace App\Services;

use App\Models\User;


class AdminUserService
{

    public function getFirstAdmin()
    {
        return User::where('role', User::ROLE_ADMIN)
            ->first();
    }
    
}
