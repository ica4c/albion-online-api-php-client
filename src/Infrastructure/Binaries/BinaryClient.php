<?php

namespace Albion\API\Infrastructure\Binaries;

use Albion\API\Infrastructure\Binaries\Extractors\ItemExtractor;
use Albion\API\Infrastructure\Binaries\Extractors\LocalizationExtractor;

class BinaryClient extends GithubBinaryClient
{
    /**
     * @return array
     * @throws Exceptions\FailedToFetchResourceException
     */
    public function getItems(): array {
        $xml = $this->fetchXML('items');
        return (new ItemExtractor($xml))->extract();
    }

    /**
     * @return string[][]
     * @throws \Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
     */
    public function getLocalization(): array {
        $xml = $this->fetchXML('localization');
        return (new LocalizationExtractor($xml))->extract();
    }
}