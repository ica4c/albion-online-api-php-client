<?php

namespace Albion\OnlineDataProject\Infrastructure\GameInfo;

use Albion\OnlineDataProject\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use Albion\OnlineDataProject\Infrastructure\GameInfo\Exceptions\ItemNotFoundException;
use Albion\OnlineDataProject\Infrastructure\GameInfo\Exceptions\PlayerNotFoundException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class ItemClient extends AbstractClient
{
    public function getItemIcon(string $itemId,
                                int $quality = 1,
                                int $enchantment = 0,
                                int $size = 217,
                                string $locale = 'en'): PromiseInterface
    {
        $enchantment = max(min($enchantment, 3), 0);

        $query = [
            'quality' => max(0, min($quality, 5)),
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
                static function (ClientException $exception) use ($itemId) {
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

    public function getItemData(string $itemId): PromiseInterface
    {
        return $this->httpClient->getAsync("items/${itemId}/data")
            ->otherwise(
                static function (ClientException $exception) use ($itemId) {
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
}