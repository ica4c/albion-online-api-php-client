<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\Range;
use Albion\API\Domain\Realm;
use Albion\API\Domain\RegionType;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use Albion\API\Infrastructure\GameInfo\Exceptions\GuildNotFoundException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
use Throwable;

class GuildClient extends AbstractClient
{
    /**
     * Get basic guild information
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\GuildNotFoundException
     * @throws \JsonException
     */
    public function getGuildInfo(Realm $realm, string $guildId): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "guilds/$guildId");

        return $this->http->getAsync($url)
            ->otherwise(
                static function (Throwable $exception) use ($guildId) {
                    if($exception instanceof RequestException && $exception->getCode() === 404) {
                        throw new GuildNotFoundException($guildId);
                    }

                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode(
                        $response->getBody()->getContents(),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );
                }
            );
    }

    /**
     * Get detailed guild information
     *
     * @param Realm $realm
     * @param string $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\GuildNotFoundException
     * @throws \JsonException
     */
    public function getGuildData(Realm $realm, string $guildId): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "guilds/$guildId/data");

        return $this->http->getAsync($url)
            ->otherwise(
                static function (Throwable $exception) use ($guildId) {
                    if($exception instanceof RequestException && $exception->getCode() === 404) {
                        throw new GuildNotFoundException($guildId);
                    }

                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode(
                        $response->getBody()->getContents(),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );
                }
            );
    }

    /**
     * Get guild top member list
     *
     * @param Realm $realm
     * @param string $guildId
     * @param \Albion\API\Domain\Range|null $range
     * @param int $limit
     * @param int $offset
     * @param \Albion\API\Domain\RegionType|null $region
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\GuildNotFoundException
     * @throws \JsonException
     */
    public function getGuildTopMembers(
        Realm $realm,
        string $guildId,
        ?Range $range = null,
        int $limit = 10,
        int $offset = 0,
        ?RegionType $region = null
    ): PromiseInterface {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "guilds/$guildId/top");

        $query = [
            'range' => $range?->value ?: Range::DAY->value,
            'region' => $region?->value ?: RegionType::TOTAL->value,
            'limit' => $limit,
            'offset' => $offset,
        ];

        return $this->http->getAsync($url, ['query' => $query])
            ->otherwise(
                static function (Throwable $exception) use ($guildId) {
                    if($exception instanceof RequestException && $exception->getCode() === 404) {
                        throw new GuildNotFoundException($guildId);
                    }

                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode(
                        $response->getBody()->getContents(),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );
                }
            );
    }

    /**
     * Get guild member list
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\GuildNotFoundException
     * @throws \JsonException
     */
    public function getGuildMembers(Realm $realm, string $guildId): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "guilds/$guildId/members");

        return $this->http->getAsync($url)
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
     * @param \Albion\API\Domain\Realm $realm
     * @param string $id
     * @param string $otherGuildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getGuildFeud(Realm $realm, string $id, string $otherGuildId): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "guilds/$id/feud/$otherGuildId");

        return $this->http->getAsync($url)
            ->otherwise(
                static function (Throwable $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode(
                        $response->getBody()->getContents(),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );
                }
            );
    }

    /**
     * Find guilds by it's name
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $query
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function searchGuild(Realm $realm, string $query): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "search");
        $query = urlencode($query);

        return $this->http->getAsync($url, ['query' => ['q' => $query]])
            ->otherwise(
                static function (Throwable $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode(
                        $response->getBody()->getContents(),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );
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
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getGuildTopByAttacks(
        Realm $realm,
        ?Range $range = null,
        int $limit = 10,
        int $offset = 0
    ): PromiseInterface {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'guilds/topguildsbyattacks');

        $query = [
            'range' => $range?->value ?: Range::DAY->value,
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->http->getAsync($url, ['query' => $query])
            ->otherwise(
                static function (Throwable $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode(
                        $response->getBody()->getContents(),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );
                }
            );
    }

    /**
     * Get guild top by recent defences
     *
     * @param \Albion\API\Domain\Range|null $range
     * @param int $limit
     * @param int $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getGuildTopByDefences(
        Realm $realm,
        ?Range $range = null,
        int $limit = 10,
        int $offset = 0
    ): PromiseInterface {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'guilds/topguildsbydefenses');

        $query = [
            'range' => $range?->value ?: Range::DAY->value,
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->http->getAsync($url, ['query' => $query])
            ->otherwise(
                static function (Throwable $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode(
                        $response->getBody()->getContents(),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );
                }
            );
    }

    /**
     * Get guild top events in selected range
     *
     * @param Realm $realm
     * @param string $guildId
     * @param \Albion\API\Domain\Range|null $range
     * @param int $limit
     * @param int $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getGuildTopEvents(
        Realm $realm,
        string $guildId,
        Range $range = null,
        int $limit = 10,
        int $offset = 0
    ): PromiseInterface {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "guilds/{$guildId}/top");

        $query = [
            'range' => $range?->value ?: Range::WEEK->value,
            'limit' => $limit,
            'offset' => $offset
        ];

        return $this->http->getAsync($url, ['query' => $query])
            ->otherwise(
                static function (RequestException $exception) {
                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode(
                        $response->getBody()->getContents(),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    );
                }
            );
    }
}
