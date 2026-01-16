<?php

namespace App\Services;

use App\Models\Spa;

class SpaSettingService
{
    /**
     * Get profile
     * 
     */
    public function getSetting(): Spa|null
    {
        return Spa::with('spaSetting')->first();
    }
}
