<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
use Throwable;

class CGVGClient extends AbstractClient
{
    /**
     * Get upcoming CGVG matches
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param int $limit
     * @param int $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getCGVGMatches(
        Realm $realm,
        int $limit = 10,
        int $offset = 0
    ): PromiseInterface {
        $query = [
            'limit' => max(1, min($limit, 9999)),
            'offset' => max(1, min($offset, 9999)),
        ];

        $url = $this->resolver->gameinfoApiEndpoint($realm, 'matches/crystal');

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
     * Get CGVG match by its id
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $id
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getCGVGMatchById(Realm $realm, string $id): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "matches/crystal/$id");

        return $this->http->getAsync($url)
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

    /**
     * Get featured upcoming guildmatches
     *
     * @param Realm $realm
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getFeaturedGuildMatches(Realm $realm): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'guildmatches/top');

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
     * Get all upcoming guild matches
     *
     * @param Realm $realm
     * @param int $limit
     * @param int $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getUpcomingGuildMatches(
        Realm $realm,
        int $limit = 10,
        int $offset = 0
    ): PromiseInterface {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'guildmatches/next');

        $query = [
            'limit' => max(1, min($limit, 50)),
            'offset' => max(1, min($offset, 9999)),
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

    /**
     * Get all past guild matches
     *
     * @param Realm $realm
     * @param int $limit
     * @param int $offset
     * @param string|null $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getPastGuildMatches(
        Realm $realm,
        int $limit = 10,
        int $offset = 0,
        string $guildId = null
    ): PromiseInterface {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'guildmatches/past');

        $query = [
            'limit' => max(1, min($limit, 50)),
            'offset' => max(1, min($offset, 9999)),
        ];

        if($guildId !== null) {
            $query['guildId'] = $guildId;
        }

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
     * Get guild match by its id
     *
     * @param Realm $realm
     * @param string $id
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getGuildMatchById(
        Realm $realm,
        string $id
    ): PromiseInterface {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "guildmatches/$id");

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
}
