<?php

namespace App\Services;

use App\Models\User;


class ClientService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        # code
    }


    /**
     * Get clients
     * 
     */
    public function getClients()
    {
        return User::where('role', User::ROLE_CLIENT)
            ->orderBy('email')
            ->get();
    }
}
