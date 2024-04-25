<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;
use Throwable;

class GuildNotFoundException extends Exception
{
    public function __construct(protected string $query, Throwable $previous = null)
    {
        parent::__construct("Failed to resolve guild with provided query", 400, $previous);
    }

    public function getQuery(): string
    {
        return $this->query;
    }
}
