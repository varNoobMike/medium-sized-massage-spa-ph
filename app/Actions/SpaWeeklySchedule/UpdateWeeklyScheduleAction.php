<?php

namespace App\Actions\SpaWeeklySchedule;

use App\Exceptions\CustomDomainException;
use App\Models\SpaWeeklySchedule;
use Illuminate\Support\Facades\DB;

class UpdateWeeklyScheduleAction
{

    /**
     * Update spa day of week schedule
     * 
     */
    public function run(SpaWeeklySchedule $spaWeeklySchedule, array $scheduleData)
    {

        // dd($data);

        return DB::transaction(function () use ($spaWeeklySchedule, $scheduleData) {

            $updated = $spaWeeklySchedule->update([
                'start_time' => $scheduleData['start_time'],
                'break_time_start' => $scheduleData['break_time_start'],
                'break_time_end' => $scheduleData['break_time_end'],
                'end_time' => $scheduleData['end_time'],
            ]);


            if (!$updated) {
                throw new CustomDomainException("Failed to update schedule for day of week '$spaWeeklySchedule->day_of_week'.");
            }

            return $spaWeeklySchedule->refresh();
        });
    }
}
