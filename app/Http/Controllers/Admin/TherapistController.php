<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TherapistService;

class TherapistController extends Controller
{
    protected $therapistService;

    public function __construct(TherapistService $therapistService)
    {
        $this->therapistService = $therapistService;
    }

    public function index()
    {
        $therapists = $this->therapistService->getAll();

        return view('admin.therapists', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Therapists', 'url' => null],
            ],
        ], compact('therapists'));
    }
}
