<?php

namespace App\Services;

use App\Models\Spa;

class SpaService
{
    /**
     * Get Spa
     * 
     */
    public function getSpa(): Spa|null
    {
        return Spa::first();
    }
}
