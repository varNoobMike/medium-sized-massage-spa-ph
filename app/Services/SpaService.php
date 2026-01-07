<?php

namespace App\Services;

use App\Models\Spa;

/* Service class for `spas` */

class SpaService
{
    public function getFirstSpa()
    {
        return Spa::with('company')->first();
    }

    public function getAllSpas()
    {
        return Spa::with('company')->get();
    }
}
