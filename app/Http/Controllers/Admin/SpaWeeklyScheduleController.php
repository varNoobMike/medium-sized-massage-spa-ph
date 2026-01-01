<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SpaWeeklyScheduleRequest;
use App\Models\Spa;
use App\Models\SpaWeeklySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\SpaWeeklyScheduleService;


class SpaWeeklyScheduleController extends Controller
{
    protected $spaWeeklyScheduleService;

    public function __construct(SpaWeeklyScheduleService $spaWeeklyScheduleService)
    {
        $this->spaWeeklyScheduleService = $spaWeeklyScheduleService;
    }

    public function index()
    {
        $weeklySchedules = $this->spaWeeklyScheduleService->getAll();

        return view('admin.spa-weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }

   
    public function update(SpaWeeklyScheduleRequest $request, string $id)
    {
        // Validate and update
        $this->spaWeeklyScheduleService->update($request->validated(), $id);

        // Redirect with success message
        return redirect()
            ->route('admin.spa-weekly-schedules.index')
            ->with('spa_weekly_schedule_update_success', 'Schedule updated successfully!');
    }


    

    

}
