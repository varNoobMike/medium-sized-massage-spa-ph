<?php

namespace App\Services;

use App\Models\SpaWeeklySchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class SpaWeeklyScheduleService
{

    /* no create method yet, add later */

    public function update(array $data, int $scheduleId, int $spaId)
    {

        DB::transaction(function () use ($data, $scheduleId, $spaId) {

            $schedule = SpaWeeklySchedule::where('id', $scheduleId)
                ->where('spa_id', $spaId)
                ->update([
                    'open_time' => $data['open_time'],
                    'close_time' => $data['close_time'],
                ]);

            if(!$schedule)
            {
                throw ValidationException::withMessages([
                    'spa_weekly_schedule_update_error' => 'Failed to update schedule.',
                ]);  
            }

            return $schedule;


        });

    }


    public function getAllFromMainBranch()
    {
        // spa main branch weekly schedules
        return SpaWeeklySchedule::with('spa:id,name,is_main_branch')
            ->whereHas('spa', function ($q) {
                $q->where('is_main_branch', true);
            })
            ->orderByRaw("
                FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
            ")
            ->get();

    }


    public function getAll()
    {
        return SpaWeeklySchedule::with('spa:id,name,is_main_branch')
            ->orderByRaw("
                FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
            ")
            ->get();

    }

}
