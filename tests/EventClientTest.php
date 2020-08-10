<?php

namespace Tests;

use Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient;
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;
use PHPUnit\Framework\TestCase;

class EventClientTest extends GuzzleTestCase
{
    /** @var \Albion\OnlineDataProject\Infrastructure\GameInfo\EventClient */
    protected $eventClient;
    /** @var \Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient */
    protected $guildClient;

    /**
     * EventClientTest constructor.
     */
    public function __construct()
    {
        parent::__construct('Event list');
        $this->eventClient = new EventClient;
        $this->guildClient = new GuildClient;
    }

    public function testLatestRandomGuildEvents(): void
    {
        $guilds = $this->awaitPromise(
            $this->guildClient->searchGuild('W0rld Eaters')
        );

        $this->assertNotEmpty($guilds);

        $firstOne = $guilds[0];
        $events = $this->awaitPromise(
            $this->eventClient->getEvents(10, 0, $firstOne['Id'])
        );

        $this->assertNotNull($events);
        $this->assertNotEmpty($events);
    }
}