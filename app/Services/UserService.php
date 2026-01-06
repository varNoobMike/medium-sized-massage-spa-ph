<?php

namespace App\Services;

use App\Models\User;
use InvalidArgumentException;

class UserService
{

    public function getUserById(int $id)
    {
        return User::where('id', $id)->get();
    }

    public function getUsersByRole(string $role)
    {
        if (!in_array($role, User::ROLES)) {
            throw new InvalidArgumentException("Invalid user role: $role");
        }
        return User::where('role', $role)->get();
    }

    public function getAllUsers()
    {
        return User::get();
    }
}
