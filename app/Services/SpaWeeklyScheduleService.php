<?php

namespace App\Services;

use App\Models\SpaWeeklySchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/* Service class for `spa_weekly_schedules` */

class SpaWeeklyScheduleService
{

    /* no create method yet, add later... */

    public function updateSchedule(SpaWeeklySchedule $spaWeeklySchedule, array $data)
    {

        // dd($data);
        return DB::transaction(function () use ($spaWeeklySchedule, $data) {

            $updated = $spaWeeklySchedule->update([
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
            ]);


            if (!$updated) {

                throw ValidationException::withMessages([
                    'spa_weekly_schedule_update_error' => 'Failed to update schedule.',
                ]);
            }

            return $spaWeeklySchedule;
        });
    }

    public function getAllSchedules()
    {
        
    }
}
