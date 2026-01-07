<?php

namespace App\Exceptions;

use Exception;

/**
 * Class CustomDomainException
 *
 * This exception represents a business/domain logic error.
 */
class CustomDomainException extends Exception
{

    /**
     * Constructor
     *
     * @param string $message
     */
    public function __construct(string $message = "Domain error.")
    {
        parent::__construct($message);
    }
}
