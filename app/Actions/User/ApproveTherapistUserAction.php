<?php

/*

namespace App\Actions\User;

use App\Actions\SpaWeeklySchedule\GetAllSpaWeeklySchedulesAction;
use App\Exceptions\CustomDomainException;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class ApproveTherapistUserAction
{

    public function __construct(protected GetAllSpaWeeklySchedulesAction $getSchedulesAction) {}
    
    public function run(User $therapist): User
    {

        if ($therapist->approved_at) {
            throw new CustomDomainException("Therapist '$therapist->email' was already approved.");
        }


        return DB::transaction(function () use ($therapist) {

            $updated = $therapist->update([
                'approved_at' => now(),
            ]);


            if (! $updated) {
                throw new CustomDomainException(
                    "Failed to approve therapist '$therapist->email'."
                );
            }

            return $therapist->refresh();
        });
    }
}


*/