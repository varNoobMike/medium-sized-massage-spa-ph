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

        $companySeed = [
            'name' => 'Rose Massage Services',
            'email' => 'rose_massage_services@example.com',
            'phone' => '0945088101',
        ];

        DB::transaction(function () use ($companySeed) {
            Company::updateOrCreate(
                ['name' => $companySeed['name']],
                [
                    'email' => $companySeed['email'],
                    'phone' => $companySeed['phone'],
                ]
            );
        });
    }
}
