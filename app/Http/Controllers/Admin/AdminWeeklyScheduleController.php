<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpaWeeklySchedule;

class AdminWeeklyScheduleController extends Controller
{
    public function __invoke()
    {
        $weeklySchedules = $this->read();

        return view('admin.weekly-schedules', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard')],
                ['title' => 'Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }

    public function create(Request $request){
        // Validate 
        /*$schedule = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Set selected Day of Week db column 'is_current' to false
        SpaWeeklySchedule::update(
            [
                'day_of_week' => $schedule['day_of_week']
            ]
        )

        // Insert schedule
        */

    }

    public function read()
    {
        return SpaWeeklySchedule::with(['creator', 'spa'])->latest()->get();
    }

    


}
