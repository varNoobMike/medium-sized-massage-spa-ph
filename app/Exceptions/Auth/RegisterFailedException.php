<?php

namespace App\Exceptions\Auth;

use Illuminate\Http\RedirectResponse;
use Exception;


class RegisterFailedException extends Exception
{
    public function __construct(
        string $message = 'Failed to register user.'
    ) {

        parent::__construct($message);
    }


    public function render($request): RedirectResponse
    {

        return back()
            ->withInput()
            ->withErrors([
                'register_user_error' => $this->getMessage(),
            ]);
    }
}
