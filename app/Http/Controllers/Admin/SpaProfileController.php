<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SpaProfileService;

class SpaProfileController extends Controller
{
    protected $spaProfileService;

    public function __construct(SpaProfileService $spaProfileService)
    {
        $this->spaProfileService = $spaProfileService;
    }

    public function index()
    {
        $spaProfile = $this->spaProfileService->getMainBranchProfile(); // Main Branch of Spa

        return view('admin.spa-profile.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Profile', 'url' => null],
            ],
        ], compact('spaProfile'));
    }
}
