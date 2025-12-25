<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'user@email.com'], // prevent duplicates
            [
                'name' => 'User A',
                'password' => Hash::make('user123'),
                'role' => 'Client',
            ]
        );
    }
}
