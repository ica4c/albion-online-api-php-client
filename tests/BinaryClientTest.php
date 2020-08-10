<?php

namespace Tests;

use Albion\OnlineDataProject\Infrastructure\Binaries\BinaryClient;
use PHPUnit\Framework\TestCase;

class BinaryClientTest extends TestCase
{
    /** @var \Albion\OnlineDataProject\Infrastructure\Binaries\BinaryClient */
    protected $client;

    /**
     * BinaryClientTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new BinaryClient();
    }

    /**
     * @inheritDoc
     * @throws \Albion\OnlineDataProject\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
     */
//    public function testFetchLocalization() {
//        $localization = $this->client->fetchLocalization();
//
//        $this->assertArrayHasKey('EN-US', $localization);
//        $this->assertArrayHasKey('@ACCESS_RIGHTS_ACCESS_MODE', $localization['EN-US']);
//    }

    /**
     * @inheritDoc
     * @throws \Albion\OnlineDataProject\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
     */
//    public function testFetchItems() {
//        $items = $this->client->fetchItems();
//
//        $this->assertIsArray($items);
//        $this->assertNotEmpty($items);
//    }
}