<?php

namespace Database\Seeders;

use App\Models\Spa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $spaSeed = [
            'name' => 'Main Branch Spa',
            'location' => 'Tubod, San Juan, Siquijor, Philippines',
            'total_beds' => 10,
        ];

        DB::transaction(function () use ($spaSeed) {
            Spa::updateOrCreate(
                ['name' => $spaSeed['name']],
                $spaSeed
            );
        });
    }
}
