<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/* Service class for authentication */

class AuthService
{

    /* login */
    public function login(array $credentials)
    {
        // Attempt to authenticate the user
        if (! Auth::attempt($credentials)) {

            throw ValidationException::withMessages([
                'auth_error' => 'Invalid credentials.',
            ]);
        }

        request()->session()->regenerate();

        return Auth::user();
    }

    /* logout */
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return true;
    }

    /* register user based on role */
    public function register(array $data, string $role)
    {
        // check if role is valid
        if (!in_array($role, User::ROLES)) {
            throw ValidationException::withMessages([
                'register_error' => 'Invalid user role.',
            ]);
        }

        // use transaction
        return DB::transaction(function () use ($data, $role) {

            // insert user
            return User::create([
                'email' => $data['email'],
                'name' => $data['name'],
                'password' => $data['password'], // auto hashed at user model
                'role' => $role,
            ]);
        });
    }
}
