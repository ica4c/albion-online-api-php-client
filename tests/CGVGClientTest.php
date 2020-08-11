<?php

namespace Tests;

use Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient;

class CGVGClientTest extends GuzzleTestCase
{
    /** @var \Albion\OnlineDataProject\Infrastructure\GameInfo\CGVGClient */
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

        $this->assertNotNull($matches);
        $this->assertNotEmpty($matches);

        return !empty($matches) ? $matches[array_rand($matches)] : null;
    }

    protected function getRandomGuildMatch() {
        $matches = $this->awaitPromise(
            $this->matchesClient->getFeaturedGuildMatches()
        );

        $this->assertNotNull($matches);

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

            $this->assertNotNull($test);
            $this->assertNotEmpty($test);
            $this->assertSame($test['MatchId'], $match['MatchId']);
        }
    }


    public function testFeaturedGuildMatches(): void
    {
        $matches = $this->awaitPromise(
            $this->matchesClient->getFeaturedGuildMatches()
        );

        $this->assertNotNull($matches);
    }

    public function testNextGuildMatches(): void
    {
        $matches = $this->awaitPromise(
            $this->matchesClient->getUpcomingGuildMatches(1, 0)
        );

        $this->assertNotNull($matches);
    }

    public function testPastGuildMatches(): void
    {
        $matches = $this->awaitPromise(
            $this->matchesClient->getPastGuildMatches(1, 0)
        );

        $this->assertNotNull($matches);
    }

    public function testGetGuildMatchById(): void
    {
        $rnd = $this->getRandomGuildMatch();

        if($rnd) {
            $match = $this->awaitPromise(
                $this->matchesClient->getGuildMatchById($rnd['MatchId'])
            );

            $this->assertNotNull($match);
            $this->assertNotEmpty($match);
            $this->assertSame($rnd['MatchId'], $match['MatchId']);
        }
    }
}