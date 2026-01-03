<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpaWeeklyScheduleRequest;
use App\Models\SpaWeeklySchedule;
use App\Services\SpaWeeklyScheduleService;


class SpaWeeklyScheduleController extends Controller
{

    private SpaWeeklyScheduleService $spaWeeklyScheduleService;

    // constructor
    public function __construct(SpaWeeklyScheduleService $spaWeeklyScheduleService)
    {
        $this->spaWeeklyScheduleService = $spaWeeklyScheduleService;
    }

    // index
    public function index()
    {
        $weeklySchedules = $this->spaWeeklyScheduleService
            ->getAllFromMainBranch();

        return view('admin.spa-weekly-schedule.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }


    // update
    public function update(SpaWeeklyScheduleRequest $request, SpaWeeklySchedule $schedule)
    {

        $this->spaWeeklyScheduleService
            ->update($schedule, $request->validated());

        return redirect()
            ->route('admin.spa-weekly-schedule.index')
            ->with('spa_weekly_schedule_update_success', 'Schedule updated successfully.');
    }
    
}
