<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\Binaries\Exceptions;

use Exception;

class FailedToLoadXMLException extends Exception
{
    public function __construct(protected string $resource)
    {
        parent::__construct("Failed to load xml from resource");
    }

    public function getResource(): string
    {
        return $this->resource;
    }
}
