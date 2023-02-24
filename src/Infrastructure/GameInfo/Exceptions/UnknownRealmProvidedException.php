<?php

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Exception;

class UnknownRealmProvidedException extends Exception
{
    protected string $realm;

    /**
     * @param string $realm
     */
    public function __construct(string $realm)
    {
        parent::__construct("Realm: {$realm} does not exist");
        $this->realm = $realm;
    }

    /**
     * @return string
     */
    public function getRealm(): string
    {
        return $this->realm;
    }
}