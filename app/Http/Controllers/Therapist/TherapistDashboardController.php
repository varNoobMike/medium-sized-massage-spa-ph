<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;

class TherapistDashboardController extends Controller
{
    public function __invoke()
    {

        return view('therapist.dashboard', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.dashboard.index')],
                ['title' => 'Dashboard', 'url' => null],
            ],
        ]);
        
    }
}
