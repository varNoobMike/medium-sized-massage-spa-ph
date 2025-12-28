<?php

namespace Database\Seeders;

use App\Models\Service;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Full Body Massage Soft', 'duration_minutes' => 60, 'price' => 1500.00],
            ['name' => 'Full Body Massage Medium - Hard', 'duration_minutes' => 60, 'price' => 2500.00],
            ['name' => 'Back Massage', 'duration_minutes' => 30, 'price' => 450.00],
            ['name' => 'Arm Massage', 'duration_minutes' => 45, 'price' => 550.00],
            ['name' => 'Foot Massage', 'duration_minutes' => 30, 'price' => 350.00],
        ];

        try {
            DB::transaction(function () use ($services) {
                foreach ($services as $service) {
                    Service::updateOrCreate(
                        ['name' => $service['name']],
                        $service
                    );
                }
            });

            $this->command->info('Services seeded successfully.');
        } catch (Exception $e) {
            Log::error('Failed to seed services: '.$e->getMessage());
            $this->command->error('Failed to seed services. Check logs for details.');
        }
    }
}
