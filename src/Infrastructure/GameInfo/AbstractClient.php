<?php

namespace Albion\API\Infrastructure\GameInfo;

use GuzzleHttp\Client;

abstract class AbstractClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * AbstractGamestatsClient constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://gameinfo.albiononline.com/api/gameinfo/'
        ]);
    }
}