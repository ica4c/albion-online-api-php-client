<?php

namespace Tests;

use Albion\API\Domain\Range;
use Albion\API\Domain\WeaponClass;
use Albion\API\Infrastructure\GameInfo\EventClient;
use Albion\API\Infrastructure\GameInfo\GuildClient;
use PHPUnit\Framework\TestCase;

class EventClientTest extends GuzzleTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\EventClient */
    protected $eventClient;
    /** @var \Albion\API\Infrastructure\GameInfo\GuildClient */
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

    public function testLatestGuildEvents(): void
    {
        $guilds = $this->awaitPromise(
            $this->guildClient->searchGuild('Elevate')
        );

        static::assertNotEmpty($guilds);

        $firstOne = $guilds[0];
        $events = $this->awaitPromise(
            $this->eventClient->getEvents(10, 0, $firstOne['Id'])
        );

        static::assertNotNull($events);
        static::assertNotEmpty($events);
    }

    public function testLatestTopByGuild(): void
    {
        $events = $this->awaitPromise(
            $this->eventClient->getTopEventsByGuildFame(Range::of(Range::DAY), 1)
        );

        static::assertNotNull($events);
        static::assertNotEmpty($events);
    }

    public function testLatestTopByKillFame(): void
    {
        $events = $this->awaitPromise(
            $this->eventClient->getTopEventsByKillFame(Range::of(Range::DAY), 1)
        );

        static::assertNotNull($events);
        static::assertNotEmpty($events);
    }

    public function testLatestTopByPlayerFame(): void
    {
        $events = $this->awaitPromise(
            $this->eventClient->getTopEventsByPlayerFame(Range::of(Range::DAY), 1)
        );

        static::assertNotNull($events);
        static::assertNotEmpty($events);
    }

    public function testLatestTopByPlayerWeaponFame(): void
    {
        $events = $this->awaitPromise(
            $this->eventClient->getTopEventsByPlayerWeaponFame(
                Range::of(Range::DAY),
                WeaponClass::of(WeaponClass::DAGGER)
            )
        );

        static::assertNotNull($events);
        static::assertNotEmpty($events);
    }
}