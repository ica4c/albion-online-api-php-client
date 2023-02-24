<?php

namespace Tests;

use Albion\API\Infrastructure\GameInfo\AllianceClient;
use Albion\API\Infrastructure\GameInfo\Enums\RealmHost;
use Albion\API\Infrastructure\GameInfo\PlayerClient;

class AllianceClientTest extends EventFeedBasedTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\AllianceClient */
    protected $allianceClient;
    /** @var \Albion\API\Infrastructure\GameInfo\PlayerClient */
    protected $playerClient;


    protected function setUp(): void
    {
        parent::setUp();

        $this->playerClient = new PlayerClient(RealmHost::of(RealmHost::WEST));
        $this->allianceClient = new AllianceClient(RealmHost::of(RealmHost::WEST));
    }

    /**
     * Return first guild search result
     * @param string $q
     * @return array
     */
    protected function getFirstPlayer(string $q): array
    {
        $players = $this->awaitPromise(
            $this->playerClient->searchPlayer($q)
        );

        static::assertNotEmpty($players);
        return $players[0];
    }

    public function testGetAlliance(): void
    {
        $firstOne = $this->getFirstPlayer('Mamono');
        static::assertNotEmpty($firstOne['AllianceId']);

        $alliance = $this->awaitPromise($this->allianceClient->getAllianceInfo($firstOne['AllianceId']));

        static::assertNotNull($alliance);
        static::assertNotEmpty($alliance);
    }
}