<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Services\SpaWeeklyScheduleService;

class SpaWeeklyScheduleController extends Controller
{

    /**
     * Get all spa weekly schedules
     * 
     */
    public function __invoke(SpaWeeklyScheduleService $service)
    {
        $schedules = $service->getSchedules('FORMATTED');

        return view('therapist.spa-weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('schedules'));
    }
}
