<?php

namespace Albion\API\Infrastructure\Binaries\Exceptions;

use Exception;
use Throwable;

class FailedToFetchResourceException extends Exception
{
    /** @var string */
    protected $resource;

    /**
     * FailedToFetchResourceException constructor.
     *
     * @param string          $resource
     * @param \Throwable|null $previous
     */
    public function __construct(string $resource, ?Throwable $previous = null)
    {
        parent::__construct("Failed to fetch $resource. " . ($previous ? $previous->getMessage() : ''));
        $this->resource = $resource;
    }

    /**
     * @return string
     */
    public function getResource(): string
    {
        return $this->resource;
    }
}