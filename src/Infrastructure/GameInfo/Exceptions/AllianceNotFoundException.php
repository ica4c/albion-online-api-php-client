<?php

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;

class AllianceNotFoundException extends Exception
{
    /**
     * AllianceNotFoundException constructor.
     *
     * @param \Exception|null $previous
     */
    public function __construct(Exception $previous = null)
    {
        parent::__construct('Failed to resolve alliance', 400, $previous);
    }
}