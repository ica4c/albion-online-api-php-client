<?php

declare(strict_types=1);

namespace Tests;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\AllianceClient;
use Albion\API\Infrastructure\GameInfo\Resolvers\RealmEndpointResolver;

class AllianceClientTest extends MockedClientTestCase
{
    protected AllianceClient $allianceClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->allianceClient = new AllianceClient(
            $this->mockClient($this->loadResponseSamplesFromSamplesJson('alliance_200_responses.json')),
            new RealmEndpointResolver()
        );
    }

    public function testGetAlliance(): void
    {
        $alliance = $this->allianceClient->getAllianceInfo(Realm::WEST, 'test-id')
            ->wait();

        static::assertNotNull($alliance);
        static::assertNotEmpty($alliance);
    }
}