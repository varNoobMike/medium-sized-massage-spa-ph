<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Spa\GetSpaProfileAction;
use App\Http\Controllers\Controller;


class SpaProfileController extends Controller
{


    /**
     * Display spa profile
     * 
     */
    public function index(GetSpaProfileAction $action)
    {

        $spaProfile = $action->run();

        // dd($spaProfile->company->email);

        return view('admin.spa-profile.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Profile', 'url' => null],
            ],
        ], compact('spaProfile'));
    }
}
