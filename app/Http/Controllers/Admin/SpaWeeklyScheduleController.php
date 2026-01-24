<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpaWeeklySchedule\StoreScheduleRequest;
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
        $schedules = $this->service->getSchedules('FORMATTED');

        // dd($schedules);

        return view('admin.spa-weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('schedules'));
    }

    /**
     * Store schedule
     * 
     */
    public function store(StoreScheduleRequest $request)
    {

        $createdSchedule = $this->service->createSchedule(collect($request->validated()));

        return redirect()
            ->route('admin.spa-weekly-schedules.index')
            ->with(
                'spa_weekly_schedule_create_success',
                "Time slot schedule is created successfully for '$createdSchedule->day_of_week'.",
            );
    }


    /**
     * Update schedule
     * 
     */
    public function update(UpdateScheduleRequest $request, SpaWeeklySchedule $schedule)
    {

        $updateData = collect($request->validated());

        $updatedSchedule = $this->service
            ->updateSchedule($schedule, $updateData);


        return redirect()
            ->route('admin.spa-weekly-schedules.index')
            ->with(
                'spa_weekly_schedule_action_success',
                "Time slot schedule is updated successfully for '$updatedSchedule->day_of_week'."
            );
    }
}
