<?php

namespace App\Services;

use App\Models\Spa;

class SpaContext
{
    
    public static function getMainBranchID()
    {
        return Spa::where('is_main_branch', true)->first()->id;
    }

    
}
