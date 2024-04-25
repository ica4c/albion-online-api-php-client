<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\Realm;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use Albion\API\Infrastructure\GameInfo\Exceptions\ItemNotFoundException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;
use Throwable;

class ItemDataClient extends AbstractClient
{
    /**
     * Get item description from its $itemId
     *
     * @param Realm $realm
     * @param string $itemId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface<array>
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\ItemNotFoundException
     * @throws \JsonException
     */
    public function getItemData(Realm $realm, string $itemId): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, "items/{$itemId}/data");

        return $this->http->getAsync($url)
            ->otherwise(
                static function (Throwable $exception) use ($itemId) {
                    if($exception instanceof RequestException && $exception->getCode() === 404) {
                        throw new ItemNotFoundException($itemId, $exception);
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
     * Get in-game item categories
     *
     * @param Realm $realm
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getItemCategories(Realm $realm): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'items/_itemCategoryTree');

        return $this->http->getAsync($url)
            ->otherwise(
                static function (RequestException $exception) {
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
     * Get in-game weapon classes
     *
     * @param Realm $realm
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException
     * @throws \JsonException
     */
    public function getWeaponCategories(Realm $realm): PromiseInterface
    {
        $url = $this->resolver->gameinfoApiEndpoint($realm, 'items/_weaponCategories');

        return $this->http->getAsync($url)
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
