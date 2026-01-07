<?php

namespace App\Http\Controllers\Admin;

use App\Actions\SpaWeeklySchedule\GetAllSpaWeeklySchedulesAction;
use App\Actions\SpaWeeklySchedule\UpdateWeeklyScheduleAction;
use App\Exceptions\CustomDomainException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpaWeeklyScheduleRequest;
use App\Models\SpaWeeklySchedule;


class SpaWeeklyScheduleController extends Controller
{


    /**
     * Display all spa weekly scheduless
     * 
     */
    public function index(GetAllSpaWeeklySchedulesAction $action)
    {
        $weeklySchedules = $action->run();

        return view('admin.spa-weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }


    /**
     * Update spa day of week schedule
     * 
     */
    public function update(
        SpaWeeklyScheduleRequest $request,
        SpaWeeklySchedule $spaWeeklySchedule,
        UpdateWeeklyScheduleAction $action
    ) {

        try {
            $scheduleData = $request->validated();
            $action->run($spaWeeklySchedule, $scheduleData);

            return redirect()
                ->route('admin.spa-weekly-schedules.index')
                ->with(
                    'spa_weekly_schedule_update_success',
                    "Schedule is updated successfully for day of week '$spaWeeklySchedule->day_of_week'."
                );
        } catch (CustomDomainException $e) {

            return redirect()->back()
                ->withErrors(
                    ['spa_weekly_schedule_update_error' =>
                    "Failed to update schedule for day of week '$spaWeeklySchedule->day_of_week'."]
                );
        }
    }
}
