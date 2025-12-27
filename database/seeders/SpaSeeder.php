<?php

namespace Database\Seeders;

use App\Models\Spa;
use App\Models\User;
use Illuminate\Database\Seeder;

class SpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminID = $this->getAdmin()->id;

        Spa::updateOrCreate(
            ['name' => 'Rose Massage Services'],
            [
                'is_main_branch' => true,
                'address' => 'Tubod, San Juan, Siquijor, Philippines',
                'date_founded' => '2022-10-12',
                'total_beds' => 10,
                'created_by' => $adminID
            ]

        );

        Spa::updateOrCreate(
            ['name' => 'Rose Massage Services - Lazi Branch'],
            [
                'address' => 'Tigbawan, Lazi, Siquijor, Philippines',
                'date_founded' => '2025-07-20',
                'total_beds' => 5,
                'created_by' => $adminID
            ]

        );
    }

    private function getAdmin()
    {
        return User::where('role', 'Admin')->firstOrFail();
    }
}
