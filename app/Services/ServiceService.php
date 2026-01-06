<?php

namespace App\Services;

use App\Models\Service;


class ServiceService
{

    public function getAllServices()
    {
        return Service::orderBy('name')
            ->get();
    }
}
