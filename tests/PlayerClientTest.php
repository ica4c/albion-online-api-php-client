<?php

declare(strict_types=1);

namespace Tests;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\PlayerClient;
use Albion\API\Infrastructure\GameInfo\Resolvers\RealmEndpointResolver;

class PlayerClientTest extends MockedClientTestCase
{
    protected PlayerClient $playerClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->playerClient = new PlayerClient(
            $this->mockClient($this->loadResponseSamplesFromSamplesJson('players_200_responses.json')),
            new RealmEndpointResolver()
        );
    }

    public function testPlayerSearch(): void {
        $players = $this->playerClient->searchPlayer(Realm::AMERICA, 'test')
            ->wait();

        $this->assertNotEmpty($players);
    }

    public function testGetPlayerInfo(): void {
        $info = $this->playerClient->getPlayerInfo(Realm::AMERICA, '123')
            ->wait();

        static::assertNotEmpty($info);
    }

    public function testGetPlayerKills(): void {
        $kills = $this->playerClient->getPlayerKills(Realm::AMERICA, '123')
            ->wait();

        static::assertNotNull($kills);
    }

    public function testGetPlayerDeaths(): void {
        $deaths = $this->playerClient->getPlayerDeaths(Realm::AMERICA, '123')
            ->wait();

        static::assertNotNull($deaths);
    }
}