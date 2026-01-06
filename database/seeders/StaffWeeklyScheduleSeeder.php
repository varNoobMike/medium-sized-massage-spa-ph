<?php

namespace Database\Seeders;

use App\Models\StaffWeeklySchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Exception;


class StaffWeeklyScheduleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $therapistAId = User::where('role', 'Therapist')->first()->id;
        $therapistBId = User::where('role', 'Therapist')->skip(1)->first()->id;
        $therapistCId = User::where('role', 'Therapist')->skip(2)->first()->id;

        $scheduleSeeds = [

            // Therapist A
            ['user_id' => $therapistAId, 'day_of_week' => 'Monday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistAId, 'day_of_week' => 'Tuesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistAId, 'day_of_week' => 'Wednesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistAId, 'day_of_week' => 'Thursday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistAId, 'day_of_week' => 'Friday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistAId, 'day_of_week' => 'Saturday', 'start_time' => '10:00', 'end_time' => '15:00'],
            ['user_id' => $therapistAId, 'day_of_week' => 'Sunday', 'start_time' => '10:00', 'end_time' => '15:00'],

            // Therapist B
            ['user_id' => $therapistBId, 'day_of_week' => 'Monday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistBId, 'day_of_week' => 'Tuesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistBId, 'day_of_week' => 'Wednesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistBId, 'day_of_week' => 'Thursday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistBId, 'day_of_week' => 'Friday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistBId, 'day_of_week' => 'Saturday', 'start_time' => '10:00', 'end_time' => '15:00'],
            ['user_id' => $therapistBId, 'day_of_week' => 'Sunday', 'start_time' => '10:00', 'end_time' => '15:00'],

            // Therapist C
            ['user_id' => $therapistCId, 'day_of_week' => 'Monday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistCId, 'day_of_week' => 'Tuesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistCId, 'day_of_week' => 'Wednesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistCId, 'day_of_week' => 'Thursday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistCId, 'day_of_week' => 'Friday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistCId, 'day_of_week' => 'Saturday', 'start_time' => '10:00', 'end_time' => '15:00'],
            ['user_id' => $therapistCId, 'day_of_week' => 'Sunday', 'start_time' => '10:00', 'end_time' => '15:00'],


        ];


        DB::transaction(function () use ($scheduleSeeds) {
            foreach ($scheduleSeeds as $schedule) {
                if (!in_array($schedule['day_of_week'], StaffWeeklySchedule::DAYS)) {
                    throw new Exception('Invalid day of week: ' . $schedule['day_of_week']);
                }

                StaffWeeklySchedule::updateOrCreate(
                    [
                        'user_id' => $schedule['user_id'],
                        'day_of_week' => $schedule['day_of_week'],
                    ],
                    [
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time'],
                    ]
                );
            }
        });
    }
}
