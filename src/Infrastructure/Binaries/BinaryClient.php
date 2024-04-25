<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\Binaries;

use Albion\API\Infrastructure\Binaries\Extractors\ItemExtractor;
use Albion\API\Infrastructure\Binaries\Extractors\LocalizationExtractor;

class BinaryClient extends GithubBinaryClient
{
    public function getItems(): array
    {
        $xml = $this->fetchXML('items');
        return ItemExtractor::make($xml)->extract();
    }

    /**
     * @return string[][]
     *
     * @throws \Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
     */
    public function getLocalization(): array
    {
        $xml = $this->fetchXML('localization');
        return LocalizationExtractor::make($xml)->extract();
    }
}
