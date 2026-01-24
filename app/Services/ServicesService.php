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


    /**
     * Get service by ID
     * 
     */
    public function getServiceById(int $id): Service|null
    {
        return Service::where('id', $id)
            ->first();
    }
}
