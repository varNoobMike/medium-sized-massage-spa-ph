<?php

namespace App\Actions\Services;

use App\Models\Service;

class GetAllServicesAction
{
    /**
     * Get all services, order by name
     * 
     */
    public function run()
    {
        return Service::orderBy('name')
            ->get();
    }
}
