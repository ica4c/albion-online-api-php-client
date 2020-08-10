<?php

namespace Albion\OnlineDataProject;

use DateTime;

class OnlineDataClient
{
    /** @var \GuzzleHttp\Client */
    protected $httpClient;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => 'https://www.albion-online-data.com/api'
        ]);
    }

    /**
     * @inheritDoc
     *
     * @param \Albion\OnlineDataProject\string               $itemId
     * @param \Albion\OnlineDataProject\Models\Location[]    $locations
     * @param \DateTime                                      $date
     * @param \Albion\OnlineDataProject\Models\ItemQuality[] $qualities
     * @param \Albion\OnlineDataProject\int                  $timeScale
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function fetchCharts(string $itemId, array $locations, DateTime $date, array $qualities, int $timeScale)
    {

    }

    public function fetchHistory()
    {

    }

    public function fetchGoldHistory()
    {

    }

    public function fetchPrices()
    {

    }

    public function fetchItemData()
    {

    }
}