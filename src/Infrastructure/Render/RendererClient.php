<?php

namespace Albion\API\Infrastructure\Render;

use Albion\API\Domain\ItemQuality;
use Albion\API\Infrastructure\GameInfo\Exceptions\FailedToPerformRequestException;
use Albion\API\Infrastructure\GameInfo\Exceptions\ItemNotFoundException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Response;

class RendererClient
{
    protected const BASE = "https://render.albiononline.com/v1/item/";

    /**
     * Resolve item icon from render service
     *
     * @param string $itemId
     * @param ItemQuality|null $quality
     * @param int $enchantment
     * @param int $size
     * @param string $locale
     *
     * @return string
     * @throws ItemNotFoundException
     */
    public function getItemIcon(
        string $itemId,
        ItemQuality $quality = null,
        int $enchantment = 0,
        int $size = 217,
        string $locale = 'en'
    ): string {
        $enchantment = max(min($enchantment, 3), 0);

        $contents = file_get_contents(
            sprintf(
                "%s/%s?%s",
                static::BASE,
                str_contains($itemId, '@') ? "${itemId}.png" : "${itemId}@${enchantment}.png",
                implode(
                    "&",
                    [
                        'quality' => $quality ? $quality->toString() : ItemQuality::NORMAL,
                        'size' => max(32, min($size, 217)),
                        'locale' => $locale ?: 'en'
                    ]
                )
            )
        );

        if ($contents === false) {
            throw new ItemNotFoundException($itemId);
        }

        return $contents;
    }
}