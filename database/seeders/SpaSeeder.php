<?php

namespace Database\Seeders;

use App\Models\Spa;
use App\Services\CompanyContextService;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyID = CompanyContextService::getCompanyID(); // Company ID

        $branches = [
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

        try {
            DB::transaction(function () use ($branches, $companyID) {
                foreach ($branches as $branch) {
                    Spa::updateOrCreate(
                        ['name' => $branch['name']],
                        array_merge($branch, ['company_id' => $companyID])
                    );
                }
            });

            $this->command->info('Spa branches seeded successfully.');
        } catch (Exception $e) {
            Log::error('Failed to seed spa branches: '.$e->getMessage());
            $this->command->error('Failed to seed spa branches. Check logs for details.');
        }
    }
}
