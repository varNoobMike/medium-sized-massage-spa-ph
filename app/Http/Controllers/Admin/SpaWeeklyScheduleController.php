<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpaWeeklyScheduleRequest;
use App\Services\SpaWeeklyScheduleService;
use App\Services\SpaService;

class SpaWeeklyScheduleController extends Controller
{

    private SpaWeeklyScheduleService $spaWeeklyScheduleService;
    private SpaService $spaService;

    public function __construct(
        SpaWeeklyScheduleService $spaWeeklyScheduleService,
        SpaService $spaService
    ) {
        $this->spaWeeklyScheduleService = $spaWeeklyScheduleService;
        $this->spaService = $spaService;
    }

    public function index()
    {
        $weeklySchedules = $this->spaWeeklyScheduleService->getAllFromMainBranch();

        return view('admin.spa-weekly-schedule.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }



    public function update(SpaWeeklyScheduleRequest $request, int $scheduleId)
    {
        // dd($scheduleId);

        $validated = $request->validated();
        $spaId = $this->spaService->getMainBranch()->id;
        $schedule = $this->spaWeeklyScheduleService->update($validated, $scheduleId, $spaId);

        return redirect()
            ->route('admin.spa-weekly-schedule.index')
            ->with('spa_weekly_schedule_update_success', 'Schedule updated successfully.');
    }
}
