<?php

namespace App\Services\User;

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
        return User::create([
            'name' => $createClientData['name'],
            'email' => $createClientData['email'],
            'password' => $createClientData['password'],
            'role' => User::ROLE_CLIENT,
        ]);
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
