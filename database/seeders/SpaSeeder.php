<?php

namespace Database\Seeders;

use App\Models\Spa;
use Illuminate\Database\Seeder;

class SpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Spa::firstOrCreate(
            ['name' => 'Rose Massage Services'],
            [
                'address' => 'Tubod, San Juan, Siquijor, Philippines',
                'date_founded' => '2022-10-12',
                'total_beds' => 10,
                'user_id' => 1
            ]

        );
    }
}
