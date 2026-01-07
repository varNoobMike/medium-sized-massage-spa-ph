<?php

namespace App\Actions\Auth;

use App\Exceptions\CustomDomainException;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class RegisterUserAction
{

    /**
     * Register user (Client, Therapist, etc...)
     * 
     */
    public function run(array $userData, string $role)
    {

        // Check if role is valid
        if (!in_array($role, User::ROLES)) {
            throw new CustomDomainException("Invalid role '$role'.");
        }

        // Use transaction
        return DB::transaction(function () use ($userData, $role) {

            // Insert user
            $user = User::create([
                'email' => $userData['email'],
                'name' => $userData['name'],
                'password' => $userData['password'], // Auto hashed at user model
                'role' => $role,
            ]);

            if (!$user) {
                throw new CustomDomainException("Failed to register.");
            }

            return $user;
        });
    }
}
