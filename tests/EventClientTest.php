<?php

namespace Tests;

use Albion\API\Domain\Range;
use Albion\API\Domain\WeaponClass;
use Albion\API\Infrastructure\GameInfo\Enums\RealmHost;
use Albion\API\Infrastructure\GameInfo\EventClient;
use Albion\API\Infrastructure\GameInfo\GuildClient;
use PHPUnit\Framework\TestCase;

class EventClientTest extends EventFeedBasedTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\GuildClient */
    protected $guildClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->guildClient = new GuildClient(RealmHost::of(RealmHost::WEST));
    }

    public function testLatestGuildEvents(): void
    {
        $events = $this->fetchLatestEvents();

        foreach ($events as $event) {
            if (empty($event['Killer']['GuildId'])) {
                $this->markTestSkipped('Not a guild member');
            }

            $events = $this->awaitPromise(
                $this->client->getEvents(10, 0, $event['Killer']['GuildId'])
            );

            static::assertNotNull($events);
            static::assertNotEmpty($events);
            static::assertCount(10, $events);
        }
    }

    public function testLatestTopByKillFame(): void
    {
        $events = $this->awaitPromise(
            $this->client->getTopEventsByKillFame(Range::of(Range::DAY), 1)
        );

        static::assertNotNull($events);
        static::assertNotEmpty($events);
    }
}