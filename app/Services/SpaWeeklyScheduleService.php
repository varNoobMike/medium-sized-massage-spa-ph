<?php

namespace App\Services;

use App\Models\SpaWeeklySchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SpaWeeklyScheduleService
{

    /* no create method yet, add later... */

    public function updateSchedule(SpaWeeklySchedule $spaWeeklySchedule, array $data)
    {

        // dd($data);

        DB::transaction(function () use ($spaWeeklySchedule, $data) {

            $schedule = $spaWeeklySchedule->update([
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
            ]);


            if (!$schedule) {

                throw ValidationException::withMessages([
                    'spa_weekly_schedule_update_error' => 'Failed to update schedule.',
                ]);
            }

            return $schedule;
        });
    }

    public function getAllSchedules()
    {
        return SpaWeeklySchedule::with('spa:id,name')
            ->orderByRaw("
                FIELD(day_of_week, 
                    'Monday','Tuesday','Wednesday',
                    'Thursday','Friday','Saturday','Sunday')
            ")
            ->get();
    }
}
