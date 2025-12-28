<?php

namespace Database\Seeders;

use App\Models\SpaWeeklySchedule;
use App\Services\SpaContext;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpaWeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spaID = SpaContext::getMainBranchID(); // Main Branch Spa ID

        $schedules = [
            ['day_of_week' => 'Monday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Tuesday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Wednesday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Thursday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Friday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Saturday', 'open_time' => '01:00', 'close_time' => '14:00'],
            ['day_of_week' => 'Sunday', 'open_time' => '10:00', 'close_time' => '15:00'],
        ];

        try {
            DB::transaction(function () use ($spaID, $schedules) {
                foreach ($schedules as $schedule) {
                    SpaWeeklySchedule::updateOrCreate(
                        [
                            'spa_id' => $spaID,
                            'day_of_week' => $schedule['day_of_week'],
                        ],
                        [
                            'open_time' => $schedule['open_time'],
                            'close_time' => $schedule['close_time'],
                        ]
                    );
                }
            });

            $this->command->info("Spa weekly schedules seeded successfully for Spa ID: {$spaID}.");
        } catch (Exception $e) {
            Log::error('Failed to seed spa weekly schedules: '.$e->getMessage());
            $this->command->error('Failed to seed spa weekly schedules. Check logs for details.');
        }
    }
}
