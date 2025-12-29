<?php

namespace Database\Seeders;

use App\Models\StaffWeeklySchedule;
use App\Services\UserContextService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffWeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $therapistA = UserContextService::getFirstTherapistID();
        $therapistB = UserContextService::getSecondTherapistID();
        $therapistC = UserContextService::getThirdTherapistID();

        $schedules = [
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

        try {
            DB::transaction(function () use ($schedules) {
                foreach ($schedules as $schedule) {
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

            $this->command->info('Staff weekly schedules seeded successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to seed staff weekly schedules: '.$e->getMessage());
            $this->command->error('Failed to seed staff weekly schedules. Check logs.');
        }
    }
}
