<?php

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class CGVGClient extends AbstractClient
{
    /**
     * Get upcoming CGVG matches
     *
     * @param int $limit
     * @param int $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getCGVGMatches(int $limit = 10, int $offset = 0): PromiseInterface {
        $query = [
            'limit' => max(1, min($limit, 9999)),
            'offset' => max(1, min($offset, 9999)),
        ];

        return $this->httpClient->getAsync('matches/crystal', ['query' => $query])
            ->otherwise(
                static function (RequestException $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode($response->getBody()->getContents(), true);
                }
            );
    }

    /**
     * Get CGVG match by its id
     * @param string $id
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getCGVGMatchById(string $id): PromiseInterface {
        return $this->httpClient->getAsync("matches/crystal/$id")
            ->otherwise(
                static function (RequestException $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode($response->getBody()->getContents(), true);
                }
            );
    }

    /**
     * Get featured upcoming guildmatches
     * Not sure what it actually does
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getFeaturedGuildMatches(): PromiseInterface {
        return $this->httpClient->getAsync('guildmatches/top')
            ->otherwise(
                static function (RequestException $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode($response->getBody()->getContents(), true);
                }
            );
    }

    /**
     * Get all upcoming guild matches
     * @param int $limit
     * @param int $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getUpcomingGuildMatches(int $limit = 10, int $offset = 0): PromiseInterface {
        $query = [
            'limit' => max(1, min($limit, 50)),
            'offset' => max(1, min($offset, 9999)),
        ];

        return $this->httpClient->getAsync('guildmatches/next', ['query' => $query])
            ->otherwise(
                static function (RequestException $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode($response->getBody()->getContents(), true);
                }
            );
    }

    /**
     * Get all past guild matches
     *
     * @param int         $limit
     * @param int         $offset
     * @param string|null $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPastGuildMatches(int $limit = 10, int $offset = 0, string $guildId = null): PromiseInterface {
        $query = [
            'limit' => max(1, min($limit, 50)),
            'offset' => max(1, min($offset, 9999)),
        ];

        if($guildId !== null) {
            $query['guildId'] = $guildId;
        }

        return $this->httpClient->getAsync('guildmatches/past', ['query' => $query])
            ->otherwise(
                static function (RequestException $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode($response->getBody()->getContents(), true);
                }
            );
    }

    /**
     * Get guild match by its id
     * @param string $id
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGuildMatchById(string $id): PromiseInterface {
        return $this->httpClient->getAsync("guildmatches/$id")
            ->otherwise(
                static function (RequestException $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode($response->getBody()->getContents(), true);
                }
            );
    }
}