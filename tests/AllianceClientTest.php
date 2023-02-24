<?php

namespace Tests;

use Albion\API\Infrastructure\GameInfo\AllianceClient;
use Albion\API\Infrastructure\GameInfo\Enums\RealmHost;
use Albion\API\Infrastructure\GameInfo\EventClient;
use Albion\API\Infrastructure\GameInfo\PlayerClient;

class AllianceClientTest extends EventFeedBasedTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\AllianceClient */
    protected $allianceClient;
    /** @var \Albion\API\Infrastructure\GameInfo\PlayerClient */
    protected $playerClient;
    /** @var EventClient */
    protected $eventClient;


    protected function setUp(): void
    {
        parent::setUp();

        $this->eventClient = new EventClient(RealmHost::of(RealmHost::WEST));
        $this->playerClient = new PlayerClient(RealmHost::of(RealmHost::WEST));
        $this->allianceClient = new AllianceClient(RealmHost::of(RealmHost::WEST));
    }

    /**
     * Return first event with alliance result
     * @return array
     */
    protected function getFirstPlayer(): array
    {
        $events = array_filter(
            $this->awaitPromise($this->eventClient->getEvents(50)),
            static function(array $event) {
                return !empty($event['Killer']['AllianceId']);
            }
        );

        if (empty($events)) {
            static::markTestSkipped('No alliances found at current feed window');
        }

        return $events[array_rand($events)]['Killer'];
    }

    /**
     * @return void
     */
    public function testGetAlliance(): void
    {
        $firstOne = $this->getFirstPlayer();

        static::assertNotEmpty($firstOne['AllianceId']);

        $alliance = $this->awaitPromise($this->allianceClient->getAllianceInfo($firstOne['AllianceId']));

        static::assertNotNull($alliance);
        static::assertNotEmpty($alliance);
    }
}