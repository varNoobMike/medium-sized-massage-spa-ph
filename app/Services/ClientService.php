<?php

namespace App\Services;

use App\Models\User;

class ClientService
{
    public function getService(string $id)
    {
        return User::where('role', 'Client')->where('id', $id)->orderBy('email')->get();
    }

    public function getAllServices()
    {
        return User::where('role', 'Client')->orderBy('email')->get();
    }
}
