<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpaWeeklyScheduleRequest;
use App\Models\SpaWeeklySchedule;
use App\Services\SpaWeeklyScheduleService;


class SpaWeeklyScheduleController extends Controller
{

    public function __construct(private SpaWeeklyScheduleService $spaWeeklyScheduleService) {}


    public function index()
    {
        $weeklySchedules = $this->spaWeeklyScheduleService
            ->getAllSchedules();

        return view('admin.spa-weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }


    /* update */
    public function update(SpaWeeklyScheduleRequest $request, SpaWeeklySchedule $spaWeeklySchedule)
    {

        // dd($request->validated());

        $this->spaWeeklyScheduleService
            ->updateSchedule($spaWeeklySchedule, $request->validated());

        return redirect()
            ->route('admin.spa-weekly-schedules.index')
            ->with('spa_weekly_schedule_update_success', 'Schedule updated successfully.');
    }
}
