<?php

namespace Albion\OnlineDataProject\Infrastructure\GameInfo;

use Albion\OnlineDataProject\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class EventClient extends AbstractClient
{
    /**
     * @param int         $limit
     * @param int         $offset
     * @param string|null $guildId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getEvents(int $limit = 10, int $offset = 0, string $guildId = null): PromiseInterface
    {
        $query = [
            'limit' => max(0, min($limit, 10)),
            'offset' => max(0, min($offset, 1000)),
        ];

        if($guildId) {
            $query['guildId'] = $guildId;
        }

        return $this->httpClient->getAsync('events', ['query' => $query])
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