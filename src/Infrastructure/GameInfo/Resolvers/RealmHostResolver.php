<?php

namespace Albion\API\Infrastructure\GameInfo\Resolvers;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\Enums\RealmHost;
use Albion\API\Infrastructure\GameInfo\Exceptions\UnknownRealmProvidedException;

class RealmHostResolver
{
    /**
     * @param Realm $realm
     * @return RealmHost
     * @throws UnknownRealmProvidedException
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function resolveByRealm(Realm $realm): RealmHost
    {
        if (array_key_exists($realm->toString(), RealmHost::options())) {
            return RealmHost::of($realm->toString());
        }

        throw new UnknownRealmProvidedException($realm);
    }
}