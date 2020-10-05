<?php

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;

class FailedToPerformRequestException extends Exception
{
    public function __construct(Exception $previous = null)
    {
        parent::__construct('Failed to perform request', 400, $previous);
    }
}