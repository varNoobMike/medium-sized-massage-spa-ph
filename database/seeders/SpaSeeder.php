<?php

namespace Database\Seeders;

use App\Models\Spa;
use App\Services\CompanyService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        $spaSeedData = $this->getSeedData();
        $companyId = CompanyService::getCompany()->id; // Company ID

        DB::transaction(function () use ($spaSeedData, $companyId) {
            foreach ($spaSeedData as $spa) {
                Spa::updateOrCreate(
                    ['name' => $spa['name']],
                    array_merge($spa, ['company_id' => $companyId])
                );

            }
        });

    }

    // Spas (Branches)
    private function getSeedData()
    {
        return [
            [
                'name' => 'Rose Massage Services',
                'is_main_branch' => true,
                'location' => 'Tubod, San Juan, Siquijor, Philippines',
                'total_beds' => 10,
            ],
            [
                'name' => 'Rose Massage Services - Lazi Branch',
                'location' => 'Tigbawan, Lazi, Siquijor, Philippines',
                'total_beds' => 5,
            ],
        ];
    }
}
