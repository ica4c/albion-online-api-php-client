<?php

namespace Tests;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\Builders\ClientBuilder;
use Albion\API\Infrastructure\GameInfo\CGVGClient;
use Albion\API\Infrastructure\GameInfo\Enums\RealmHost;

class CGVGClientTest extends EventFeedBasedTestCase
{
    /** @var ClientBuilder */
    protected $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->matchesClient = new CGVGClient(RealmHost::of(RealmHost::WEST));
    }


    protected function getRandomCGVGMatch() {
        $matches = $this->matchesClient->getCGVGMatches()
            ->wait();

        static::assertNotNull($matches);
        static::assertNotEmpty($matches);

        return !empty($matches) ? $matches[array_rand($matches)] : null;
    }

    protected function getRandomGuildMatch() {
        $matches = $this->matchesClient->getFeaturedGuildMatches()
            ->wait();

        static::assertNotNull($matches);

        return !empty($matches) ? $matches[array_rand($matches)] : null;
    }

    public function testCGVGMatches(): void {
        $this->getRandomCGVGMatch();
    }

    public function testGetCGVGMatch(): void {
        $match = $this->getRandomCGVGMatch();

        if($match) {
            $test = $this->matchesClient->getCGVGMatchById($match['MatchId'])
                ->wait();

            static::assertNotNull($test);
            static::assertNotEmpty($test);
            static::assertSame($test['MatchId'], $match['MatchId']);
        }
    }


    public function testFeaturedGuildMatches(): void
    {
        $matches = $this->matchesClient->getFeaturedGuildMatches()
            ->wait();

        static::assertNotNull($matches);
    }

    public function testNextGuildMatches(): void
    {
        $matches = $this->matchesClient->getUpcomingGuildMatches(1, 0)
            ->wait();

        static::assertNotNull($matches);
    }

    public function testPastGuildMatches(): void
    {
        $matches = $this->matchesClient->getPastGuildMatches(1, 0)
            ->wait();

        static::assertNotNull($matches);
    }

    public function testGetGuildMatchById(): void
    {
        $rnd = $this->getRandomGuildMatch();

        if($rnd) {
            $match = $this->matchesClient->getGuildMatchById($rnd['MatchId'])
                ->wait();

            static::assertNotNull($match);
            static::assertNotEmpty($match);
            static::assertSame($rnd['MatchId'], $match['MatchId']);
        }
    }
}