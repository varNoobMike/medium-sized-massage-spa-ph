<?php

namespace App\Services;

use App\Models\Spa;

class SpaService
{
    
    public function getMainBranch()
    {
        return Spa::with('company')->where('is_main_branch', true)->first();
    }

    public function getAll(){
        return Spa::with('company')->get();
    }

    
}
