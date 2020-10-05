<?php

namespace Albion\API\Infrastructure\Binaries;

use Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException;
use Albion\API\Infrastructure\Binaries\Extractors\CategoryExtractor;
use Albion\API\Infrastructure\Binaries\Extractors\ItemExtractor;
use Albion\API\Infrastructure\Binaries\Extractors\LocalizationExtractor;
use DOMDocument;
use DOMText;
use DOMXPath;
use GuzzleHttp\Exception\RequestException;
use SimpleXMLElement;
use function foo\func;

class BinaryClient
{
    /** @var \GuzzleHttp\Client */
    protected $httpClient;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => 'https://raw.githubusercontent.com/broderickhyman/ao-bin-dumps/master/'
        ]);
    }

    /**
     * @inheritDoc
     * @param string $url
     *
     * @return string
     * @throws \Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
     */
    protected function fetchData(string $url): string {
        try {
            $response = $this->httpClient->get($url);
            return $response->getBody()->getContents();
        } catch (RequestException $exception) {
            throw new FailedToFetchResourceException($url, $exception);
        }
    }

    /**
     * @inheritDoc
     * @param string $resource
     *
     * @return \SimpleXMLElement
     * @throws \Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
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
     * @inheritDoc
     * @return string[][]
     * @throws \Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
     */
    public function fetchLocalization(): array {
        $xml = $this->fetchXML('localization');
        return (new LocalizationExtractor($xml))->extract();
    }

    /**
     * @inheritDoc
     * @return string[]
     * @throws \Albion\API\Infrastructure\Binaries\Exceptions\FailedToFetchResourceException
     */
    public function fetchItems(): array {
        $xml = $this->fetchXML('items');

        return [
            'categories' => (new CategoryExtractor($xml))->extract(),
            'items' => (new ItemExtractor($xml))->extract()
        ];
    }
}