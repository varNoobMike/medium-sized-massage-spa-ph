<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TherapistUserService;


class TherapistUserController extends Controller
{

    private TherapistUserService $therapistUserService;

    public function __construct(TherapistUserService $therapistUserService)
    {
        $this->therapistUserService = $therapistUserService;
    }

    public function index()
    {
        $therapists = $this->therapistUserService->getAll();

        return view('admin.therapists.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Therapists', 'url' => null],
            ],
        ], compact('therapists'));
    }


    public function approve(int $userId)
    {
        $this->therapistUserService->approve($userId);

        return redirect()
            ->route('admin.therapists.index')
            ->with('approve_therapist_success', 'Therapist is approved successfully.');
    }


}
