<?php

namespace App\Services;

use App\Models\User;

/* Service class for `users` */

class UserService
{

    public function getUserById(int $id)
    {
        return User::where('id', $id)->get();
    }

    public function getUsersByRole(string $role)
    {
        return User::where('role', $role)->get();
    }

    public function getAllUsers()
    {
        return User::get();
    }
}
