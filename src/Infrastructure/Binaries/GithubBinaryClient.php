<?php

namespace Albion\API\Infrastructure\Binaries;

use Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException;
use Albion\API\Infrastructure\Binaries\Extractors\CategoryExtractor;
use Albion\API\Infrastructure\Binaries\Extractors\ItemExtractor;
use Albion\API\Infrastructure\Binaries\Extractors\LocalizationExtractor;
use DOMDocument;
use DOMText;
use DOMXPath;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use SimpleXMLElement;
use function foo\func;

abstract class GithubBinaryClient
{
    /** @var Client */
    protected $httpClient;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://raw.githubusercontent.com/broderickhyman/ao-bin-dumps/master/',
            'timeout' => 30
        ]);
    }

    /**
     * @param string $url
     * @return string
     * @throws FailedToFetchResourceException
     */
    protected function fetchData(string $url): string {
        try {
            $urlParts = explode('/', $url);
            $fileName = end($urlParts);

            $cachePath = __DIR__ . "/.cache";

            if(!file_exists($cachePath)) {
                mkdir($cachePath, 0777);
            }

            $cachedFilePath = "$cachePath/$fileName";

            if(file_exists($cachedFilePath)) {
                $cacheModifiedAt = filemtime($cachedFilePath);

                if($cacheModifiedAt > time() - 6 * 24 * 60 * 60) {
                    return file_get_contents($cachedFilePath);
                }
            }

            $response = $this->httpClient->get($url);
            $content = $response->getBody()->getContents();

            file_put_contents($cachedFilePath, $content);
            return $content;
        } catch (RequestException $exception) {
            throw new FailedToFetchResourceException($url, $exception);
        }
    }

    /**
     * @param string $resource
     * @return DOMDocument
     * @throws FailedToFetchResourceException
     */
    protected function fetchXML(string $resource): DOMDocument {
        if(strpos('.xml', $resource) === false) {
            $resource .= '.xml';
        }

        $dom = new DOMDocument();
        $dom->loadXML($this->fetchData($resource));

        return $dom;
    }

    /**
     * @param string $resource
     *
     * @return array
     * @throws FailedToFetchResourceException
     */
    protected function fetchJSON(string $resource): array {
        if(strpos('.json', $resource) === false) {
            $resource .= '.json';
        }

        return json_decode($this->fetchData($resource), true);
    }
}