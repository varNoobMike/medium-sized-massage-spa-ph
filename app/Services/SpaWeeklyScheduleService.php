<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Exceptions\SpaWeeklySchedule\ScheduleAlreadyExistsException;
use App\Exceptions\SpaWeeklySchedule\ScheduleCreateFailedException;
use App\Exceptions\SpaWeeklySchedule\ScheduleOverlapException;
use App\Exceptions\SpaWeeklySchedule\ScheduleUpdateFailedException;
use App\Models\SpaWeeklySchedule;


class SpaWeeklyScheduleService
{

    /**
     * Constructor
     * 
     */
    public function __construct(private SpaService $spaService) {}


    /**
     * Create Schedule
     * 
     */
    public function createSchedule(
        Collection $createScheduleData
    ): SpaWeeklySchedule|null {


        // Find and check existing time slot schedule
        $foundExistingSchedule = $this->findExistingSchedule(
            $createScheduleData->get('day_of_week'),
            $createScheduleData->get('start_time'),
            $createScheduleData->get('end_time'),
        );

        if ($foundExistingSchedule) {
            throw new ScheduleAlreadyExistsException(
                $foundExistingSchedule,
                "There’s already a time slot schedule at this time on '{$createScheduleData->get('day_of_week')}'.",
            );
        }

        // Find and check overlapping time slot schedule
        $foundOverlappingSchedule = $this->findOverlappingSchedule(
            $createScheduleData->get('day_of_week'),
            $createScheduleData->get('start_time'),
            $createScheduleData->get('end_time'),
        );


        if ($foundOverlappingSchedule) {
            throw new ScheduleOverlapException(
                $foundOverlappingSchedule,
                "This time slot schedule overlaps with an existing one on '{$createScheduleData->get('day_of_week')}'.",
            );
        }

        $spaId = $this->spaService->getProfile()->id;

        return DB::transaction(function () use ($spaId, $createScheduleData) {
            $schedule = SpaWeeklySchedule::create([
                'day_of_week' => $createScheduleData['day_of_week'],
                'start_time' => $createScheduleData['start_time'],
                'end_time' => $createScheduleData['end_time'],
                'spa_id' => $spaId,
            ]);

            if (!$schedule) {
                throw new ScheduleCreateFailedException("Failed to create time slot schedule for '{$createScheduleData['day_of_week']}'. Please retry!");
            }

            return $schedule;
        });
    }


    /**
     * Update schedule
     * 
     */
    public function updateSchedule(
        SpaWeeklySchedule $schedule,
        Collection $updateScheduleData
    ): SpaWeeklySchedule|null {


        // Find and check existing time slot schedule
        $foundExistingSchedule = $this->findExistingSchedule(
            $schedule->day_of_week,
            $updateScheduleData->get('start_time'),
            $updateScheduleData->get('end_time'),
            $schedule->id,
        );

        if ($foundExistingSchedule) {
            throw new ScheduleAlreadyExistsException(
                $foundExistingSchedule,
                "There’s already a time slot schedule at this time on '{$schedule->day_of_week}'.",
            );
        }

        // Find and check overlapping time slot schedule
        $foundOverlappingSchedule = $this->findOverlappingSchedule(
            $schedule->day_of_week,
            $updateScheduleData->get('start_time'),
            $updateScheduleData->get('end_time'),
            $schedule->id,
        );


        if ($foundOverlappingSchedule) {
            throw new ScheduleOverlapException(
                $foundOverlappingSchedule,
                "This time slot schedule overlaps with an existing one on '{$schedule->day_of_week}'.",
            );
        }

        return DB::transaction(function () use ($schedule, $updateScheduleData) {

            $updated = $schedule->update([
                'start_time' => $updateScheduleData->get('start_time'),
                'end_time' => $updateScheduleData->get('end_time'),
            ]);


            if (!$updated) {
                throw new ScheduleUpdateFailedException(
                    $schedule,
                    "Failed to update time slot for '{$schedule->day_of_week}'.",
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
     *  Find existing schedule by day of week, start and end time, may exclude id or not
     * 
     */
    private function findExistingSchedule(
        string $dayOfWeek,
        string $startTime,
        string $endTime,
        int|null $excludeId = null
    ): SpaWeeklySchedule|null {

        $query = SpaWeeklySchedule::query()
            ->where('day_of_week', $dayOfWeek)
            ->where('start_time', $startTime)
            ->where('end_time', $endTime);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->first();
    }


    /**
     * Find overlapping schedule by day of week, start and end time, may exclude id or not
     * 
     */
    private function findOverlappingSchedule(
        string $dayOfWeek,
        string $startTime,
        string $endTime,
        int|null $excludeId = null
    ): SpaWeeklySchedule|null {

        $query = SpaWeeklySchedule::query()
            ->where('day_of_week', $dayOfWeek)
            ->where('end_time', '>=', $startTime)
            ->where('start_time', '<=', $endTime);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->first();
    }
}
