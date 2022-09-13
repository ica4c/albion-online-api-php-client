<?php

namespace Tests;

use Albion\API\Domain\BattleSortType;
use Albion\API\Domain\Range;
use Albion\API\Infrastructure\GameInfo\BattleClient;

class BattleClientTest extends EventFeedBasedTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\BattleClient */
    private $battleClient;

    protected function setUp(): void
    {
        parent::setUp();

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