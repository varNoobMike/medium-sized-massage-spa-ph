<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TherapistService;


class TherapistController extends Controller
{

    /**
     * Constructor
     * 
     */
    public function __construct(private TherapistService $service) {}


    /**
     * Display therapists
     * 
     */
    public function index()
    {
        $therapists = $this->service->getTherapists();

        return view('admin.therapists.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Therapists', 'url' => null],
            ],
        ], compact('therapists'));
    }


    /**
     * Approve therapist
     * 
     */
    public function approve(User $therapist)
    {
        $this->service->approveTherapist($therapist);
        return redirect()
            ->route('admin.therapists.index')
            ->with(
                'therapist_action_success',
                "Therapist '$therapist->email' is approved successfully.",
            );
    }
}
