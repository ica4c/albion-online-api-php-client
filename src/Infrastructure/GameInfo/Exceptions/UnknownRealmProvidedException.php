<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo\Exceptions;

use Albion\API\Domain\Realm;
use Exception;

class UnknownRealmProvidedException extends Exception
{
    public function __construct(protected Realm $realm)
    {
        parent::__construct("Unknown realm. See Realm::class for available options.");
    }

    public function getRealm(): Realm
    {
        return $this->realm;
    }
}
