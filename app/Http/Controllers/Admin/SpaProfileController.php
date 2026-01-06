<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SpaService;
use App\Services\CompanyService;


class SpaProfileController extends Controller
{

    public function __construct(private SpaService $spaService, private CompanyService $companyService) {}

    public function index()
    {

        $spa = $this->spaService->getFirstSpa();
        $company = $this->companyService->getFirstCompany();

        return view('admin.spa-profile.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Profile', 'url' => null],
            ],
        ], compact('spa', 'company'));
    }
}
