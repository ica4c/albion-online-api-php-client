<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\Exceptions\AllianceNotFoundException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
use Throwable;

class AllianceClient extends AbstractClient
{
    /**
     * Get alliance by it's id
     *
     * @param \Albion\API\Domain\Realm $realm
     * @param string $allianceId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\UnknownRealmProvidedException
     * @throws AllianceNotFoundException
     * @throws \JsonException
     */
    public function getAllianceInfo(Realm $realm, string $allianceId): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "alliances/{$allianceId}");

        return $this->http->getAsync($url)
            ->otherwise(
                static function (Throwable $exception) {
                    throw new AllianceNotFoundException($exception);
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
