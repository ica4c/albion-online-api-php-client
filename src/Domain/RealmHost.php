<?php

declare(strict_types=1);

namespace Albion\API\Domain;

use Albion\API\Infrastructure\GameInfo\Exceptions\UnknownRealmProvidedException;

enum RealmHost: string
{
    case AMERICA = 'https://gameinfo.albiononline.com';
    case ASIA = 'https://gameinfo-sgp.albiononline.com';
    case EUROPE = 'https://gameinfo-ams.albiononline.com';

    public static function ofRealm(Realm $realm): self
    {
        return match ($realm) {
            Realm::AMERICA, Realm::WEST => self::AMERICA,
            Realm::ASIA, Realm::EAST => self::ASIA,
            Realm::EUROPE => self::EUROPE,
            default => throw new UnknownRealmProvidedException($realm)
        };
    }
}
