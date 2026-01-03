<?php

namespace App\Services;

use App\Models\Spa;
use App\Models\Service;

class ServiceService
{

    public function getAll()
    {
        return Service::orderBy('name')
            ->orderBy('name')
            ->get();
    }

    
}
