<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;

class EmptyPayloadException extends Exception
{
    public function __construct()
    {
        parent::__construct('Request produced empty payload');
    }
}
