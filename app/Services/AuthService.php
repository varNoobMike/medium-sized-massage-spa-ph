<?php

namespace App\Services;

use InvalidArgumentException;

use Illuminate\Support\Facades\Auth;

use App\Exceptions\Auth\LoginFailedException;
use App\Models\User;
use App\Services\User\ClientService;
use App\Services\User\TherapistService;


class AuthService
{
    /**
     * Constructor
     * 
     */
    public function __construct(private ClientService $clientService, private TherapistService $therapistService) {}


    /**
     * Login user
     * 
     */
    public function login(array $credentials): User|null
    {
        if (! Auth::attempt($credentials)) {
            throw new LoginFailedException('Incorrect email or password.');
        }

        request()->session()->regenerate();
        return Auth::user();
    }


    /**
     * Logout user
     * 
     */
    public function logout(): bool
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return true;
    }

    /**
     * Register user
     * 
     */
    public function register(array $registerUserData, string $role): User|null
    {

        return match ($role) {
            User::ROLE_CLIENT => $this->clientService->createClient($registerUserData),
            User::ROLE_THERAPIST => $this->therapistService->createTherapist($registerUserData),
            default => throw new InvalidArgumentException("Invalid role '{$role}'."),
        };
    }
}
