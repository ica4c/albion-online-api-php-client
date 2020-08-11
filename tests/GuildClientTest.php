<?php

namespace Tests;

use Albion\OnlineDataProject\Domain\Range;
use Albion\OnlineDataProject\Domain\RegionType;
use Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient;

class GuildClientTest extends GuzzleTestCase
{
    /** @var \Albion\OnlineDataProject\Infrastructure\GameInfo\GuildClient */
    protected $guildClient;

    /**
     * PlayerClientTest constructor.
     */
    public function __construct()
    {
        parent::__construct('Guild client');
        $this->guildClient = new GuildClient();
    }

    /**
     * Return first guild search result
     * @param string $q
     * @return array
     */
    protected function getFirst(string $q): array
    {
        $guilds = $this->awaitPromise(
            $this->guildClient->searchGuild($q)
        );

        $this->assertNotEmpty($guilds);
        return $guilds[0];
    }

    public function testGuildSearch(): void
    {
        $this->getFirst('man');
    }

    public function testGetGuildInfo(): void
    {
        $firstOne = $this->getFirst('Elevate');

        $guild = $this->awaitPromise(
            $this->guildClient->getGuildInfo($firstOne['Id'])
        );

        $this->assertNotNull($guild);
        $this->assertNotEmpty($guild);
        $this->assertSame($guild['Id'], $firstOne['Id']);
    }

    public function testGetGuildMembers(): void
    {
        $firstOne = $this->getFirst('Elevate');

        $members = $this->awaitPromise(
            $this->guildClient->getGuildMembers($firstOne['Id'])
        );

        $this->assertNotNull($members);
        $this->assertNotEmpty($members);
    }

    public function testGetGuildData(): void
    {
        $firstOne = $this->getFirst('Elevate');

        $data = $this->awaitPromise(
            $this->guildClient->getGuildData($firstOne['Id'])
        );

        $this->assertNotNull($data);
        $this->assertNotEmpty($data);
        $this->assertSame($data['guild']['Id'], $firstOne['Id']);
    }

    public function testGetGuildTopMembers(): void
    {
        $firstOne = $this->getFirst('Elevate');

        $kills = $this->awaitPromise(
            $this->guildClient->getGuildTopMembers(
                $firstOne['Id'],
                Range::of(Range::MONTH),
                5,
                0,
                RegionType::of(RegionType::HELLGATE)
            )
        );

        $this->assertNotEmpty($kills);
        $this->assertNotNull($kills);
    }

    public function testGetGuildTopByAttacks(): void
    {
        $guilds = $this->awaitPromise(
            $this->guildClient->getGuildTopByAttacks(
                Range::of(Range::WEEK),
                5,
                0
            )
        );

        $this->assertNotNull($guilds);
        $this->assertNotEmpty($guilds);
    }

    public function testGetGuildTopByDefences(): void
    {
        $guilds = $this->awaitPromise(
            $this->guildClient->getGuildTopByDefences(
                Range::of(Range::WEEK),
                5,
                0
            )
        );

        $this->assertNotNull($guilds);
        $this->assertNotEmpty($guilds);
    }
}
