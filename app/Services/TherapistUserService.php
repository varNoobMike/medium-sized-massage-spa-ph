<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class TherapistUserService
{

    /* no create method yet, insertion is done via auth service's register method */

    public function getTherapistById(int $userId)
    {
        return User::where('role', User::ROLE_THERAPIST)
            ->where('id', $userId)
            ->orderBy('email')->get();
    }

    public function getAllTherapists()
    {
        return User::where('role', User::ROLE_THERAPIST)
            ->orderBy('email')->get();
    }

    public function approveTherapist(User $therapist)
    {
        $approved = $therapist->update([
            'approved_at' => now(),
        ]);

        if (!$approved) {
            throw ValidationException::withMessages([
                'approve_therapist_error' => 'Failed to approve therapist.',
            ]);
        }

        return $approved;
    }
}
