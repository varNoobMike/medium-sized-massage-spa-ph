<?php

namespace Database\Seeders;

use App\Models\SpaWeeklySchedule;
use Illuminate\Database\Seeder;

class SpaWeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            ['spa_id' => 1, 'day_of_week' => 'Sunday', 'open_time' => '10:00', 'close_time' => '15:00', 'is_current' => 1, 'created_by' => 1],
            ['spa_id' => 1, 'day_of_week' => 'Monday', 'open_time' => '08:00', 'close_time' => '17:00', 'is_current' => 1, 'created_by' => 1],
            ['spa_id' => 1, 'day_of_week' => 'Tuesday', 'open_time' => '08:00', 'close_time' => '17:00', 'is_current' => 1, 'created_by' => 1],
            ['spa_id' => 1, 'day_of_week' => 'Wednesday', 'open_time' => '08:00', 'close_time' => '17:00', 'is_current' => 1, 'created_by' => 1],
            ['spa_id' => 1, 'day_of_week' => 'Thursday', 'open_time' => '08:00', 'close_time' => '17:00', 'is_current' => 1, 'created_by' => 1],
            ['spa_id' => 1, 'day_of_week' => 'Friday', 'open_time' => '08:00', 'close_time' => '17:00', 'is_current' => 1, 'created_by' => 1],
            ['spa_id' => 1, 'day_of_week' => 'Saturday', 'open_time' => '1:00', 'close_time' => '14:00', 'is_current' => 1, 'created_by' => 1],

        ];

        foreach ($schedules as $schedule) {
            SpaWeeklySchedule::create($schedule);
        }
    }
}
