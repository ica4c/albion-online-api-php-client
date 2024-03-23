<?php

namespace Tests;

use Albion\API\Infrastructure\GameInfo\Enums\RealmHost;
use Albion\API\Infrastructure\GameInfo\EventClient;
use PHPUnit\Framework\TestCase;

abstract class EventFeedBasedTestCase extends TestCase
{
    /** @var EventClient */
    protected $client;

    /**
     * @return void
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new EventClient(RealmHost::of(RealmHost::WEST));
    }

    /**
     * @return array
     */
    protected function fetchLatestEvents(): array
    {
        $events = $this->client->getEvents()->wait();
        $this->assertNotEmpty($events);

        return $events;
    }

    /**
     * @return array
     */
    protected function fetchRandomLatestEvent(): array
    {
        $events = $this->fetchLatestEvents();
        $event = $events[array_rand($events)];

        $this->assertNotEmpty($event);
        return $event;
    }
}