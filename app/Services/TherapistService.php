<?php

namespace App\Services;

use App\Exceptions\Auth\RegisterFailedException;
use App\Exceptions\SpaWeeklySchedule\ThreapistAlreadyApprovedException;
use App\Exceptions\SpaWeeklySchedule\ThreapistApproveFailedException;
use Illuminate\Support\Collection;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class TherapistService
{
    /**
     * Create Therapist
     * 
     */
    public function createTherapist(array $createTherapistData): User|null
    {
        $therapist =  User::create([
            'name' => $createTherapistData['name'],
            'email' => $createTherapistData['email'],
            'password' => $createTherapistData['password'],
            'role' => User::ROLE_THERAPIST,
        ]);

        if (!$therapist) {
            throw new RegisterFailedException("Failed to register as therapist for '{$createTherapistData['email']}'.");
        }

        return $therapist;
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


    public function approveTherapist(User $therapist): User|null
    {

        if ($therapist->approved_at) {
            throw new ThreapistAlreadyApprovedException($therapist, "Couldn't perform action. Therapist '$therapist->email' was already approved!");
        }


        return DB::transaction(function () use ($therapist) {
            $updated = $therapist->update([
                'approved_at' => now(),
            ]);


            if (! $updated) {
                throw new ThreapistApproveFailedException(
                    $therapist,
                    "Failed to approve therapist '$therapist->email'."
                );
            }

            return $therapist->refresh();
        });
    }
}
