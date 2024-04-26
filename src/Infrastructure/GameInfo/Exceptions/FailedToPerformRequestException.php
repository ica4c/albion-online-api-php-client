<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;
use Throwable;

class FailedToPerformRequestException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Failed to perform request', 400, $previous);
    }
}
