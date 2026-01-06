<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Services\SpaWeeklyScheduleService;


class SpaWeeklyScheduleController extends Controller
{

    public function __invoke(SpaWeeklyScheduleService $spaWeeklyScheduleService)
    {
        $weeklySchedules = $spaWeeklyScheduleService
            ->getAllSchedules();

        return view('therapist.spa-weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }
}
