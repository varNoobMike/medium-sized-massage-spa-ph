<?php

namespace App\Exceptions\SpaWeeklySchedule;

use App\Models\SpaWeeklySchedule;
use Illuminate\Http\RedirectResponse;
use Exception;

class ScheduleOverlapFoundException extends Exception
{
    public function __construct(
        public SpaWeeklySchedule $overlappingSchedule,
        string $message = 'Schedule overlaps.'
    ) {

        parent::__construct($message);
    }

    public function render($request): RedirectResponse
    {
        session()->flash(
            'overlappingSchedule',
            collect([
                'id' => $this->overlappingSchedule->id,
                'day_of_week' => $this->overlappingSchedule->day_of_week,
            ])
        );

        return back()
            ->withInput()
            ->withErrors([
                'spa_weekly_schedule_update_error' => $this->getMessage(),
            ]);
    }
}
