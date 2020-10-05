<?php

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Infrastructure\GameInfo\Exceptions\AllianceNotFoundException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class AllianceClient extends AbstractClient
{
    /**
     * Get alliance by it's id
     *
     * @param string $allianceId
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     */
    public function getAllianceInfo(string $allianceId): PromiseInterface {
        return $this->httpClient->getAsync("alliances/${allianceId}")
            ->otherwise(
                static function (RequestException $exception) {
                    throw new AllianceNotFoundException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return json_decode($response->getBody()->getContents(), true);
                }
            );
    }
}