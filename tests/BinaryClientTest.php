<?php

namespace Tests;

use Albion\API\Infrastructure\Binaries\BinaryClient;

class BinaryClientTest extends GuzzleTestCase
{
    /** @var BinaryClient */
    protected $binaryClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->binaryClient = new BinaryClient;
    }


    public function testItems()
    {
        $items = $this->binaryClient->getItems();

        self::assertNotEmpty($items);
        self::assertIsArray($items);
    }

    public function testLocalization()
    {
        $strings = $this->binaryClient->getLocalization();

        self::assertNotEmpty($strings);
        self::assertIsArray($strings);
    }
}