<?php

declare(strict_types=1);

namespace Albion\API\Domain;

enum Realm: string
{
    /** @deprecated server renamed {@see static::AMERICA} */
    case WEST = 'west';
    /** @deprecated server renamed {@see static::ASIA} */
    case EAST = 'east';
    case AMERICA = 'america';
    case ASIA = 'asia';
    case EUROPE = 'europe';
}
