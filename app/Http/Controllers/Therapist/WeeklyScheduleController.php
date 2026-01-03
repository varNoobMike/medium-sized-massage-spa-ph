<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffWeeklyScheduleRequest;
use App\Models\StaffWeeklySchedule;
use Illuminate\Support\Facades\Auth;
use App\Services\StaffWeeklyScheduleService;


class WeeklyScheduleController extends Controller
{

    private StaffWeeklyScheduleService $staffWeeklyScheduleService;

    // constructor
    public function __construct(StaffWeeklyScheduleService $staffWeeklyScheduleService)
    {
        $this->staffWeeklyScheduleService = $staffWeeklyScheduleService;
    }

    // index
    public function index()
    {
        $weeklySchedules = $this->staffWeeklyScheduleService
            ->getAllByUserId(Auth::user()->id);

        return view('therapist.weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.dashboard.index')],
                ['title' => 'My Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }

    // update 
    public function update(StaffWeeklyScheduleRequest $request, StaffWeeklySchedule $weeklySchedule)
    {

        $this->staffWeeklyScheduleService
            ->update($weeklySchedule, $request->validated());

        return redirect()->route('therapist.weekly-schedules.index')
            ->with('staff_weekly_schedule_update_success', 'Schedule updated successfully.');
    }
}
