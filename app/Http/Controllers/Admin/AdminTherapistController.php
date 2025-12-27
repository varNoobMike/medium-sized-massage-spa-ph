<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminTherapistController extends Controller
{
    public function index()
    {
        $therapists = $this->read();

        return view('admin.therapists', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Therapists', 'url' => null],
            ],
        ], compact('therapists'));
    }

    // for testing only, may replace public to private later
    public function read()
    {
        return User::where('role', 'Therapist')->orderBy('email')->get();
    }
}
