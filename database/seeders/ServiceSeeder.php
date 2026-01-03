<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Services\SpaService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Exception;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(SpaService $spaService): void
    {
        $serviceSeedData = $this->getSeedData();

        $spaId = $spaService->getMainBranch()->id; // Spa main branch ID

        DB::transaction(function () use ($serviceSeedData, $spaId) {
            foreach ($serviceSeedData as $service) {

                $service = Service::updateOrCreate(
                    ['name' => $service['name']],
                    $service
                );

                // Attach at pivot table ('spa_services')
                $service->spas()->sync([$spaId]);

            }
        });

    }

    // Services
    private function getSeedData()
    {
        return [
            ['name' => 'Full Body Massage Soft', 'duration_minutes' => 60, 'price' => 1500.00],
            ['name' => 'Full Body Massage Medium - Hard', 'duration_minutes' => 60, 'price' => 2500.00],
            ['name' => 'Back Massage', 'duration_minutes' => 30, 'price' => 450.00],
            ['name' => 'Arm Massage', 'duration_minutes' => 45, 'price' => 550.00],
            ['name' => 'Foot Massage', 'duration_minutes' => 30, 'price' => 350.00],
        ];
    }

    
}
