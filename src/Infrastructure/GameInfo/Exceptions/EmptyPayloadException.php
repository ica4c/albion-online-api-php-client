<?php

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;

class EmptyPayloadException extends Exception
{
    /**
     * EmptyPayloadException constructor.
     */
    public function __construct()
    {
        parent::__construct('Request produced empty payload');
    }
}