<?php

namespace App\Services;

use App\Models\Service;

class ServiceService
{

    public function getAll()
    {
        return Service::orderBy('name')
            ->get();
    }
}
