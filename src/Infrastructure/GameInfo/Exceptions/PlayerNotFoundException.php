<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;
use Throwable;

class PlayerNotFoundException extends Exception
{
    public function __construct(protected string $query, Throwable $previous = null)
    {
        parent::__construct("Failed to resolve player with nickname: $query", 400, $previous);
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
}
