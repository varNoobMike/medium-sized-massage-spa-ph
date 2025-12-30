<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\SpaContextService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userSeedData = $this->seedData();
        $spaID = SpaContextService::getMainBranchID(); // Spa main branch ID

        DB::transaction(function () use ($userSeedData, $spaID) {

            foreach ($userSeedData as $seed) {

                $user = User::updateOrCreate(
                    ['email' => $seed['email']],
                    $seed
                );

                // Only for Staff
                if ($user->role != 'Client') {
                    // Attach to spa pivot table
                    $user->spas()->sync([$spaID]);
                }

            }
        });

    }

    // Users
    private function seedData(): array
    {
        return [
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

    }
}
