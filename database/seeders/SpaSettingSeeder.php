<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SpaSetting;
use App\Models\Spa;

class SpaSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spaId = Spa::first()->id;

        $spaSettingSeed = [
            'spa_id' => $spaId,  
            'email' => 'rose_massage@example.com',   
            'contact_number' => '09191001234',  
            'logo' => null,
            'location' => 'Tubod, San Juan, Siquijor',    
            'maximum_bed_capacity' => 10,    
            'booking_buffer_start' => 15,    
            'booking_buffer_end' => 15,
        ];

        SpaSetting::updateOrCreate(
            ['spa_id' => $spaSettingSeed['spa_id']],
            $spaSettingSeed,
        );
    }
}
