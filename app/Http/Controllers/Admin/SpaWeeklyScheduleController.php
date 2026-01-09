<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomDomainException;
use App\Http\Requests\SpaWeeklyScheduleRequest;
use App\Models\SpaWeeklySchedule;
use App\Services\SpaWeeklyScheduleService;


class SpaWeeklyScheduleController extends Controller
{

    /**
     * Constructor
     * 
     */
    public function __construct(private SpaWeeklyScheduleService $service) {}


    /**
     * Display schedules
     * 
     */
    public function index()
    {
        $weeklySchedules = $this->service->getSchedules();

        return view('admin.spa-weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }


    /**
     * Update schedule
     * 
     */
    public function update(SpaWeeklyScheduleRequest $request, SpaWeeklySchedule $spaWeeklySchedule)
    {

        try {

            $updateScheduleData = $request->validated();
            $updatedSchedule = $this->service->updateSchedule($spaWeeklySchedule, $updateScheduleData);

            session()->flash('updatedSchedule', $updatedSchedule);

            return redirect()
                ->route('admin.spa-weekly-schedules.index')
                ->with(
                    'spa_weekly_schedule_update_success',
                    "Schedule is updated successfully for day of week '{$spaWeeklySchedule->day_of_week}'."
                );
        } catch (CustomDomainException $e) {

            return redirect()->back()
                ->withErrors(
                    [
                        'spa_weekly_schedule_update_error' =>
                        "Failed to update schedule for day of week '{$spaWeeklySchedule->day_of_week}'."
                    ]
                );
        }
    }
}
