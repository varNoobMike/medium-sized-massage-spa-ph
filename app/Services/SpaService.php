<?php

namespace App\Services;

use App\Models\Spa;

class SpaService
{
    /**
     * Get profile
     * 
     */
    public function getProfile(): Spa|null
    {
        return Spa::with('company')->first();
    }
}
