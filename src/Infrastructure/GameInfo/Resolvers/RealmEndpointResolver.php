<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo\Resolvers;

use Albion\API\Domain\Realm;
use Albion\API\Domain\RealmHost;

class RealmEndpointResolver
{
    /**
     * @param Realm $realm
     *
     * @return RealmHost
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\UnknownRealmProvidedException
     */
    public function resolveHostByRealm(Realm $realm): RealmHost
    {
        return RealmHost::ofRealm($realm);
    }

    public function gameinfoApiEndpoint(Realm $realm, string $endpoint): string
    {
        return sprintf(
            "%s/api/gameinfo/%s",
            $this->resolveHostByRealm($realm)->value,
            $endpoint
        );
    }
}
