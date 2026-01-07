<?php

namespace Database\Seeders;

use App\Models\Company;
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

        $companyId = Company::first()->id;

        $spaSeed = [
            'name' => 'Main Branch Spa',
            'location' => 'Tubod, San Juan, Siquijor, Philippines',
            'total_beds' => 10,
            'company_id' => $companyId
        ];

        DB::transaction(function () use ($spaSeed) {
            Spa::updateOrCreate(
                [
                    'company_id' => $spaSeed['company_id'],
                    'name' => $spaSeed['name']
                ],
                $spaSeed
            );
        });
    }
}
