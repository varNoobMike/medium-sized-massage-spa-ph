<?php

namespace App\Services;

use App\Models\Spa;

class SpaContextService
{
    // for seeding
    public static function getMainBranchID()
    {
        return Spa::where('is_main_branch', true)->first()->id;
    }

    
}
