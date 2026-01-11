<?php

namespace App\Exceptions\SpaWeeklySchedule;

use Illuminate\Http\RedirectResponse;
use Exception;


class ScheduleCreateFailedException extends Exception
{
    public function __construct(
        string $message = 'Failed to create schedule.'
    ) {

        parent::__construct($message);
    }


    public function render($request): RedirectResponse
    {

        return back()
            ->withInput()
            ->withErrors([
                'spa_weekly_schedule_create_error' => $this->getMessage(),
            ]);
    }
}
