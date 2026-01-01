<?php

namespace App\Services;

use App\Models\Spa;

class SpaService
{
    // is for seeding also and so is set to 'static'
    public static function getMainBranch()
    {
        return Spa::with('company')->where('is_main_branch', true)->first();
    }

    
}
