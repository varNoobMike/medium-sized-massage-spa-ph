<?php

namespace App\Exceptions\SpaWeeklySchedule;

use App\Models\SpaWeeklySchedule;
use Illuminate\Http\RedirectResponse;
use Exception;


class ScheduleUpdateFailedException extends Exception
{

    public function __construct(
        public SpaWeeklySchedule $spaWeeklySchedule,
        string $message = 'Failed to update schedule.'
    ) {

        parent::__construct($message);
    }


    public function render($request): RedirectResponse
    {

        session()->flash(
            'spaWeeklySchedule',
            collect([
                'id' => $this->spaWeeklySchedule->id,
                'day_of_week' => $this->spaWeeklySchedule->day_of_week,
            ])
        );

        return back()
            ->withInput()
            ->withErrors([
                'spa_weekly_schedule_update_error' => $this->getMessage(),
            ]);
    }
}
