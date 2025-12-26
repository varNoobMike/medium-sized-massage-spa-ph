<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

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

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }

    }
}
