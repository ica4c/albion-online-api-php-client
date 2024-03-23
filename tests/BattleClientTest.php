<?php

namespace Tests;

use Albion\API\Domain\BattleSortType;
use Albion\API\Domain\Range;
use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\BattleClient;
use Albion\API\Infrastructure\GameInfo\Builders\ClientBuilder;
use Albion\API\Infrastructure\GameInfo\Enums\RealmHost;

class BattleClientTest extends EventFeedBasedTestCase
{
    /** @var ClientBuilder $client */
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->battleClient = new BattleClient(RealmHost::of(RealmHost::WEST));
    }


    public function testMostFameAcquiredBattles(): void {
        $battles = $this->battleClient->getBattles(
            Range::of(Range::DAY),
            1,
            0,
            BattleSortType::of(BattleSortType::TOTAL_FAME)
        )
            ->wait();

        static::assertNotNull($battles);
        static::assertNotEmpty($battles);
    }
}