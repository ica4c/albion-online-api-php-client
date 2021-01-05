<?php

namespace Tests;

use Albion\API\Domain\Range;
use Albion\API\Infrastructure\GameInfo\PlayerClient;
use Albion\API\Domain\PlayerStatType;
use Albion\API\Domain\RegionType;
use Mockery\Mock;

class PlayerClientTest extends GuzzleTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\PlayerClient */
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

        static::assertNotEmpty($players);

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

        static::assertNotEmpty($player);
    }

    public function testGetPlayerDeaths(): void {
        $firstOne = $this->getFirstPlayer('man');
        $deaths = $this->awaitPromise(
            $this->playerClient->getPlayerDeaths($firstOne['Id'])
        );
        static::assertNotNull($deaths);
    }

    public function testGetPlayerStats(): void {
        $stats = $this->awaitPromise(
            $this->playerClient->getPlayerStatistics(
                Range::of(Range::WEEK),
                1,
                0
            )
        );

        static::assertNotNull($stats);
        static::assertNotEmpty($stats);
    }
}