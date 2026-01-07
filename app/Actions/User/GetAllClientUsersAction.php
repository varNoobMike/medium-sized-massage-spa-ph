<?php

namespace App\Actions\User;

use App\Models\User;

class GetAllClientUsersAction
{
    /**
     * Get all client users, order by email
     * 
     */
    public function run()
    {
        return User::where('role', User::ROLE_CLIENT)
            ->orderBy('email')
            ->get();
    }
}
