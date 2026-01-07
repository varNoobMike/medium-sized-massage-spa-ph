<?php

namespace App\Http\Controllers\Therapist;

use App\Actions\SpaWeeklySchedule\GetAllSpaWeeklySchedulesAction;
use App\Http\Controllers\Controller;


class SpaWeeklyScheduleController extends Controller
{

    /**
     * Get all spa weekly schedules
     * 
     */
    public function __invoke(GetAllSpaWeeklySchedulesAction $action)
    {
        $weeklySchedules = $action->run();

        return view('therapist.spa-weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }
}
