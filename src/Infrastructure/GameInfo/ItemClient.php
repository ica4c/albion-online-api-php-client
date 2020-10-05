<?php

namespace Albion\API\Infrastructure\GameInfo;

use Albion\API\Domain\ItemQuality;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use Albion\API\Infrastructure\GameInfo\Exceptions\ItemNotFoundException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class ItemClient extends AbstractClient
{
    /**
     * Resolve item icon from render service
     *
     * @param string                                            $itemId
     * @param \Albion\API\Domain\ItemQuality|null $quality
     * @param int                                               $enchantment
     * @param int                                               $size
     * @param string                                            $locale
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getItemIcon(string $itemId,
                                ItemQuality $quality = null,
                                int $enchantment = 0,
                                int $size = 217,
                                string $locale = 'en'): PromiseInterface
    {
        $enchantment = max(min($enchantment, 3), 0);

        $query = [
            'quality' => $quality ? $quality->toString() : ItemQuality::NORMAL,
            'size' => max(32, min($size, 217)),
            'locale' => $locale ?: 'en'
        ];

        if(strpos($itemId, '@') !== false) {
            $url = "https://render.albiononline.com/v1/item/${itemId}.png";
        } else {
            $url = "https://render.albiononline.com/v1/item/${itemId}@${enchantment}.png";
        }

        return $this->httpClient->getAsync($url, ['query' => $query])
            ->otherwise(
                static function (RequestException $exception) use ($itemId) {
                    if($exception->getCode() === 404) {
                        throw new ItemNotFoundException($itemId, $exception);
                    }

                    throw new FailedToPerformRequestException($exception);
                }
            )
            ->then(
                static function (Response $response) {
                    return $response->getBody()->getContents();
                }
            );
    }

    /**
     * Get item description from its $itemId
     *
     * @param string $itemId
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getItemData(string $itemId): PromiseInterface
    {
        return $this->httpClient->getAsync("items/${itemId}/data")
            ->otherwise(
                static function (RequestException $exception) use ($itemId) {
                    if($exception->getCode() === 404) {
                        throw new ItemNotFoundException($itemId, $exception);
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
     * Get in-game item categories
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getItemCategories(): PromiseInterface {
        return $this->httpClient->getAsync('items/_itemCategoryTree')
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
     * Get in-game weapon classes
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getWeaponCategories(): PromiseInterface {
        return $this->httpClient->getAsync('items/_weaponCategories')
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