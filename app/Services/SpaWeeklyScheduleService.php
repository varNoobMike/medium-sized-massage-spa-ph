<?php

namespace App\Services;

use App\Models\Spa;
use App\Models\SpaWeeklySchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class SpaWeeklyScheduleService
{
    public function update(array $schedule, string $id)
    {

        $spa = Spa::findOrFail($id);


        // Use a transaction to ensure data integrity
        DB::transaction(function () use ($schedule, $spa) {

            // Update the existing schedule
            return SpaWeeklySchedule::where('spa_id', $spa->id)
                ->where('day_of_week', $schedule['day_of_week'])
                ->update([
                    'open_time' => $schedule['open_time'],
                    'close_time' => $schedule['close_time'],
            ]);
        });

    }


    public function getAll()
    {
        return SpaWeeklySchedule::with('spa:id,name,is_main_branch')
            ->whereHas('spa', function ($q) {
                $q->where('is_main_branch', true);
            })
            ->orderByRaw("
                FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
            ")
            ->get();

    }

}
