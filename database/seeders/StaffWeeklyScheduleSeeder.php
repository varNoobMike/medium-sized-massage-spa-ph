<?php

namespace Database\Seeders;

use App\Models\StaffWeeklySchedule;
use App\Services\UserContextService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffWeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scheduleSeedData = $this->seedData();

        DB::transaction(function () use ($scheduleSeedData) {
            foreach ($scheduleSeedData as $schedule) {

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

    // Weekly Schedules
    private function seedData(): array
    {
        $therapistA = UserContextService::getFirstTherapistID();
        $therapistB = UserContextService::getSecondTherapistID();
        $therapistC = UserContextService::getThirdTherapistID();

        return [
            // Therapist A
            ['user_id' => $therapistA, 'day_of_week' => 'Monday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistA, 'day_of_week' => 'Tuesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistA, 'day_of_week' => 'Wednesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistA, 'day_of_week' => 'Thursday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistA, 'day_of_week' => 'Friday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistA, 'day_of_week' => 'Saturday', 'start_time' => '01:00', 'end_time' => '14:00'],
            ['user_id' => $therapistA, 'day_of_week' => 'Sunday', 'start_time' => '10:00', 'end_time' => '15:00'],

            // Therapist B
            ['user_id' => $therapistB, 'day_of_week' => 'Monday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistB, 'day_of_week' => 'Tuesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistB, 'day_of_week' => 'Wednesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistB, 'day_of_week' => 'Thursday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistB, 'day_of_week' => 'Friday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistB, 'day_of_week' => 'Saturday', 'start_time' => '01:00', 'end_time' => '14:00'],
            ['user_id' => $therapistB, 'day_of_week' => 'Sunday', 'start_time' => '10:00', 'end_time' => '15:00'],

            // Therapist C
            ['user_id' => $therapistC, 'day_of_week' => 'Monday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistC, 'day_of_week' => 'Tuesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistC, 'day_of_week' => 'Wednesday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistC, 'day_of_week' => 'Thursday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistC, 'day_of_week' => 'Friday', 'start_time' => '08:00', 'end_time' => '17:00'],
            ['user_id' => $therapistC, 'day_of_week' => 'Saturday', 'start_time' => '01:00', 'end_time' => '14:00'],
            ['user_id' => $therapistC, 'day_of_week' => 'Sunday', 'start_time' => '10:00', 'end_time' => '15:00'],
        ];
    }
}
