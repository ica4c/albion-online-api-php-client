<?php

namespace Tests;

use Albion\OnlineDataProject\Domain\Range;
use Albion\OnlineDataProject\Infrastructure\GameInfo\PlayerClient;
use Albion\OnlineDataProject\Domain\PlayerStatType;
use Albion\OnlineDataProject\Domain\RegionType;
use Mockery\Mock;

class PlayerClientTest extends GuzzleTestCase
{
    /** @var \Albion\OnlineDataProject\Infrastructure\GameInfo\PlayerClient */
    protected $playerClient;

    /**
     * PlayerClientTest constructor.
     */
    public function __construct()
    {
        parent::__construct('Player client');
        $this->playerClient = new PlayerClient();
    }

    /**
     * Return first player search result
     * @param string $q
     *
     * @return array
     */
    protected function getFirstPlayer(string $q): array {
        $players = $this->awaitPromise(
            $this->playerClient->searchPlayer($q)
        );

        $this->assertNotEmpty($players);

        return $players[0];
    }

    public function testPlayerSearch(): void {
        // Already has all assertions
        $this->getFirstPlayer('man');
    }

    public function testGetPlayerInfo(): void {
        $firstOne = $this->getFirstPlayer('man');

        $player = $this->awaitPromise(
            $this->playerClient->getPlayerInfo($firstOne['Id'])
        );

        $this->assertNotEmpty($player);
    }

    public function testGetPlayerDeaths(): void {
        $firstOne = $this->getFirstPlayer('man');
        $deaths = $this->awaitPromise(
            $this->playerClient->getPlayerDeaths($firstOne['Id'])
        );
        $this->assertNotNull($deaths);
    }

    public function testGetPlayerStats(): void {
        $stats = $this->awaitPromise(
            $this->playerClient->getPlayerStatistics(
                Range::of(Range::WEEK),
                1,
                0
            )
        );

        $this->assertNotNull($stats);
        $this->assertNotEmpty($stats);
    }
}