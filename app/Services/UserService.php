<?php

namespace App\Services;

use App\Models\User;

// general purpose user service class
class UserService
{

    public function getOneById(int $id){
        return User::where('id', $id)->get();
    }

    public function getAllByRole(string $role){
        return User::where('role', $role)->get();
    }

    public function getAll(){
        return User::all();
    }

   

}
