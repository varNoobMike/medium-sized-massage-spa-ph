<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SpaService;

class SpaProfileController extends Controller
{

    /**
     * Constructor
     * 
     */
    public function __construct(private SpaService $service) {}

    /**
     * Display spa profile
     * 
     */
    public function index()
    {

        $profile = $this->service->getProfile();

        return view('admin.spa-profile.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Profile', 'url' => null],
            ],
        ], compact('profile'));
    }
}
