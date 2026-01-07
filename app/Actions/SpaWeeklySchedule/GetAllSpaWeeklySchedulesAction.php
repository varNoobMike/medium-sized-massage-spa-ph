<?php

namespace App\Actions\SpaWeeklySchedule;

use App\Models\SpaWeeklySchedule;

class GetAllSpaWeeklySchedulesAction
{

    /**
     * Get all spa weekly schedules
     * 
     */
    public function run()
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
