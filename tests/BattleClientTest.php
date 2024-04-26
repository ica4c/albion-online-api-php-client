<?php

declare(strict_types=1);

namespace Tests;

use Albion\API\Domain\BattleSortType;
use Albion\API\Domain\Range;
use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\BattleClient;
use Albion\API\Infrastructure\GameInfo\Resolvers\RealmEndpointResolver;

class BattleClientTest extends MockedClientTestCase
{
    protected BattleClient $battleClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->battleClient = new BattleClient(
            $this->mockClient($this->loadResponseSamplesFromSamplesJson('battles_200_responses.json')),
            new RealmEndpointResolver()
        );
    }

    public function testMostFameAcquiredBattles(): void {
        $battles = $this->battleClient->getBattles(
            Realm::AMERICA,
            Range::DAY,
            1,
            0,
            BattleSortType::TOTAL_FAME
        )
            ->wait();

        static::assertNotNull($battles);
        static::assertNotEmpty($battles);
    }
}