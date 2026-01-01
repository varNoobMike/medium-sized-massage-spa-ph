<?php

namespace App\Services;

use App\Models\User;

class TherapistService
{
    public function get(string $id)
    {
        return User::where('role', 'Therapist')->where('id', $id)->orderBy('email')->get();
    }

    public function getAll()
    {
        return User::where('role', 'Therapist')->orderBy('email')->get();
    }
    
}
