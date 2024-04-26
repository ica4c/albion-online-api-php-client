<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;
use Throwable;

class AllianceNotFoundException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Failed to resolve alliance', 400, $previous);
    }
}
