<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ServicesService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct(private ServicesService $service) {}

    /**
     * Display services
     * 
     */
    public function index()
    {
        $services = $this->service->getServices();

        return view('admin.services.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Services', 'url' => null],
            ],
        ], compact('services'));
    }
}
