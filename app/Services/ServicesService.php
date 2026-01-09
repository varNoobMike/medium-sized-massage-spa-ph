<?php

namespace App\Services;

use App\Models\Service;


class ServicesService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        # code
    }



    /**
     * Get services
     * 
     */
    public function getServices()
    {
        return Service::orderBy('name')->get();
    }
}
