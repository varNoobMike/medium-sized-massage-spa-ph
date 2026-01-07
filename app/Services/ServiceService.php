<?php

namespace App\Services;

use App\Models\Service;

/* Service class for `services` */

class ServiceService
{

    public function getAllServices()
    {
        return Service::orderBy('name')
            ->get();
    }
}
