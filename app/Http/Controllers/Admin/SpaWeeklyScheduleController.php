<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpaWeeklySchedule\UpdateScheduleRequest;
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
    public function update(UpdateScheduleRequest $request, SpaWeeklySchedule $schedule)
    {

        $updateData = $request->validated();

        $updatedSchedule = $this->service
            ->updateSchedule($schedule, $updateData);

        session()->flash('updatedSchedule', collect([
            'id' => $updatedSchedule->id,
            'day_of_week' => $updatedSchedule->day_of_week,
        ]));


        return redirect()
            ->route('admin.spa-weekly-schedules.index')
            ->with(
                'spa_weekly_schedule_update_success',
                "Schedule is updated successfully for day of week '{$schedule->day_of_week}'."
            );
    }
}
