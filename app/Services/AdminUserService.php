<?php

namespace App\Services;

use App\Models\User;

/* Service class for `users` where role is Admin */

class AdminUserService
{

    public function getFirstAdmin()
    {
        return User::where('role', User::ROLE_ADMIN)
            ->first();
    }
}
