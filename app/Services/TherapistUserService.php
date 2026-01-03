<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

// service class for therapist users
class TherapistUserService
{

    /* no create method yet, insertion is done via auth service's register method */

    public function getOne(int $userId)
    {
        return User::where('role', 'Therapist')->where('id', $userId)->orderBy('email')->get();
    }

    public function getAll()
    {
        return User::where('role', 'Therapist')->orderBy('email')->get();
    }

    public function approve(int $userId)
    {
        $userApproval = User::where('id', $userId)->update(['approved_at' => now()]);

        if(!$userApproval)
        {
            throw ValidationException::withMessages([
                'approve_therapist_error' => 'Failed to approve therapist.',
            ]);  
        }

        return $userApproval;

    }
    
}
