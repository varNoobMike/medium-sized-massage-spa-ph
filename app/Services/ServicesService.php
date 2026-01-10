<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Service;


class ServicesService
{
    /**
     * Get services
     * 
     */
    public function getServices(): Collection
    {
        return Service::orderBy('name')->get();
    }
}
