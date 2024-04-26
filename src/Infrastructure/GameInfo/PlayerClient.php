<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\Range;
use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use Albion\API\Infrastructure\GameInfo\Exceptions\PlayerNotFoundException;
use Albion\API\Domain\PlayerStatSubType;
use Albion\API\Domain\PlayerStatType;
use Albion\API\Domain\RegionType;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
use Throwable;

class PlayerClient extends AbstractClient
{
    /**
     * Get player info by his $playerId
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $playerID
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\PlayerNotFoundException
     * @throws \JsonException
     */
    public function getPlayerInfo(Realm $realm, string $playerID): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "players/{$playerID}");

        return $this->http->getAsync($url)
            ->otherwise(
                static function (Throwable $exception) use ($playerID) {
                    if($exception instanceof RequestException && $exception->getCode() === 404) {
                        throw new PlayerNotFoundException($playerID, $exception);
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
     * Get player deaths by $playerId
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $playerID
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\PlayerNotFoundException
     * @throws \JsonException
     */
    public function getPlayerDeaths(Realm $realm, string $playerID): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "players/{$playerID}/deaths");

        return $this->http->getAsync($url)
            ->otherwise(
                static function (Throwable $exception) use ($playerID) {
                    if($exception instanceof RequestException && $exception->getCode() === 404) {
                        throw new PlayerNotFoundException($playerID, $exception);
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
     * Get player kills by $playerId
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $playerID
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\PlayerNotFoundException
     * @throws \JsonException
     */
    public function getPlayerKills(Realm $realm, string $playerID): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "players/${playerID}/kills");

        return $this->http->getAsync($url)
            ->otherwise(
                static function (Throwable $exception) use ($playerID) {
                    if($exception instanceof RequestException && $exception->getCode() === 404) {
                        throw new PlayerNotFoundException($playerID, $exception);
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
     * Get total player statistics by his $playerId
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param \Albion\API\Domain\Range|null $range
     * @param int $limit
     * @param int $offset
     * @param \Albion\API\Domain\PlayerStatType|null $type
     * @param \Albion\API\Domain\PlayerStatSubType|null $subType
     * @param \Albion\API\Domain\RegionType|null $region
     * @param string|null $guildId
     * @param string|null $allianceId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getPlayerStatistics(
        Realm $realm,
        ?Range $range = null,
        int $limit = 10,
        int $offset = 0,
        ?PlayerStatType $type = null,
        ?PlayerStatSubType $subType = null,
        ?RegionType $region = null,
        ?string $guildId = null,
        ?string $allianceId = null
    ): PromiseInterface {
        $query = [
            'type' => $type?->value ?: PlayerStatType::PVE->value,
            'region' => $region?->value ?: RegionType::TOTAL->value,
            'range' => $range?->value ?: Range::WEEK->value,
            'limit' => min($limit, 10000),
            'offset' => max(0, $offset),
        ];

        if($type === PlayerStatType::GATHERING) {
            $query['subtype'] = $subType?->value ?: PlayerStatSubType::ALL->value;
        }

        if($guildId) {
            $query['guildId'] = $guildId;
        }

        if($allianceId) {
            $query['allianceId'] = $allianceId;
        }

        $url = $this->resolver->gameinfoApiEndpoint($realm, 'players/statistics');

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
     * Find players by part or full name
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $query
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\PlayerNotFoundException
     * @throws \JsonException
     */
    public function searchPlayer(Realm $realm, string $query): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'search');
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
                    if(!array_key_exists('players', $data) || empty($data['players'])) {
                        throw new PlayerNotFoundException($query);
                    }

                    return $data['players'];
                }
            );
    }
}
