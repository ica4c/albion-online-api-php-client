<?php

namespace Albion\OnlineDataProject\Infrastructure\GameInfo;

use Albion\OnlineDataProject\Domain\BattleSortType;
use Albion\OnlineDataProject\Domain\Range;
use Albion\OnlineDataProject\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class BattleClient extends AbstractClient
{
    /**
     * Get recent battles
     *
     * @param \Albion\OnlineDataProject\Domain\Range|null          $range
     * @param int                                                  $limit
     * @param int                                                  $offset
     * @param \Albion\OnlineDataProject\Domain\BattleSortType|null $sort
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getBattles(Range $range = null,
                               int $limit = 10,
                               int $offset = 0,
                               BattleSortType $sort = null): PromiseInterface {
        $query = [
            'range' => $range ? $range->toString() : Range::DAY,
            'limit' => $limit,
            'offset' => $offset,
            'sort' => $sort ? $sort->toString() : BattleSortType::RECENT
        ];

        return $this->httpClient->getAsync('battles', ['query' => $query])
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
}