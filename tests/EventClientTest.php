<?php

declare(strict_types=1);

namespace Tests;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\EventClient;
use Albion\API\Infrastructure\GameInfo\Resolvers\RealmEndpointResolver;

class EventClientTest extends MockedClientTestCase
{
    protected EventClient $eventClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eventClient = new EventClient(
            $this->mockClient($this->loadResponseSamplesFromSamplesJson('events_200_responses.json')),
            new RealmEndpointResolver()
        );
    }

    public function testEvents(): void
    {
        $events = $this->eventClient->getEvents(Realm::AMERICA)
            ->wait();

        static::assertNotNull($events);
        static::assertNotEmpty($events);
    }
}