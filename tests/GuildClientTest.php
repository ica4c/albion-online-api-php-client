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
        $firstOne = $this->getFirst('man');

        $guild = $this->awaitPromise(
            $this->guildClient->getGuildInfo($firstOne['Id'])
        );

        $this->assertNotEmpty($guild);
    }

    public function testGetGuildMembers(): void
    {
        $firstOne = $this->getFirst('man');

        $guild = $this->awaitPromise(
            $this->guildClient->getGuildMembers($firstOne['Id'])
        );

        $this->assertNotNull($guild);
    }

    public function testGetGuildData(): void
    {
        $firstOne = $this->getFirst('man');

        $data = $this->awaitPromise(
            $this->guildClient->getGuildData($firstOne['Id'])
        );

        $this->assertNotNull($data);
    }

    public function testGetGuildTop(): void
    {
        $firstOne = $this->getFirst('man');

        $kills = $this->awaitPromise(
            $this->guildClient->getGuildTop(
                $firstOne['Id'],
                Range::of(Range::MONTH),
                5,
                0,
                RegionType::of(RegionType::HELLGATE)
            )
        );

        $this->assertNotNull($kills);
    }
}
