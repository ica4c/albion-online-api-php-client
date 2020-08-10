<?php

namespace Albion\OnlineDataProject\Infrastructure\GameInfo;

use Albion\OnlineDataProject\Domain\Range;
use Albion\OnlineDataProject\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use Albion\OnlineDataProject\Infrastructure\GameInfo\Exceptions\PlayerNotFoundException;
use Albion\OnlineDataProject\Domain\PlayerStatSubType;
use Albion\OnlineDataProject\Domain\PlayerStatType;
use Albion\OnlineDataProject\Domain\RegionType;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class PlayerClient extends AbstractClient
{
    /**
     * @param string $playerID
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     */
    public function getPlayerInfo(string $playerID): PromiseInterface {
        return $this->httpClient->getAsync("players/${playerID}")
            ->otherwise(
                static function (ClientException $exception) use ($playerID) {
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
     * @param string $playerID
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     */
    public function getPlayerDeaths(string $playerID): PromiseInterface {
        return $this->httpClient->getAsync("players/${playerID}/deaths")
            ->otherwise(
                static function (ClientException $exception) use ($playerID) {
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
     * @param \Albion\OnlineDataProject\Domain\Range|null             $range
     * @param int                                                     $limit
     * @param int                                                     $offset
     * @param \Albion\OnlineDataProject\Domain\PlayerStatType|null    $type
     * @param \Albion\OnlineDataProject\Domain\PlayerStatSubType|null $subType
     * @param \Albion\OnlineDataProject\Domain\RegionType|null        $region
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
            'type' => $type ? $type->toString() : PlayerStatType::GATHERING,
            'subtype' => $subType ? $subType->toString() : PlayerStatSubType::ALL,
            'region' => $region ? $region->toString() : RegionType::TOTAl,
        ];

        if($guildId) {
            $query['guildId'] = $guildId;
        }

        if($allianceId) {
            $query['allianceId'] = $allianceId;
        }

        return $this->httpClient->getAsync('players/statistics', ['query' => $query])
            ->otherwise(
                static function (ClientException $exception) {
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
     * @param string $query
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchPlayer(string $query): PromiseInterface {
        return $this->httpClient->getAsync("search?q=${query}")
            ->otherwise(
                static function (ClientException $exception) {
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