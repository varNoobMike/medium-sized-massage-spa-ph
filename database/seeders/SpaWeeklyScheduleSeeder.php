<?php

namespace Database\Seeders;

use App\Models\SpaWeeklySchedule;
use App\Services\SpaService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpaWeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $scheduleSeedData = $this->getSeedData();
        $spaId = SpaService::getMainBranch()->id; // Spa main branch ID

        DB::transaction(function () use ($spaId, $scheduleSeedData) {
            foreach ($scheduleSeedData as $schedule) {

                SpaWeeklySchedule::updateOrCreate(
                    [
                        'spa_id' => $spaId,
                        'day_of_week' => $schedule['day_of_week'],
                    ],
                    [
                        'open_time' => $schedule['open_time'],
                        'close_time' => $schedule['close_time'],
                    ]
                );

            }
        });

    }

    // Weekly Schedules
    private function getSeedData()
    {
        return [
            ['day_of_week' => 'Monday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Tuesday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Wednesday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Thursday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Friday', 'open_time' => '08:00', 'close_time' => '17:00'],
            ['day_of_week' => 'Saturday', 'open_time' => '01:00', 'close_time' => '14:00'],
            ['day_of_week' => 'Sunday', 'open_time' => '10:00', 'close_time' => '15:00'],
        ];

    }
}
