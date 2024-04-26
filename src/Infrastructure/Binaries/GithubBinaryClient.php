<?php

declare(strict_types=1);

namespace Albion\API\Infrastructure\Binaries;

use Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException;
use Albion\API\Infrastructure\Binaries\Exceptions\FailedToLoadXMLException;
use DOMDocument;
use GuzzleHttp\Client;
use Throwable;

abstract class GithubBinaryClient
{
    public function __construct(protected Client $http)
    {
    }

    /**
     * @param string $url
     *
     * @return string
     *
     * @throws \Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
     */
    protected function fetchData(string $url): string
    {
        try {
            $response = $this->http->get($url);
            return $response->getBody()->getContents();
        } catch (Throwable $exception) {
            throw new FailedToFetchResourceException($url, $exception);
        }
    }

    /**
     * @param string $resource
     *
     * @return DOMDocument
     *
     * @throws \Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
     * @throws \Albion\API\Infrastructure\Binaries\Exceptions\FailedToLoadXMLException
     */
    protected function fetchXML(string $resource): DOMDocument
    {
        if(!str_contains('.xml', $resource)) {
            $resource .= '.xml';
        }

        $dom = new DOMDocument();

        if (!$dom->loadXML($this->fetchData($resource))) {
            throw new FailedToLoadXMLException($resource);
        }

        return $dom;
    }

    /**
     * @param string $resource
     *
     * @return array
     *
     * @throws FailedToFetchResourceException
     * @throws \JsonException
     */
    protected function fetchJSON(string $resource): array
    {
        if(!str_contains('.json', $resource)) {
            $resource .= '.json';
        }

        return json_decode($this->fetchData($resource), true, 512, JSON_THROW_ON_ERROR);
    }
}
