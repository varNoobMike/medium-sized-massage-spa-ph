<?php

namespace App\Services;

use App\Models\StaffWeeklySchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


/* Service class for `staff_weekly_schedules` */

class StaffWeeklyScheduleService
{


    public function createSchedules(array $data, int $userId)
    {
        return DB::transaction(function () use ($data, $userId) {

            // Merge user_id into each schedule
            $now = now();
            $rows = array_map(function ($schedule) use ($userId, $now) {
                return [
                    ...$schedule,
                    'user_id' => $userId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }, $data);

            StaffWeeklySchedule::insert($rows);

            return true;
        });
    }

    public function updateSchedule(StaffWeeklySchedule $weeklySchedule, array $data)
    {

        return DB::transaction(function () use ($weeklySchedule, $data) {

            $updated = $weeklySchedule->update([
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
            ]);

            if (!$updated) {
                throw ValidationException::withMessages([
                    'staff_weekly_schedule_update_error' => 'Failed to update schedule.',
                ]);
            }

            return $weeklySchedule;
        });
    }


    public function getSchedulesByUserId(int $userId)
    {

        return StaffWeeklySchedule::with('staff:id,name')
            ->whereHas('staff', function ($q) use ($userId) {
                $q->where('id', $userId);
            })
            ->orderByRaw("
                FIELD(day_of_week, 
                    'Monday','Tuesday','Wednesday',
                    'Thursday','Friday','Saturday','Sunday')
            ")
            ->get();
    }
}
