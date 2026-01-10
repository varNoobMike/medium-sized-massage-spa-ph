<?php

namespace App\Services\User;

use Illuminate\Support\Collection;
use App\Models\User;


class TherapistService
{
    /**
     * Create Therapist
     * 
     */
    public function createTherapist(array $createTherapistData): User|null
    {
        return User::create([
            'name' => $createTherapistData['name'],
            'email' => $createTherapistData['email'],
            'password' => $createTherapistData['password'],
            'role' => User::ROLE_THERAPIST,
        ]);
    }

    /**
     * Get therapists
     * 
     */
    public function getTherapists(): Collection
    {
        return User::where('role', User::ROLE_THERAPIST)
            ->orderBy('email')
            ->get();
    }
}
