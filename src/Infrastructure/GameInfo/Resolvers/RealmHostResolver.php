<?php

namespace Albion\API\Infrastructure\GameInfo\Resolvers;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\Enums\RealmHost;
use Albion\API\Infrastructure\GameInfo\Exceptions\UnknownRealmProvidedException;

class RealmHostResolver
{
    protected const REALM_HOST_MAP = [
        Realm::EAST => RealmHost::EAST,
        Realm::WEST => RealmHost::WEST
    ];

    /**
     * @param Realm $realm
     * @return RealmHost
     * @throws UnknownRealmProvidedException
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function resolveByRealm(Realm $realm): RealmHost
    {
        if (array_key_exists($realm->toString(), static::REALM_HOST_MAP)) {
            return RealmHost::of(static::REALM_HOST_MAP[$realm->toString()]);
        }

        throw new UnknownRealmProvidedException($realm);
    }
}