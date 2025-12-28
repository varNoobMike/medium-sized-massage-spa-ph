<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminTherapistController extends Controller
{
    public function index()
    {
        $therapists = $this->getTherapists();

        return view('admin.therapists', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Therapists', 'url' => null],
            ],
        ], compact('therapists'));
    }

    // change to private later
    public function getTherapists()
    {
        return User::where('role', 'Therapist')->orderBy('email')->get();
    }

}
