<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spa;

class AdminSpaProfileController extends Controller
{
    public function index()
    {
        $spaProfile = $this->getSpaProfile();

        return view('admin.spa-profile', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Profile', 'url' => null],
            ],
        ], compact('spaProfile'));
    }

    // change to private later
    public function getSpaProfile()
    {
        return Spa::with('company')->where('is_main_branch', true)->get();
    }
}
