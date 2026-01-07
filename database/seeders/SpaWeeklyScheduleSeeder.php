<?php

namespace Database\Seeders;

use App\Exceptions\Schedule\InvalidDayOfWeekException;
use App\Models\SpaWeeklySchedule;
use App\Models\Spa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpaWeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $spaId = Spa::first()->id;

        $scheduleSeeds = [
            ['day_of_week' => 'Monday', 'start_time' => '08:00', 'break_time_start' => '12:00', 'break_time_end' => '13:00', 'end_time' => '17:00', 'spa_id' => $spaId],
            ['day_of_week' => 'Tuesday', 'start_time' => '08:00', 'break_time_start' => '12:00', 'break_time_end' => '13:00', 'end_time' => '17:00', 'spa_id' => $spaId],
            ['day_of_week' => 'Wednesday', 'start_time' => '08:00', 'break_time_start' => '12:00', 'break_time_end' => '13:00', 'end_time' => '17:00', 'spa_id' => $spaId],
            ['day_of_week' => 'Thursday', 'start_time' => '08:00', 'break_time_start' => '12:00', 'break_time_end' => '13:00', 'end_time' => '17:00', 'spa_id' => $spaId],
            ['day_of_week' => 'Friday', 'start_time' => '08:00', 'break_time_start' => '12:00', 'break_time_end' => '13:00', 'end_time' => '17:00', 'spa_id' => $spaId],
            ['day_of_week' => 'Saturday', 'start_time' => '10:00', 'break_time_start' => null, 'break_time_end' => null, 'end_time' => '15:00', 'spa_id' => $spaId],
            ['day_of_week' => 'Sunday', 'start_time' => '10:00', 'break_time_start' => null, 'break_time_end' => null, 'end_time' => '15:00', 'spa_id' => $spaId],
        ];

        DB::transaction(function () use ($scheduleSeeds) {

            foreach ($scheduleSeeds as $schedule) {

                if (!in_array($schedule['day_of_week'], SpaWeeklySchedule::DAYS)) {
                    throw new InvalidDayOfWeekException();
                }

                SpaWeeklySchedule::updateOrCreate(
                    [
                        'spa_id' => $schedule['spa_id'],
                        'day_of_week' => $schedule['day_of_week'],
                    ],
                    [
                        'start_time' => $schedule['start_time'],
                        'break_time_start' => $schedule['break_time_start'] ?? null,
                        'break_time_end' => $schedule['break_time_end'] ?? null,
                        'end_time' => $schedule['end_time'],
                    ]
                );
            }
        });
    }
}
