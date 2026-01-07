<?php

namespace App\Actions\User;

use App\Models\User;

class GetAllTherapistUsersAction
{
    /**
     * Get all therapist users, order by email
     * 
     */
    public function run()
    {
        return User::where('role', User::ROLE_THERAPIST)
            ->orderBy('email')
            ->get();
    }
}
