<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Spa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spaId = Spa::first()->id;

        $serviceSeeds = [
            ['name' => 'Full Body Massage Soft', 'duration_minutes' => 60, 'price' => 1500.00, 'spa_id' => $spaId],
            ['name' => 'Full Body Massage Medium - Hard', 'duration_minutes' => 60, 'price' => 2500.00, 'spa_id' => $spaId],
            ['name' => 'Back Massage', 'duration_minutes' => 30, 'price' => 450.00, 'spa_id' => $spaId],
            ['name' => 'Arm Massage', 'duration_minutes' => 45, 'price' => 550.00, 'spa_id' => $spaId],
            ['name' => 'Foot Massage', 'duration_minutes' => 30, 'price' => 350.00, 'spa_id' => $spaId],
        ];

        DB::transaction(function () use ($serviceSeeds) {
            foreach ($serviceSeeds as $service) {
                $service = Service::updateOrCreate(
                    [
                        'spa_id' => $service['spa_id'],
                        'name' => $service['name']
                    ],
                    $service
                );
            }
        });
    }
}
