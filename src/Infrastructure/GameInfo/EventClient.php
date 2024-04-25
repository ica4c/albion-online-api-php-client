<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\Range;
use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
use Throwable;

class EventClient extends AbstractClient
{
    /**
     * Get recent events
     *
     * @param Realm $realm
     * @param int $limit
     * @param int $offset
     * @param string|null $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getEvents(
        Realm $realm,
        int $limit = 10,
        int $offset = 0,
        string $guildId = null
    ): PromiseInterface {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'events');

        $query = [
            'limit' => max(0, min($limit, 51)),
            'offset' => max(0, min($offset, 1000)),
        ];

        if($guildId) {
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
     * Get event by its id
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $id
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getEvent(Realm $realm, string $id): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "events/$id");

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
     * Get player events feud
     *
     * @param Realm $realm
     * @param string $id
     * @param string $victimId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getEventFeud(Realm $realm, string $id, string $victimId): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "events/{$id}/history/{$victimId}");

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
     * Get top events by acquired PvP fame
     *
     * @param Realm $realm
     * @param \Albion\API\Domain\Range|null $range
     * @param int $limit
     * @param int $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getTopEventsByKillFame(
        Realm $realm,
        Range $range = null,
        int $limit = 10,
        int $offset = 0
    ): PromiseInterface {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'events/killfame');

        $query = [
            'range' => $range !== null ? $range->value : Range::DAY,
            'limit' => max(0, min($limit, 51)),
            'offset' => max(0, min($offset, 1000)),
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
}
