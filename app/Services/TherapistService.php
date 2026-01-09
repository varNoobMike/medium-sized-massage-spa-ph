<?php

namespace App\Services;

use App\Models\User;


class TherapistService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        # code
    }


    /**
     * Get therapists
     * 
     */
    public function getTherapists()
    {
        return User::where('role', User::ROLE_THERAPIST)
            ->orderBy('email')
            ->get();
    }
}
