<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

// auth service class
class AuthService
{

    // login
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

    // logout
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return true;
    }

    // register user based on role
    public function register(array $data, string $role, ?int $spaId = null)
    {
        // check if role is valid
        if (!in_array($role, User::ROLES)) {
            throw ValidationException::withMessages([
                'register_error' => 'Invalid user role.',
            ]);
        }

        // use transaction
        DB::transaction(function () use ($data, $role, $spaId) {

            // insert user
            $user =  User::create([
                'email' => $data['email'],
                'name' => $data['name'],
                'password' => $data['password'], // auto hashed at user model
                'role' => $role,
            ]);


            // if non-client (worker)
            if ($user->role !== 'Client') {
                // insert to it's pivot table (`spa_staff`)
                $user->spas()->sync([$spaId]);
            }

            // check if user is inserted
            if (!$user) {
                throw ValidationException::withMessages([
                    'register_error' => 'Failed to register.',
                ]);
            }

            // get the inserted user
            return $user;
        });
    }
}
