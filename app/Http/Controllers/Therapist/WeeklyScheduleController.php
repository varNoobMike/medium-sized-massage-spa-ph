<?php

namespace App\Http\Controllers\Therapist;


use App\Actions\StaffWeeklySchedule\GetStaffWeeklySchedulesAction;
use App\Actions\User\UpdateStaffWeeklyScheduleAction;
use App\Exceptions\CustomDomainException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StaffWeeklyScheduleRequest;
use App\Models\StaffWeeklySchedule;
use Illuminate\Support\Facades\Auth;


class WeeklyScheduleController extends Controller
{


    /**
     * Get current logged in therapist (staff) schedules
     * 
     */
    public function index(GetStaffWeeklySchedulesAction $action)
    {
        $therapist = Auth::user();
        $weeklySchedules = $action->run($therapist);

        return view('therapist.weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Therapist', 'url' => route('therapist.dashboard.index')],
                ['title' => 'My Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }


    /**
     * Update logged in therapist (staff) day of week schedule
     * 
     */
    public function update(
        StaffWeeklyScheduleRequest $request,
        StaffWeeklySchedule $weeklySchedule,
        UpdateStaffWeeklyScheduleAction $action
    ) {

        try {
            $scheduleData = $request->validated();
            $action->run($weeklySchedule, $scheduleData);

            return redirect()
                ->route('therapist.weekly-schedules.index')
                ->with(
                    'staff_weekly_schedule_update_success',
                    "Schedule is updated successfully for day of week '$weeklySchedule->day_of_week'."
                );
        } catch (CustomDomainException $e) {

            return redirect()->back()
                ->withErrors(
                    ['staff_weekly_schedule_update_error' =>
                    "Failed to update schedule for day of week '$weeklySchedule->day_of_week'."]
                );
        }
    }
}
