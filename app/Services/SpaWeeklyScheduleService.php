<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Exceptions\SpaWeeklySchedule\ScheduleAlreadyExistsException;
use App\Exceptions\SpaWeeklySchedule\ScheduleOverlapException;
use App\Exceptions\SpaWeeklySchedule\ScheduleUpdateFailedException;
use App\Models\SpaWeeklySchedule;


class SpaWeeklyScheduleService
{

    /**
     * Create Schedule
     * 
     */
    


    /**
     * Update schedule
     * 
     */
    public function updateSchedule(SpaWeeklySchedule $schedule, array $updateScheduleData): SpaWeeklySchedule|null
    {

        $foundExistingSchedule = $this->findExistingSchedule($schedule, $updateScheduleData, true);

        if ($foundExistingSchedule) {
            throw new ScheduleAlreadyExistsException(
                $foundExistingSchedule,
                "There’s already a schedule at this time on '{$schedule->day_of_week}'.",
            );
        }

        $foundOverlappingSchedule = $this->findOverlappingSchedule($schedule, $updateScheduleData, true);


        if ($foundOverlappingSchedule) {
            throw new ScheduleOverlapException(
                $foundOverlappingSchedule,
                "This schedule overlaps with an existing one on '{$schedule->day_of_week}'.",
            );
        }

        return DB::transaction(function () use ($schedule, $updateScheduleData) {

            $updated = $schedule->update([
                'start_time' => $updateScheduleData['start_time'],
                'end_time' => $updateScheduleData['end_time'],
            ]);


            if (!$updated) {
                throw new ScheduleUpdateFailedException(
                    $schedule,
                    "Failed to update schedule for '$schedule->day_of_week'."
                );
            }

            return $schedule->refresh();
        });
    }

    /**
     * Get schedules
     * 
     */
    public function getSchedules(): Collection
    {
        $schedules =  SpaWeeklySchedule
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
    private function formatSchedules(Collection $schedules): Collection
    {
        return $schedules->groupBy('day_of_week')->map(function ($items) {
            return $items->sortBy('start_time')->values();
        });
    }


    /**
     *  Find existing schedule by day of week, start and end time
     * 
     */
    private function findExistingSchedule(
        SpaWeeklySchedule $schedule,
        array $updateData,
        bool $excludeCurrentSchedule
    ): SpaWeeklySchedule|null {

        $id = $excludeCurrentSchedule ? $schedule->id : -1;

        return SpaWeeklySchedule::where('id', '!=', $id)
            ->where('day_of_week', $schedule->day_of_week)
            ->where('start_time', $updateData['start_time'])
            ->where('end_time', $updateData['end_time'])
            ->first();
    }


    /**
     * Find overlapping schedule by day of week, start and end time
     * 
     */
    private function findOverlappingSchedule(
        SpaWeeklySchedule $schedule,
        array $updateData,
        bool $excludeCurrentSchedule
    ): SpaWeeklySchedule|null {


        $id = $excludeCurrentSchedule ? $schedule->id : -1;

        return SpaWeeklySchedule::where('id', '!=', $id)
            ->where('day_of_week', $schedule->day_of_week)
            ->where('end_time', '>=', $updateData['start_time'])
            ->where('start_time', '<=', $updateData['end_time'])
            ->first();
    }
}
