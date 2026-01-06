<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /* invoke */
    public function __invoke()
    {
        return view('admin.dashboard.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Dashboard', 'url' => null],
            ],
        ]);
    }
}
