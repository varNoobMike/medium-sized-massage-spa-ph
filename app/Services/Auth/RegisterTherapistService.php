<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Services\SpaService;


class RegisterTherapistService
{
    protected $spaService;

    public function __construct(SpaService $spaService){
        $this->spaService = $spaService;
    }

    public function register(array $data)
    {
        $spaId = $this->spaService->getMainBranch()->id; // Spa main branch ID


        // Use a transaction to ensure data integrity
        DB::transaction(function () use ($data, $spaId) {

            $user = User::create([
                 'email' => $data['email'],
                 'name' => $data['name'],
                 'password' => $data['password'], // auto hashed via User model cast
                 'role' => 'Therapist',
            ]);

            // Attach to spa pivot table
            $user->spas()->sync([$spaId]);

        });

    }


   


}
