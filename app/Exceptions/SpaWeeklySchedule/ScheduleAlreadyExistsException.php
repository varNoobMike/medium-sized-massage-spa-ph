<?php

namespace App\Exceptions\SpaWeeklySchedule;

use App\Models\SpaWeeklySchedule;
use Illuminate\Http\RedirectResponse;
use Exception;


class ScheduleAlreadyExistsException extends Exception
{

    public function __construct(
        public SpaWeeklySchedule $existingSchedule,
        string $message = 'Schedule already exists.'
    ) {

        parent::__construct($message);
    }


    public function render($request): RedirectResponse
    {
        session()->flash(
            'existingSchedule',
            collect([
                'id' => $this->existingSchedule->id,
                'day_of_week' => $this->existingSchedule->day_of_week,
            ])
        );

        return back()
            ->withInput()
            ->withErrors([
                'spa_weekly_schedule_update_error' => $this->getMessage(),
            ]);
    }
}
