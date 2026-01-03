<?php

namespace App\Services;

use App\Models\User;


// service class for client users
class ClientUserService
{

    /* no create method yet, insertion is done by auth service's register method */

    public function getOneById(int $id)
    {
        return User::where('role', 'Client')
            ->where('id', $id)
            ->first();
    }

    public function getAll()
    {
        return User::where('role', 'Client')
            ->orderBy('email')
            ->get();
    }

}
