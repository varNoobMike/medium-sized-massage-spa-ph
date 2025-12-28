<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TherapistWeeklyScheduleController extends Controller
{
    public function index()
    {
        $therapistWeeklySchedules = $this->getTherapistWeeklySchedules();   

        return view('therapist.weekly-schedules', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('therapist.dashboard.index')],
                ['title' => 'My Weekly Schedules', 'url' => null],
            ],
        ], compact('therapistWeeklySchedules'));
    }


    public function getTherapistWeeklySchedules()
    {
        return User::with('userWeeklySchedules')->where('id', Auth::user()->id)->where('role', 'Therapist')->get();
    }
}