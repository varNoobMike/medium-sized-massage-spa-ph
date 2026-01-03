<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\SpaService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(SpaService $spaService): void
    {

        $userSeedData = $this->getSeedData();
        $spaId = $spaService->getMainBranch()->id; // Spa main branch ID

        DB::transaction(function () use ($userSeedData, $spaId) {

            foreach ($userSeedData as $seed) {

                $user = User::updateOrCreate(
                    ['email' => $seed['email']],
                    $seed
                );

                // Only for Staff
                if ($user->role != 'Client') {
                    // Attach to spa pivot table ('spa_staff')
                    $user->spas()->sync([$spaId]);
                }

            }
        });

    }

    // Users
    private function getSeedData(): array
    {
        return [
            // Admin
            [
                'email' => 'admin@example.com',
                'name' => 'Admin123',
                'password' => 'admin-123', 
                'role' => 'Admin',
            ],
            // Therapist A
            [
                'email' => 'therapist_a@example.com',
                'name' => 'Therapist A',
                'password' => 'therapist-a-123',
                'role' => 'Therapist',
                'approved_at' => now(),
            ],
            // Therapist B
            [
                'email' => 'therapist_b@example.com',
                'name' => 'Therapist B',
                'password' => 'therapist-b-123',
                'role' => 'Therapist',
                'approved_at' => now(),
            ],
            // Therapist C
            [
                'email' => 'therapist_c@example.com',
                'name' => 'Therapist C',
                'password' => 'therapist-c-123',
                'role' => 'Therapist',
                'approved_at' => now(),
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
