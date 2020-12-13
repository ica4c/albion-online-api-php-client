<?php

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\BattleSortType;
use Albion\API\Domain\Range;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class BattleClient extends AbstractClient
{
    /**
     * Get recent battles
     *
     * @param \Albion\API\Domain\Range|null          $range
     * @param int                                    $limit
     * @param int                                    $offset
     * @param \Albion\API\Domain\BattleSortType|null $sort
     * @param string|null                            $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBattles(Range $range = null,
                               int $limit = 10,
                               int $offset = 0,
                               BattleSortType $sort = null,
                               string $guildId = null): PromiseInterface {
        $query = [
            'range' => $range ? $range->toString() : Range::DAY,
            'limit' => $limit,
            'offset' => $offset,
            'sort' => $sort ? $sort->toString() : BattleSortType::RECENT
        ];

        if($guildId !== null) {
            $query['guildId'] = $guildId;
        }

        return $this->httpClient->getAsync('battles', ['query' => $query])
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