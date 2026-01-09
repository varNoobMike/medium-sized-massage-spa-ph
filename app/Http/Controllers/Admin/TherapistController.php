<?php

namespace App\Http\Controllers\Admin;

// use App\Actions\User\ApproveTherapistUserAction;
use App\Http\Controllers\Controller;
use App\Services\TherapistService;

class TherapistController extends Controller
{

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


    /* Approve therapist
    
    public function approve(User $therapist, ApproveTherapistUserAction $action)
    {
        try {
            $action->run($therapist);

            return redirect()
                ->route('admin.therapists.index')
                ->with('approve_therapist_success', "Therapist '$therapist->email' is approved successfully.");
        } catch (CustomDomainException $e) {
            return redirect()
                ->back()
                ->withErrors(['approve_therapist_error' => "Failed to approve therapist '$therapist->email'."]);
        }
    }

    */
}
