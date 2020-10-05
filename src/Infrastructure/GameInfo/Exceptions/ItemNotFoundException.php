<?php

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;

class ItemNotFoundException extends Exception
{
    /** @var string */
    protected $query;

    /**
     * GuildNotFoundException constructor.
     *
     * @param string          $query
     * @param \Exception|null $previous
     */
    public function __construct(string $query, Exception $previous = null)
    {
        parent::__construct("Failed to resolve item identified by $query", 400, $previous);
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }
}