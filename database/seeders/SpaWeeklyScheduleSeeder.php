<?php

namespace Database\Seeders;

use App\Models\SpaWeeklySchedule;
use App\Models\Spa;
use App\Models\User;
use Illuminate\Database\Seeder;

class SpaWeeklyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spaID = $this->getSpaMainBranch()->id;
        $adminID = $this->getAdmin()->id;

        $schedules = [
            ['spa_id' => $spaID, 'day_of_week' => 'Sunday', 'open_time' => '10:00', 'close_time' => '15:00', 'created_by' => $adminID],
            ['spa_id' => $spaID, 'day_of_week' => 'Monday', 'open_time' => '08:00', 'close_time' => '17:00', 'created_by' => $adminID],
            ['spa_id' => $spaID, 'day_of_week' => 'Tuesday', 'open_time' => '08:00', 'close_time' => '17:00', 'created_by' => $adminID],
            ['spa_id' => $spaID, 'day_of_week' => 'Wednesday', 'open_time' => '08:00', 'close_time' => '17:00', 'created_by' => $adminID],
            ['spa_id' => $spaID, 'day_of_week' => 'Thursday', 'open_time' => '08:00', 'close_time' => '17:00', 'created_by' => $adminID],
            ['spa_id' => $spaID, 'day_of_week' => 'Friday', 'open_time' => '08:00', 'close_time' => '17:00', 'created_by' => $adminID],
            ['spa_id' => $spaID, 'day_of_week' => 'Saturday', 'open_time' => '1:00', 'close_time' => '14:00', 'created_by' => $adminID],

        ];

        foreach ($schedules as $schedule) {
            SpaWeeklySchedule::updateOrCreate($schedule);
        }
    }

    private function getSpaMainBranch()
    {
        return Spa::where('is_main_branch', true)->firstOrFail();
    }

    private function getAdmin()
    {
        return User::where('role', 'Admin')->firstOrFail();
    }
}
