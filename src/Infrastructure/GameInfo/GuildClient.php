<?php

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\Range;
use Albion\API\Domain\RegionType;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use Albion\API\Infrastructure\GameInfo\Exceptions\GuildNotFoundException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class GuildClient extends AbstractClient
{
    /**
     * Get basic guild information
     *
     * @param string $guildId
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     */
    public function getGuildInfo(string $guildId): PromiseInterface {
        return $this->httpClient->getAsync("guilds/$guildId")
            ->otherwise(
                static function (RequestException $exception) use ($guildId) {
                    if($exception->getCode() === 404) {
                        throw new GuildNotFoundException($guildId);
                    }

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
     * Get detailed guild information
     *
     * @param string $guildId
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGuildData(string $guildId): PromiseInterface {
        return $this->httpClient->getAsync("guilds/$guildId/data")
            ->otherwise(
                static function (RequestException $exception) use ($guildId) {
                    if($exception->getCode() === 404) {
                        throw new GuildNotFoundException($guildId);
                    }

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
     * Get guild top member list
     *
     * @param string                                           $guildId
     * @param \Albion\API\Domain\Range|null      $range
     * @param int                                              $limit
     * @param int                                              $offset
     * @param \Albion\API\Domain\RegionType|null $region
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGuildTopMembers(string $guildId,
                                       Range $range = null,
                                       int $limit = 10,
                                       int $offset = 0,
                                       RegionType $region = null): PromiseInterface {
        $query = [
            'range' => $range ? $range->toString() : Range::DAY,
            'limit' => $limit,
            'offset' => $offset,
            'region' => $region ? $region->toString() : RegionType::TOTAl
        ];

        return $this->httpClient->getAsync("guilds/$guildId/top", ['query' => $query])
            ->otherwise(
                static function (RequestException $exception) use ($guildId) {
                    if($exception->getCode() === 404) {
                        throw new GuildNotFoundException($guildId);
                    }

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
     * Get guild member list
     *
     * @param string $guildId
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGuildMembers(string $guildId): PromiseInterface {
        return $this->httpClient->getAsync("guilds/$guildId/members")
            ->otherwise(
                static function (RequestException $exception) use ($guildId) {
                    if($exception->getCode() === 404) {
                        throw new GuildNotFoundException($guildId);
                    }

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
     * Returns recent guild vs guild kill events
     *
     * @param string $id
     * @param string $otherGuildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGuildFeud(string $id, string $otherGuildId): PromiseInterface
    {
        return $this->httpClient->getAsync("guilds/$id/feud/$otherGuildId")
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
     * Find guilds by it's name
     *
     * @param string $query
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     */
    public function searchGuild(string $query): PromiseInterface {
        $query = urlencode($query);

        return $this->httpClient->getAsync("search?q=${query}")
            ->otherwise(
                static function (RequestException $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode($response->getBody()->getContents(), true);
                }
            )
            ->then(
                static function (array $data) use ($query) {
                    if(!array_key_exists('guilds', $data) || empty($data['guilds'])) {
                        throw new GuildNotFoundException($query);
                    }

                    return $data['guilds'];
                }
            );
    }

    /**
     * Get guild top by recent attacks
     *
     * @param \Albion\API\Domain\Range|null $range
     * @param int                                         $limit
     * @param int                                         $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGuildTopByAttacks(Range $range = null,
                                         int $limit = 10,
                                         int $offset = 0): PromiseInterface {
        $query = [
            'range' => $range ? $range->toString() : Range::DAY,
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->httpClient->getAsync('guilds/topguildsbyattacks', ['query' => $query])
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
     * Get guild top by recent defences
     *
     * @param \Albion\API\Domain\Range|null $range
     * @param int                                         $limit
     * @param int                                         $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGuildTopByDefences(Range $range = null,
                                          int $limit = 10,
                                          int $offset = 0): PromiseInterface {
        $query = [
            'range' => $range ? $range->toString() : Range::DAY,
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->httpClient->getAsync('guilds/topguildsbydefenses', ['query' => $query])
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
     * Get guild top events in selected range
     *
     * @param string                        $guildId
     * @param \Albion\API\Domain\Range|null $range
     * @param int                           $limit
     * @param int                           $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getGuildTopEvents(string $guildId,
                                      Range $range = null,
                                      int $limit = 10,
                                      int $offset = 0): PromiseInterface {
        $query = [
            'range' => $range ? $range->toString() : Range::WEEK,
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->httpClient->getAsync("guilds/$guildId/top", ['query' => $query])
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