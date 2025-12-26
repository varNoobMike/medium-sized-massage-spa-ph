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

        Spa::updateOrCreate(
            ['name' => 'Rose Massage Services'],
            [
                'is_main_branch' => true,
                'address' => 'Tubod, San Juan, Siquijor, Philippines',
                'date_founded' => '2022-10-12',
                'total_beds' => 10,
            ]

        );

        Spa::updateOrCreate(
            ['name' => 'Rose Massage Services - Lazi Branch'],
            [
                'address' => 'Tigbawan, Lazi, Siquijor, Philippines',
                'date_founded' => '2025-07-20',
                'total_beds' => 5,
            ]

        );
    }

   
}
