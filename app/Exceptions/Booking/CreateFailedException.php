<?php

namespace App\Exceptions\SpaWeeklySchedule;

use Illuminate\Http\RedirectResponse;
use Exception;


class CreateFailedException extends Exception
{
    public function __construct(
        string $message = 'Failed to create booking.'
    ) {

        parent::__construct($message);
    }


    public function render($request): RedirectResponse
    {

        return back()
            ->withInput()
            ->withErrors([
                'booking_create_error' => $this->getMessage(),
            ]);
    }
}
