<?php

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\Range;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use Albion\API\Infrastructure\GameInfo\Exceptions\PlayerNotFoundException;
use Albion\API\Domain\PlayerStatSubType;
use Albion\API\Domain\PlayerStatType;
use Albion\API\Domain\RegionType;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class PlayerClient extends AbstractClient
{
    /**
     * Get player info by his $playerId
     *
     * @param string $playerID
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     */
    public function getPlayerInfo(string $playerID): PromiseInterface {
        return $this->httpClient->getAsync("players/${playerID}")
            ->otherwise(
                static function (RequestException $exception) use ($playerID) {
                    if($exception->getCode() === 404) {
                        throw new PlayerNotFoundException($playerID, $exception);
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
     * Get player deaths by $playerId
     *
     * @param string $playerID
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     */
    public function getPlayerDeaths(string $playerID): PromiseInterface {
        return $this->httpClient->getAsync("players/${playerID}/deaths")
            ->otherwise(
                static function (RequestException $exception) use ($playerID) {
                    if($exception->getCode() === 404) {
                        throw new PlayerNotFoundException($playerID, $exception);
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
     * Get player kills by $playerId
     *
     * @param string $playerID
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     */
    public function getPlayerKills(string $playerID): PromiseInterface {
        return $this->httpClient->getAsync("players/${playerID}/kills")
            ->otherwise(
                static function (RequestException $exception) use ($playerID) {
                    if($exception->getCode() === 404) {
                        throw new PlayerNotFoundException($playerID, $exception);
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
     * Get total player statistics by his $playerId
     *
     * @param \Albion\API\Domain\Range|null             $range
     * @param int                                                     $limit
     * @param int                                                     $offset
     * @param \Albion\API\Domain\PlayerStatType|null    $type
     * @param \Albion\API\Domain\PlayerStatSubType|null $subType
     * @param \Albion\API\Domain\RegionType|null        $region
     * @param string|null                                             $guildId
     * @param string|null                                             $allianceId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     */
    public function getPlayerStatistics(Range $range = null,
                                        int $limit = 10,
                                        int $offset = 0,
                                        PlayerStatType $type = null,
                                        PlayerStatSubType $subType = null,
                                        RegionType $region = null,
                                        string $guildId = null,
                                        string $allianceId = null): PromiseInterface {
        $query = [
            'range' => $range ? $range->toString() : Range::WEEK,
            'limit' => min($limit, 10000),
            'offset' => max(0, $offset),
            'type' => $type ? $type->toString() : PlayerStatType::PVE,
            'region' => $region ? $region->toString() : RegionType::TOTAl,
        ];

        if($type !== null && $type->is(PlayerStatType::GATHERING) ) {
            $query['subtype'] = $subType ? $subType->toString() : PlayerStatSubType::ALL;
        }

        if($guildId) {
            $query['guildId'] = $guildId;
        }

        if($allianceId) {
            $query['allianceId'] = $allianceId;
        }

        return $this->httpClient->getAsync('players/statistics', ['query' => $query])
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
     * Find players by part or full name
     *
     * @param string $query
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchPlayer(string $query): PromiseInterface {
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
                    if(!array_key_exists('players', $data) || empty($data['players'])) {
                        throw new PlayerNotFoundException($query);
                    }

                    return $data['players'];
                }
            );
    }
}