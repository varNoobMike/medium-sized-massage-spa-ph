<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {

        return view('therapist.dashboard.index', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.dashboard.index')],
                ['title' => 'Dashboard', 'url' => null],
            ],
        ]);
        
    }
}
