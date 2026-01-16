<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SpaSettingService;

class SpaSettingController extends Controller
{

    /**
     * Constructor
     * 
     */
    public function __construct(private SpaSettingService $service) {}

    /**
     * Display spa settings
     * 
     */
    public function index()
    {

        $breadcrumbs = [
            ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
            ['title' => 'Spa Settings', 'url' => null],
        ];

        $setting = $this->service->getSetting();

        return view('admin.spa-settings.index', compact('breadcrumbs', 'setting'));
    }
}
