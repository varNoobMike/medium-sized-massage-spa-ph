<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spa;

class AdminSpaProfileController extends Controller
{
    public function __invoke()
    {
        $spaProfile = $this->read();

        return view('admin.spa-profile', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard')],
                ['title' => 'Spa Profile', 'url' => null],
            ],
        ], compact('spaProfile'));
    }

    public function read()
    {
        return Spa::all();
    }

}
