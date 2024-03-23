<?php

namespace Tests;

use Albion\API\Domain\Range;
use Albion\API\Infrastructure\GameInfo\Enums\RealmHost;
use Albion\API\Infrastructure\GameInfo\PlayerClient;
use Albion\API\Domain\PlayerStatType;
use Albion\API\Domain\RegionType;
use Mockery\Mock;

class PlayerClientTest extends EventFeedBasedTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\PlayerClient */
    protected $playerClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->playerClient = new PlayerClient(RealmHost::of(RealmHost::WEST));
    }

    public function testPlayerSearch(): void {
        $event = $this->fetchRandomLatestEvent();
        $players = $this->playerClient->searchPlayer($event['Killer']['Name'])
            ->wait();

        $this->assertNotEmpty($players);

        $player = $players[0];
        $this->assertEquals($player['Id'], $event['Killer']['Id']);
    }

    public function testGetPlayerInfo(): void {
        $event = $this->fetchRandomLatestEvent();

        $info = $this->playerClient->getPlayerInfo($event['Killer']['Id'])
            ->wait();

        static::assertNotEmpty($info);
    }

    public function testGetPlayerKills(): void {
        $event = $this->fetchRandomLatestEvent();

        $deaths = $this->playerClient->getPlayerKills($event['Killer']['Id'])
            ->wait();

        static::assertNotNull($deaths);
    }

    public function testGetPlayerDeaths(): void {
        $event = $this->fetchRandomLatestEvent();

        $deaths = $this->playerClient->getPlayerDeaths($event['Victim']['Id'])
            ->wait();

        static::assertNotNull($deaths);
    }
}