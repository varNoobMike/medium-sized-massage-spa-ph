<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;


class RegisterClientService
{

    public function register(array $data)
    {
        
      
        // Use a transaction to ensure data integrity
        DB::transaction(function () use ($data) {

            User::create([
                 'email' => $data['email'],
                 'name' => $data['name'],
                 'password' => $data['password'], // auto hashed via User model cast
                 'role' => 'Client',
            ]);

        });

    }


   


}
