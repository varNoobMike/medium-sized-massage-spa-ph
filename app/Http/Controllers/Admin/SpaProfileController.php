<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SpaService;


class SpaProfileController extends Controller
{
    private SpaService $spaService;

    public function __construct(SpaService $spaService)
    {
        $this->spaService = $spaService;
    }

    public function index()
    {
        $spaProfile = $this->spaService->getMainBranch(); // Main Branch of Spa

        return view('admin.spa-profile.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Profile', 'url' => null],
            ],
        ], compact('spaProfile'));
    }
}
