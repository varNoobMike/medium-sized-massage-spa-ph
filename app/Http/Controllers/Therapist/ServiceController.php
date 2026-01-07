<?php

namespace App\Http\Controllers\Therapist;

use App\Actions\Services\GetAllServicesAction;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{

    /**
     * Display all spa's services
     * 
     */
    public function __invoke(GetAllServicesAction $action)
    {
        $services = $action->run();

        return view('therapist.services.index', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.services.index')],
                ['title' => 'Spa Services', 'url' => null],
            ],
        ], compact('services'));
    }
}
