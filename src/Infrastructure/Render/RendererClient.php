<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\Render;

use Albion\API\Domain\ItemQuality;
use Albion\API\Infrastructure\GameInfo\Exceptions\ItemNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

class RendererClient
{
    protected const BASE = "https://render.albiononline.com/v1/item/";

    public function __construct(protected Client $http)
    {
    }

    /**
     * Resolve item icon from render service
     *
     * @param string $itemId
     * @param ItemQuality|null $quality
     * @param int $enchantment
     * @param int $size
     * @param string $locale
     *
     * @return PromiseInterface<string>
     *
     * @throws ItemNotFoundException
     */
    public function getItemIcon(
        string $itemId,
        ?ItemQuality $quality = null,
        int $enchantment = 0,
        int $size = 217,
        string $locale = 'en'
    ): PromiseInterface {
        $enchantment = max(min($enchantment, 3), 0);
        $url = sprintf(
            "%s/%s",
            static::BASE,
            str_contains($itemId, '@') ? "${itemId}.png" : "${itemId}@${enchantment}.png",
        );

        return $this->http->requestAsync(
            'GET',
            $url,
            [
                'query' => [
                    'quality' => $quality?->value ?: ItemQuality::NORMAL->value,
                    'size' => max(32, min($size, 217)),
                    'locale' => $locale ?: 'en'
                ]
            ]
        )
            ->otherwise(
                static fn (\Throwable $e) => throw new ItemNotFoundException($itemId, $e)
            )
            ->then(
                static fn (ResponseInterface $response) => $response->getBody()->getContents()
            );
    }
}
