<?php

namespace App\Exceptions\SpaWeeklySchedule;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Exception;


class ThreapistApproveFailedException extends Exception
{

    public function __construct(
        public User $therapist,
        string $message = 'Failed to approve therapist.'
    ) {

        parent::__construct($message);
    }


    public function render($request): RedirectResponse
    {

        return back()
            ->withInput()
            ->withErrors([
                'therapist_approve_error' => $this->getMessage(),
            ]);
    }
}
