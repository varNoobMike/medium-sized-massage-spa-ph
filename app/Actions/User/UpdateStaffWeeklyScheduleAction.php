<?php

/*

namespace App\Actions\User;

use App\Exceptions\CustomDomainException;
use App\Models\StaffWeeklySchedule;
use Illuminate\Support\Facades\DB;

class UpdateStaffWeeklyScheduleAction
{

    
    public function run(StaffWeeklySchedule $weeklySchedule, array $scheduleData): StaffWeeklySchedule
    {

        // dd($data);

        return DB::transaction(function () use ($weeklySchedule, $scheduleData) {

            $updated = $weeklySchedule->update([
                'start_time' => $scheduleData['start_time'],
                'end_time' => $scheduleData['end_time'],
            ]);


            if (!$updated) {
                throw new CustomDomainException("Failed to update schedule for day of week '$weeklySchedule->day_of_week'.");
            }

            return $weeklySchedule->refresh();
        });
    }
}

*/
