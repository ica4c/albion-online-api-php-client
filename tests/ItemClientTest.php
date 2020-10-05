<?php

namespace Tests;

use Albion\API\Domain\ItemQuality;
use Albion\API\Infrastructure\GameInfo\EventClient;
use Albion\API\Infrastructure\GameInfo\GuildClient;
use Albion\API\Infrastructure\GameInfo\ItemClient;
use finfo;

class ItemClientTest extends GuzzleTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\ItemClient */
    protected $itemClient;
    /** @var \Albion\API\Infrastructure\GameInfo\EventClient */
    protected $eventClient;
    /** @var \Albion\API\Infrastructure\GameInfo\GuildClient */
    protected $guildClient;

    public function __construct()
    {
        parent::__construct('Item client');
        $this->itemClient = new ItemClient();
        $this->eventClient = new EventClient();
        $this->guildClient = new GuildClient();
    }

    protected function firstGuild(string $q): array {
        $guilds = $this->awaitPromise(
            $this->guildClient->searchGuild($q)
        );

        $this->assertNotEmpty($guilds);
        return $guilds[0];
    }

    /**
     * @param string $guildName
     *
     * @return mixed
     * @throws \Exception
     */
    protected function randomKillGear($guildName) {
        $guild = $this->firstGuild($guildName);
        $events = $this->awaitPromise(
            $this->eventClient->getEvents(1, 0, $guild['Id'])
        );

        $event = $events[random_int(0, count($events)-1)];
        $equipment = $event['Killer']['Equipment'];

        return $equipment[array_rand($equipment)];
    }

    /**
     * @throws \Exception
     */
    public function testRandomEventKillItemIcon(): void {
        $gear = $this->randomKillGear('Elevate');

        $image = $this->awaitPromise(
            $this->itemClient->getItemIcon($gear['Type'], ItemQuality::of($gear['Quality']))
        );

        $fIH = new finfo(FILEINFO_MIME);
        $this->assertSame($fIH->buffer($image), 'image/png; charset=binary');
    }

    public function testRandomEventKillItemData(): void {
        $gear = $this->randomKillGear('Elevate');

        $data = $this->awaitPromise(
            $this->itemClient->getItemData($gear['Type'])
        );

        $this->assertNotNull($data);
        $this->assertNotEmpty($data);
    }

    public function testWeaponCategories(): void {
        $data = $this->awaitPromise(
            $this->itemClient->getWeaponCategories()
        );

        $this->assertNotNull($data);
        $this->assertNotEmpty($data);
    }

    public function testItemCategories(): void {
        $data = $this->awaitPromise(
            $this->itemClient->getItemCategories()
        );

        $this->assertNotNull($data);
        $this->assertNotEmpty($data);
    }
}
