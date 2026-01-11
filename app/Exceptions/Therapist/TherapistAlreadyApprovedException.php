<?php

namespace App\Exceptions\SpaWeeklySchedule;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Exception;


class ThreapistAlreadyApprovedException extends Exception
{

    public function __construct(
        public User $therapist,
        string $message = 'Therapist already approved.'
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
