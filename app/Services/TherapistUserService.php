<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Services\StaffWeeklyScheduleService;
use App\Services\SpaWeeklyScheduleService;

/* Service class for `users` where role is Therapist 

class TherapistUserService
{

    // no create method yet, insertion is done via auth service's register method 

    public function __construct(
        private StaffWeeklyScheduleService $staffWeeklyScheduleService,
        private SpaWeeklyScheduleService $spaWeeklyScheduleService
    ) {}

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

        return DB::transaction(function () use ($therapist) {

            $updated = $therapist->update([
                'approved_at' => now(),
            ]);

            if (!$updated) {
                throw ValidationException::withMessages([
                    'approve_therapist_error' => 'Failed to approve therapist.',
                ]);
            }

            $schedules = $therapist->staffWeeklySchedules()->createMany($this->getSpaWeeklySchedules());

            if ($schedules->isEmpty()) {
                throw ValidationException::withMessages([
                    'staff_weekly_schedule_create_error' => 'Failed to create schedules.',
                ]);
            }

            return $therapist;
        });
    }

    public function getSpaWeeklySchedules()
    {
        $rows = [];

        $spaSchedules = $this->spaWeeklyScheduleService->getAllSchedules();

        foreach ($spaSchedules as $schedule) {
            $rows[] = [
                'day_of_week' => $schedule['day_of_week'],
                'start_time' => $schedule['start_time'],
                'end_time' => $schedule['end_time'],

            ];
        }
    }
}

*/
