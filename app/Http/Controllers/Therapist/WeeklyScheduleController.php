<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffWeeklyScheduleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StaffWeeklyScheduleService;


class WeeklyScheduleController extends Controller
{
    private StaffWeeklyScheduleService $staffWeeklyScheduleService;

    public function __construct(StaffWeeklyScheduleService $staffWeeklyScheduleService){
        $this->staffWeeklyScheduleService = $staffWeeklyScheduleService;
    }


    public function index()
    {
        $userId = Auth::user()->id;
        $weeklySchedules = $this->staffWeeklyScheduleService->getAllByUserId($userId);

        return view('therapist.weekly-schedule.index', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.dashboard.index')],
                ['title' => 'My Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }


    public function update(StaffWeeklyScheduleRequest $request, int $scheduleId)
    {

        $validated = $request->validated();
        $userId = Auth::user()->id;
        
        $this->staffWeeklyScheduleService->update($validated, $scheduleId, $userId);

        return redirect()->route('therapist.weekly-schedule.index')
            ->with('staff_weekly_schedule_update_success', 'Schedule updated successfully.');
    }

    

}
