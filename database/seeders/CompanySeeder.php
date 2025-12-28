<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::updateOrCreate(
            ['name' => 'Rose Massage Services'],
            [
                'email' => 'rose_massage_services@example.com',
                'phone' => '0945088101',
            ]
        );
    }
}
