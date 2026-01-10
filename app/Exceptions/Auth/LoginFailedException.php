<?php

namespace App\Exceptions\Auth;

use Illuminate\Http\RedirectResponse;
use Exception;


class LoginFailedException extends Exception
{
    public function __construct(
        string $message = 'Login failed.'
    ) {

        parent::__construct($message);
    }


    public function render($request): RedirectResponse
    {

        return back()
            ->withInput()
            ->withErrors([
                'login_error' => $this->getMessage(),
            ]);
    }
}
