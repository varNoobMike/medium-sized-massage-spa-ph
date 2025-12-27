<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminID = $this->getAdmin()->id;

        $services = [
            ['name' => 'Full Body Massage Soft', 'duration_minutes' => 60, 'price' => 1500.00, 'created_by' => $adminID],
            ['name' => 'Full Body Massage Medium - Hard', 'duration_minutes' => 60, 'price' => 2500.00, 'created_by' => $adminID],
            ['name' => 'Back Massage', 'duration_minutes' => 30, 'price' => 450.00, 'created_by' => $adminID],
            ['name' => 'Arm Massage', 'duration_minutes' => 45, 'price' => 550.00, 'created_by' => $adminID],
            ['name' => 'Foot Massage', 'duration_minutes' => 30, 'price' => 350.00, 'created_by' => $adminID],

        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }

    }

    private function getAdmin()
    {
        return User::where('role', 'Admin')->firstOrFail();
    }

}
