<?php

namespace Tests;

use Albion\API\Infrastructure\GameInfo\EventClient;
use Closure;
use GuzzleHttp\Promise\PromiseInterface;
use InvalidArgumentException;
use Mockery;
use PHPUnit\Framework\Constraint\Callback;
use PHPUnit\Framework\TestCase;
use function GuzzleHttp\Promise\queue;

abstract class EventFeedBasedTestCase extends TestCase
{
    /** @var EventClient */
    protected $client;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new EventClient;
    }


    /**
     * @param PromiseInterface $promise
     * @return mixed
     */
    protected function awaitPromise(PromiseInterface $promise) {
        $value = $promise->wait();
        queue();

        return $value;
    }

    /**
     * @return array
     */
    protected function fetchLatestEvents(): array
    {
        $events = $this->awaitPromise($this->client->getEvents());
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