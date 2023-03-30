<?php

namespace Tests;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\AllianceClient;
use Albion\API\Infrastructure\GameInfo\BattleClient;
use Albion\API\Infrastructure\GameInfo\Builders\ClientBuilder;
use Albion\API\Infrastructure\GameInfo\CGVGClient;
use Albion\API\Infrastructure\GameInfo\EventClient;
use Albion\API\Infrastructure\GameInfo\GuildClient;
use Albion\API\Infrastructure\GameInfo\ItemDataClient;
use Albion\API\Infrastructure\GameInfo\PlayerClient;
use PHPUnit\Framework\TestCase;

class ClientBuilderTest extends TestCase
{
    /**
     * @return void
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\UnknownRealmProvidedException
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function testReturnedClients()
    {
        $builder = new ClientBuilder(Realm::of(Realm::EAST));

        static::assertInstanceOf(AllianceClient::class, $builder->alliances());
        static::assertInstanceOf(BattleClient::class, $builder->battles());
        static::assertInstanceOf(CGVGClient::class, $builder->cgvg());
        static::assertInstanceOf(EventClient::class, $builder->events());
        static::assertInstanceOf(GuildClient::class, $builder->guilds());
        static::assertInstanceOf(ItemDataClient::class, $builder->items());
        static::assertInstanceOf(PlayerClient::class, $builder->players());
    }
}