<?php

namespace App\Actions\StaffWeeklySchedule;

use App\Models\StaffWeeklySchedule;
use App\Models\User;

class GetStaffWeeklySchedulesAction
{

    /**
     * Get current staff's weekly schedules
     * 
     */
    public function run(User $staff)
    {

        return $staff->staffWeeklySchedules()
            ->orderByRaw("
                FIELD(day_of_week, 
                    'Monday','Tuesday','Wednesday',
                    'Thursday','Friday','Saturday','Sunday')
                ")
            ->get();
    }
}
