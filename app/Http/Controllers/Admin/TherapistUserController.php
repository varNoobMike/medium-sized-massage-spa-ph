<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TherapistUserService;
use App\Models\User;

class TherapistUserController extends Controller
{

    /* constructor */
    public function __construct(private TherapistUserService $therapistUserService) {}

    /* index */
    public function index()
    {
        $therapists = $this->therapistUserService->getAllTherapists();

        return view('admin.therapists.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Therapists', 'url' => null],
            ],
        ], compact('therapists'));
    }

    /* approve */
    public function approve(User $therapist)
    {
        $this->therapistUserService->approveTherapist($therapist);

        return redirect()
            ->route('admin.therapists.index')
            ->with('approve_therapist_success', 'Therapist is approved successfully.');
    }
}
