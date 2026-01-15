<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Services\ServicesService;

class ServiceController extends Controller
{

    /**
     * Display all spa's services
     * 
     */
    public function __invoke(ServicesService $service)
    {
        $services = $service->getServices();

        return view('therapist.services.index', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.dashboard.index')],
                ['title' => 'Spa Services', 'url' => null],
            ],
        ], compact('services'));
    }
}
