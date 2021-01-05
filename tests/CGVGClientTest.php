<?php

namespace Tests;

use Albion\API\Infrastructure\GameInfo\CGVGClient;

class CGVGClientTest extends GuzzleTestCase
{
    /** @var \Albion\API\Infrastructure\GameInfo\CGVGClient */
    private $matchesClient;

    public function __construct()
    {
        parent::__construct('Guild matches client');
        $this->matchesClient = new CGVGClient();
    }

    protected function getRandomCGVGMatch() {
        $matches = $this->awaitPromise(
            $this->matchesClient->getCGVGMatches()
        );

        static::assertNotNull($matches);
        static::assertNotEmpty($matches);

        return !empty($matches) ? $matches[array_rand($matches)] : null;
    }

    protected function getRandomGuildMatch() {
        $matches = $this->awaitPromise(
            $this->matchesClient->getFeaturedGuildMatches()
        );

        static::assertNotNull($matches);

        return !empty($matches) ? $matches[array_rand($matches)] : null;
    }

    public function testCGVGMatches(): void {
        $this->getRandomCGVGMatch();
    }

    public function testGetCGVGMatch(): void {
        $match = $this->getRandomCGVGMatch();

        if($match) {
            $test = $this->awaitPromise(
                $this->matchesClient->getCGVGMatchById($match['MatchId'])
            );

            static::assertNotNull($test);
            static::assertNotEmpty($test);
            static::assertSame($test['MatchId'], $match['MatchId']);
        }
    }


    public function testFeaturedGuildMatches(): void
    {
        $matches = $this->awaitPromise(
            $this->matchesClient->getFeaturedGuildMatches()
        );

        static::assertNotNull($matches);
    }

    public function testNextGuildMatches(): void
    {
        $matches = $this->awaitPromise(
            $this->matchesClient->getUpcomingGuildMatches(1, 0)
        );

        static::assertNotNull($matches);
    }

    public function testPastGuildMatches(): void
    {
        $matches = $this->awaitPromise(
            $this->matchesClient->getPastGuildMatches(1, 0)
        );

        static::assertNotNull($matches);
    }

    public function testGetGuildMatchById(): void
    {
        $rnd = $this->getRandomGuildMatch();

        if($rnd) {
            $match = $this->awaitPromise(
                $this->matchesClient->getGuildMatchById($rnd['MatchId'])
            );

            static::assertNotNull($match);
            static::assertNotEmpty($match);
            static::assertSame($rnd['MatchId'], $match['MatchId']);
        }
    }
}