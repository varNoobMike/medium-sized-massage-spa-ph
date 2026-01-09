<?php

namespace App\Services;

use App\Exceptions\CustomDomainException;
use App\Models\SpaWeeklySchedule;
use Illuminate\Support\Facades\DB;

class SpaWeeklyScheduleService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    /**
     * Update schedule
     * 
     */
    public function updateSchedule(SpaWeeklySchedule $spaWeeklySchedule, array $updateScheduleData)
    {

        return DB::transaction(function () use ($spaWeeklySchedule, $updateScheduleData) {

            $updated = $spaWeeklySchedule->update([
                'start_time' => $updateScheduleData['start_time'],
                'end_time' => $updateScheduleData['end_time'],
            ]);


            if (!$updated) {
                throw new CustomDomainException("Failed to update schedule for day of week '$spaWeeklySchedule->day_of_week'.");
            }

            return $spaWeeklySchedule->refresh();
        });
    }


    /**
     * Get schedules
     * 
     */
    public function getSchedules()
    {
        $schedules = SpaWeeklySchedule
            ::orderByRaw("
                FIELD(day_of_week, 
                    'Monday','Tuesday','Wednesday',
                    'Thursday','Friday','Saturday','Sunday')
            ")
            ->get();

        return $this->formatSchedules($schedules);
    }

    /**
     * Format schedules
     * 
     */
    private function formatSchedules($schedules)
    {
        return $schedules->groupBy('day_of_week')->map(function ($items) {
            return $items->sortBy('start_time')->values();
        });
    }
}
