<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // prevent duplicates
            [
                'name' => 'Admin123',
                'password' => Hash::make('admin-123'),
                'role' => 'Admin',
            ]
        );

        // Therapist A
        User::updateOrCreate(
            ['email' => 'therapist_a@example.com'], // prevent duplicates
            [
                'name' => 'Therapist A',
                'password' => Hash::make('therapist-a-123'),
                'role' => 'Therapist',
            ]
        );

        // Therapist B
        User::updateOrCreate(
            ['email' => 'therapist_b@example.com'], // prevent duplicates
            [
                'name' => 'Therapist B',
                'password' => Hash::make('therapist-b-123'),
                'role' => 'Therapist',
            ]
        );

        // Therapist C
        User::updateOrCreate(
            ['email' => 'therapist_c@example.com'], // prevent duplicates
            [
                'name' => 'Therapist C',
                'password' => Hash::make('therapist-c-123'),
                'role' => 'Therapist',
            ]
        );

        // Client A
        User::updateOrCreate(
            ['email' => 'client_a@example.com'], // prevent duplicates
            [
                'name' => 'Client A',
                'password' => Hash::make('client-a-123'),
                'role' => 'Client',
            ]
        );

        // Client B
        User::updateOrCreate(
            ['email' => 'client_b@example.com'], // prevent duplicates
            [
                'name' => 'Client B',
                'password' => Hash::make('client-b-123'),
                'role' => 'Client',
            ]
        );


        // Client C
        User::updateOrCreate(
            ['email' => 'client_c@example.com'], // prevent duplicates
            [
                'name' => 'Client C',
                'password' => Hash::make('client-c-123'),
                'role' => 'Client',
            ]
        );

    }
}
