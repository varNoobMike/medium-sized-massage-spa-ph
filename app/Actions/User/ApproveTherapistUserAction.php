<?php

namespace App\Actions\User;

use App\Actions\SpaWeeklySchedule\GetAllSpaWeeklySchedulesAction;
use App\Exceptions\CustomDomainException;
use App\Exceptions\User\TherapistUserApprovalFailedException;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ApproveTherapistUserAction
{

    /**
     * Constructor
     * 
     */
    public function __construct(protected GetAllSpaWeeklySchedulesAction $getSchedulesAction) {}


    /**
     * Approve therapist user
     * 
     */
    public function run(User $therapist)
    {

        if ($therapist->approved_at) {
            throw new CustomDomainException("Therapist '$therapist->email' was already approved.");
        }

        $now = now();

        return DB::transaction(function () use ($therapist, $now) {

            $updated = $therapist->update([
                'approved_at' => $now
            ]);


            if (! $updated) {
                throw new CustomDomainException(
                    "Failed to approve therapist '$therapist->email'."
                );
            }

            $schedules = $this->getFormattedSchedules();

            if (empty($schedules)) {
                throw new CustomDomainException(
                    "No default schedules found to assign to therapist '$therapist->email'."
                );
            }

            $created = $therapist->staffWeeklySchedules()->createMany($schedules);

            if (count($created) !== count($schedules)) {
                throw new CustomDomainException(
                    "Failed to assign all default schedules to therapist '$therapist->email'."
                );
            }

            return $therapist->load('staffWeeklySchedules');
        });
    }

    private function getFormattedSchedules()
    {
        return $this->getSchedulesAction
            ->run()
            ->map(fn($schedule) => [
                'day_of_week' => $schedule->day_of_week,
                'start_time'  => $schedule->start_time,
                'end_time'    => $schedule->end_time,
            ])
            ->toArray();
    }
}
