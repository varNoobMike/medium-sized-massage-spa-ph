<?php

namespace App\Services;

use App\Exceptions\Auth\RegisterFailedException;
use Illuminate\Support\Collection;
use App\Models\User;


class ClientService
{
    /**
     * Create Client
     * 
     */
    public function createClient(array $createClientData): User|null
    {
        $client = User::create([
            'name' => $createClientData['name'],
            'email' => $createClientData['email'],
            'password' => $createClientData['password'],
            'role' => User::ROLE_CLIENT,
        ]);


        if (!$client) {
            throw new RegisterFailedException("Failed to register as client for '{$createClientData['email']}'. Please retry!");
        }

        return $client;
    }

    /**
     * Get clients
     * 
     */
    public function getClients(): Collection
    {
        return User::where('role', User::ROLE_CLIENT)
            ->orderBy('email')
            ->get();
    }
}
