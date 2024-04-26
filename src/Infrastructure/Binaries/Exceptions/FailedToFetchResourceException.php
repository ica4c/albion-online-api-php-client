<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\Binaries\Exceptions;

use Exception;
use Throwable;

class FailedToFetchResourceException extends Exception
{
    /**
     * FailedToFetchResourceException constructor.
     *
     * @param string          $resource
     * @param \Throwable|null $previous
     */
    public function __construct(
        protected string $resource,
        ?Throwable $previous = null
    ) {
        parent::__construct("Failed to fetch resource. " . ($previous ? $previous->getMessage() : ''));
    }

    /**
     * @return string
     */
    public function getResource(): string
    {
        return $this->resource;
    }
}
