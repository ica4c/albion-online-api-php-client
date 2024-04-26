<?php

declare(strict_types=1);

namespace Tests;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\CGVGClient;
use Albion\API\Infrastructure\GameInfo\Resolvers\RealmEndpointResolver;

class CGVGClientTest extends MockedClientTestCase
{
    protected CGVGClient $matchesClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->matchesClient = new CGVGClient(
            $this->mockClient($this->loadResponseSamplesFromSamplesJson('cgvg_200_responses.json')),
            new RealmEndpointResolver()
        );
    }


    protected function getRandomCGVGMatch() {
        $matches = $this->matchesClient->getCGVGMatches(Realm::AMERICA)
            ->wait();

        static::assertNotNull($matches);
        static::assertNotEmpty($matches);

        return !empty($matches) ? $matches[array_rand($matches)] : null;
    }

    protected function getRandomGuildMatch() {
        $matches = $this->matchesClient->getFeaturedGuildMatches(Realm::AMERICA)
            ->wait();

        static::assertNotNull($matches);

        return !empty($matches) ? $matches[array_rand($matches)] : null;
    }

    public function testCGVGMatches(): void {
        $this->getRandomCGVGMatch();
    }


    public function testFeaturedGuildMatches(): void
    {
        $matches = $this->matchesClient->getFeaturedGuildMatches(Realm::AMERICA)
            ->wait();

        static::assertNotNull($matches);
    }

    public function testNextGuildMatches(): void
    {
        $matches = $this->matchesClient->getUpcomingGuildMatches(Realm::AMERICA, 1, 0)
            ->wait();

        static::assertNotNull($matches);
    }

    public function testPastGuildMatches(): void
    {
        $matches = $this->matchesClient->getPastGuildMatches(Realm::AMERICA, 1, 0)
            ->wait();

        static::assertNotNull($matches);
    }
}
