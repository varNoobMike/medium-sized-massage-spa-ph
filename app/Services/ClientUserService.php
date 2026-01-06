<?php

namespace App\Services;

use App\Models\User;



class ClientUserService
{

    /* no create method yet, insertion is done by auth service's register method */

    /* get a row of client user by id */
    public function getClientById(int $id)
    {
        return User::where('role', User::ROLE_CLIENT)
            ->where('id', $id)
            ->first();
    }

    /* get rows of client users */
    public function getAllClients()
    {
        return User::where('role', User::ROLE_CLIENT)
            ->orderBy('email')
            ->get();
    }
}
