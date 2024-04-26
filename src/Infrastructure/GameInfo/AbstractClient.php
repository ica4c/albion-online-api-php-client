<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Infrastructure\GameInfo\Resolvers\RealmEndpointResolver;
use Psr\Http\Client\ClientInterface;

abstract class AbstractClient
{
    public function __construct(
        protected ClientInterface $http,
        protected RealmEndpointResolver $resolver
    ) {
    }
}
