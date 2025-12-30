<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $companySeedData = $this->seedData();

        DB::transaction(function () use ($companySeedData) {
            Company::updateOrCreate(
                ['name' => $companySeedData['name']],
                [
                    'email' => $companySeedData['email'],
                    'phone' => $companySeedData['phone'],
                ]
            );

        });

    }

    // Company
    private function seedData()
    {
        return
        ['name' => 'Rose Massage Services',
            'email' => 'rose_massage_services@example.com',
            'phone' => '0945088101',
        ];
    }
}
