<?php

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\Range;
use Albion\API\Domain\WeaponClass;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class EventClient extends AbstractClient
{
    /**
     * Get recent events
     *
     * @param int         $limit
     * @param int         $offset
     * @param string|null $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getEvents(int $limit = 10, int $offset = 0, string $guildId = null): PromiseInterface
    {
        $query = [
            'limit' => max(0, min($limit, 51)),
            'offset' => max(0, min($offset, 1000)),
        ];

        if($guildId) {
            $query['guildId'] = $guildId;
        }

        return $this->httpClient->getAsync('events', ['query' => $query])
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
     * Get event by its id
     *
     * @param string $id
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getEvent(string $id): PromiseInterface
    {
        return $this->httpClient->getAsync("events/$id")
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
     * Get player events feud
     *
     * @param string $id
     * @param string $victimId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getEventFeud(string $id, string $victimId): PromiseInterface
    {
        return $this->httpClient->getAsync("events/$id/history/$victimId")
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
     * Get top events by guild fame
     *
     * @param \Albion\API\Domain\Range|null $range
     * @param int                                         $limit
     * @param int                                         $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTopEventsByGuildFame(Range $range = null, int $limit = 10, int $offset = 0): PromiseInterface
    {
        $query = [
            'range' => $range ? $range->toString() : Range::DAY,
            'limit' => max(0, min($limit, 51)),
            'offset' => max(0, min($offset, 1000)),
        ];

        return $this->httpClient->getAsync('events/guildfame', ['query' => $query])
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
     * Get top events by player fame
     *
     * @param \Albion\API\Domain\Range|null $range
     * @param int                           $limit
     * @param int                           $offset
     * @param string|null                   $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTopEventsByPlayerFame(Range $range = null, int $limit = 10, int $offset = 0, string $guildId = null): PromiseInterface
    {
        $query = [
            'range' => $range ? $range->toString() : Range::DAY,
            'limit' => max(0, min($limit, 51)),
            'offset' => max(0, min($offset, 1000)),
        ];

        if($guildId !== null) {
            $query['guildId'] = $guildId;
        }

        return $this->httpClient->getAsync('events/playerfame', ['query' => $query])
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
     * Get top events by player fame filtered by weapon type
     *
     * @param \Albion\API\Domain\Range|null       $range
     * @param \Albion\API\Domain\WeaponClass|null $weaponCategory
     * @param int                                               $limit
     * @param int                                               $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTopEventsByPlayerWeaponFame(Range $range = null,
                                                   WeaponClass $weaponCategory = null,
                                                   int $limit = 10,
                                                   int $offset = 0): PromiseInterface
    {
        $query = [
            'range' => $range ? $range->toString() : Range::DAY,
            'weaponCategory' => $weaponCategory ? $weaponCategory->toString() : WeaponClass::ALL,
            'limit' => max(0, min($limit, 51)),
            'offset' => max(0, min($offset, 1000)),
        ];

        return $this->httpClient->getAsync('events/playerweaponfame', ['query' => $query])
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
     * Get top events by acquired PvP fame
     *
     * @param \Albion\API\Domain\Range|null $range
     * @param int                                         $limit
     * @param int                                         $offset
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTopEventsByKillFame(Range $range = null, int $limit = 10, int $offset = 0): PromiseInterface
    {
        $query = [
            'range' => $range ? $range->toString() : Range::DAY,
            'limit' => max(0, min($limit, 51)),
            'offset' => max(0, min($offset, 1000)),
        ];

        return $this->httpClient->getAsync('events/killfame', ['query' => $query])
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