<?php

namespace Tests;

use Albion\API\Domain\Range;
use Albion\API\Domain\RegionType;
use Albion\API\Infrastructure\GameInfo\GuildClient;

class GuildClientTest extends GuzzleTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\GuildClient */
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
     *
     * @param string $q
     * @return array
     */
    protected function getFirst(string $q): array
    {
        $guilds = $this->awaitPromise(
            $this->guildClient->searchGuild($q)
        );

        static::assertNotEmpty($guilds);
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

        static::assertNotNull($guild);
        static::assertNotEmpty($guild);
        static::assertSame($guild['Id'], $firstOne['Id']);
    }

    public function testGetGuildMembers(): void
    {
        $firstOne = $this->getFirst('Elevate');

        $members = $this->awaitPromise(
            $this->guildClient->getGuildMembers($firstOne['Id'])
        );

        static::assertNotNull($members);
        static::assertNotEmpty($members);
    }

    public function testGetGuildData(): void
    {
        $firstOne = $this->getFirst('Elevate');

        $data = $this->awaitPromise(
            $this->guildClient->getGuildData($firstOne['Id'])
        );

        static::assertNotNull($data);
        static::assertNotEmpty($data);
        static::assertSame($data['guild']['Id'], $firstOne['Id']);
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

        static::assertNotEmpty($kills);
        static::assertNotNull($kills);
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

        static::assertNotNull($guilds);
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

        static::assertNotNull($guilds);
    }
}
