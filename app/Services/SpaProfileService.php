<?php

namespace App\Services;

use App\Models\Spa;

class SpaProfileService
{
    public function getMainBranchProfile()
    {
        return Spa::with('company')->where('is_main_branch', true)->get();
    }
}
