<?php

namespace Tests;

use Albion\API\Domain\BattleSortType;
use Albion\API\Domain\Range;
use Albion\API\Infrastructure\GameInfo\BattleClient;

class BattleClientTest extends GuzzleTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\BattleClient */
    private $battleClient;

    public function __construct()
    {
        parent::__construct('Battle client');
        $this->battleClient = new BattleClient();
    }

    public function testMostFameAcquiredBattles(): void {
        $battles = $this->battleClient->getBattles(
            Range::of(Range::DAY),
            1,
            0,
            BattleSortType::of(BattleSortType::TOTAL_FAME)
        );

        static::assertNotNull($battles);
        static::assertNotEmpty($battles);
    }
}