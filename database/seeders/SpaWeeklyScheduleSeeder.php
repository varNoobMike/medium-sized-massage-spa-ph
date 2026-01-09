<?php

namespace Database\Seeders;

use App\Exceptions\CustomDomainException;
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

        $spa = Spa::first();

        $scheduleSeeds = [
            ['day_of_week' => 'Monday', 'start_time' => '13:00', 'end_time' => '17:00',],
            ['day_of_week' => 'Monday', 'start_time' => '08:00', 'end_time' => '12:00',],

            ['day_of_week' => 'Tuesday', 'start_time' => '13:00', 'end_time' => '17:00',],
            ['day_of_week' => 'Tuesday', 'start_time' => '08:00', 'end_time' => '12:00',],

            ['day_of_week' => 'Wednesday', 'start_time' => '13:00', 'end_time' => '17:00',],
            ['day_of_week' => 'Wednesday', 'start_time' => '08:00', 'end_time' => '12:00',],

            ['day_of_week' => 'Thursday', 'start_time' => '13:00', 'end_time' => '17:00',],
            ['day_of_week' => 'Thursday', 'start_time' => '08:00', 'end_time' => '12:00',],

            ['day_of_week' => 'Friday', 'start_time' => '13:00',  'end_time' => '17:00',],
            ['day_of_week' => 'Friday', 'start_time' => '08:00',  'end_time' => '12:00',],

            ['day_of_week' => 'Saturday', 'start_time' => '15:00', 'end_time' => '19:00',],
            ['day_of_week' => 'Saturday', 'start_time' => '10:00', 'end_time' => '14:00',],

            ['day_of_week' => 'Sunday', 'start_time' => '15:00', 'end_time' => '19:00',],
            ['day_of_week' => 'Sunday', 'start_time' => '10:00', 'end_time' => '14:00',],


        ];

        DB::transaction(function () use ($spa, $scheduleSeeds) {
            $spa->spaWeeklySchedules()->createMany($scheduleSeeds);
        });
    }
}
