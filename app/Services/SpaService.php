<?php

namespace App\Services;

use App\Models\Spa;

class SpaService
{
    /**
     * Get profile
     * 
     */
    public function getProfile(): ?Spa
    {
        return Spa::with('company')->first();
    }
}
