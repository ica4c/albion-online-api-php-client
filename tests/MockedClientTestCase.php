<?php

declare(strict_types=1);

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

abstract class MockedClientTestCase extends TestCase
{
    protected function mockClient(array $samples): Client
    {
        $mock = new MockHandler($samples);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);
    }

    protected function loadResponseSamplesFromSamplesJson(string $name): array
    {
        return array_map(
            static fn(array $content) => new Response(
                $content['code'] ?? 200,
                ['Content-Type' => 'application/json'],
                json_encode($content)
            ),
            json_decode(
                file_get_contents(__DIR__ . "/samples/{$name}"),
                true,
                512,
                JSON_THROW_ON_ERROR
            )
        );
    }

    protected function makeSampleByResource(int $code, string $contentType, string $name): Response
    {
        return new Response(
            $code,
            ['Content-Type' => $contentType],
            file_get_contents(__DIR__ . "/samples/{$name}")
        );
    }
}