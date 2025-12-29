<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\SpaContextService;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Admin
            [
                'email' => 'admin@example.com',
                'name' => 'Admin123',
                'password' => 'admin-123', // auto hashed via User model cast
                'role' => 'Admin',
            ],
            // Therapist A
            [
                'email' => 'therapist_a@example.com',
                'name' => 'Therapist A',
                'password' => 'therapist-a-123',
                'role' => 'Therapist',
            ],
            // Therapist B
            [
                'email' => 'therapist_b@example.com',
                'name' => 'Therapist B',
                'password' => 'therapist-b-123',
                'role' => 'Therapist',
            ],
            // Therapist C
            [
                'email' => 'therapist_c@example.com',
                'name' => 'Therapist C',
                'password' => 'therapist-c-123',
                'role' => 'Therapist',
            ],
            // Client A
            [
                'email' => 'client_a@example.com',
                'name' => 'Client A',
                'password' => 'client-a-123',
                'role' => 'Client',
            ],
            // Client B
            [
                'email' => 'client_b@example.com',
                'name' => 'Client B',
                'password' => 'client-b-123',
                'role' => 'Client',
            ],
            // Client C
            [
                'email' => 'client_c@example.com',
                'name' => 'Client C',
                'password' => 'client-c-123',
                'role' => 'Client',
            ],
        ];

        $spaID = SpaContextService::getMainBranchID(); // Main Branch Spa ID

        try {
            DB::transaction(function () use ($users, $spaID) {
                foreach ($users as $data) {
                    $user = User::updateOrCreate(
                        ['email' => $data['email']],
                        $data
                    );

                    // Attach to spa pivot table without detaching existing
                    $user->spas()->syncWithoutDetaching([$spaID]);
                }
            });

            $this->command->info("Users seeded successfully and linked to Spa ID: {$spaID}.");
        } catch (Exception $e) {
            Log::error('Failed to seed users: '.$e->getMessage());
            $this->command->error('Failed to seed users. Check logs for details.');
        }
    }
}
