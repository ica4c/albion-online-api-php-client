<?php

namespace Albion\API\Infrastructure\GameInfo;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleRetry\GuzzleRetryMiddleware;

abstract class AbstractClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * AbstractClient constructor.
     */
    public function __construct(string $host)
    {
        $stack = HandlerStack::create();

        $stack->push(GuzzleRetryMiddleware::factory());

        $this->httpClient = new Client(
            [
                'base_uri' => "$host/api/gameinfo/",
                'handler' => $stack,
                'retry_on_timeout' => true,
                'max_retry_attempts' => 3,
                'connect_timeout' => 5,
                'timeout' => 90
            ]
        );
    }
}