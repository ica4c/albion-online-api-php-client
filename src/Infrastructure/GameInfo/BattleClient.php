<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\BattleSortType;
use Albion\API\Domain\Range;
use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
use Throwable;

class BattleClient extends AbstractClient
{
    /**
     * Get recent battles
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param \Albion\API\Domain\Range|null $range
     * @param int $limit
     * @param int $offset
     * @param \Albion\API\Domain\BattleSortType|null $sort
     * @param string|null $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getBattles(
        Realm $realm,
        ?Range $range = null,
        int $limit = 10,
        int $offset = 0,
        ?BattleSortType $sort = null,
        ?string $guildId = null
    ): PromiseInterface {
        $query = [
            'range' => $range !== null ? $range->value : Range::DAY,
            'limit' => $limit,
            'offset' => $offset,
            'sort' => $sort !== null ? $sort->value : BattleSortType::RECENT
        ];

        if ($guildId !== null) {
            $query['guildId'] = $guildId;
        }

        $url = $this->resolver->gameinfoApiEndpoint($realm, "battles");

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
