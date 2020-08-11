<?php

namespace Tests;

use Albion\OnlineDataProject\Domain\BattleSortType;
use Albion\OnlineDataProject\Domain\Range;
use Albion\OnlineDataProject\Infrastructure\GameInfo\BattleClient;

class BattleClientTest extends GuzzleTestCase
{
    /** @var \Albion\OnlineDataProject\Infrastructure\GameInfo\BattleClient */
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

        $this->assertNotNull($battles);
        $this->assertNotEmpty($battles);
    }
}