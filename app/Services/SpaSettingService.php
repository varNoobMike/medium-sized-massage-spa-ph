<?php

namespace App\Services;

use App\Models\SpaSetting;

class SpaSettingService
{
    /**
     * Get setting
     * 
     */
    public function getSetting(): SpaSetting|null
    {
        return SpaSetting::with('spa')->first();
    }
}
