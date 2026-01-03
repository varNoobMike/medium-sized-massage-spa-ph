<?php

namespace App\Services;

use App\Models\StaffWeeklySchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class StaffWeeklyScheduleService
{

    /* no create method yet, add later */


    public function update(StaffWeeklySchedule $weeklySchedule, array $data)
    {

        DB::transaction(function () use ($weeklySchedule, $data) {

            $schedule = $weeklySchedule->update([
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
            ]);

            if (!$schedule) {
                throw ValidationException::withMessages([
                    'staff_weekly_schedule_update_error' => 'Failed to update schedule.',
                ]);
            }

            return $schedule;
        });
    }



    // specific staff's weekly schedules
    public function getAllByUserId(int $userId)
    {

        return StaffWeeklySchedule::with('staff:id,name')
            ->whereHas('staff', function ($q) use ($userId) {
                $q->where('id', $userId);
            })
            ->orderByRaw("
                FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
            ")
            ->get();
    }


    // all staff weekly schedules
    public function getAll()
    {

        return StaffWeeklySchedule::with('staff:id,name')
            ->orderByRaw("
                FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
            ")
            ->get();
    }
}
