<?php

namespace Tests;

use Closure;
use GuzzleHttp\Promise\PromiseInterface;
use InvalidArgumentException;
use Mockery;
use PHPUnit\Framework\Constraint\Callback;
use PHPUnit\Framework\TestCase;
use function GuzzleHttp\Promise\queue;

abstract class GuzzleTestCase extends TestCase
{
    /**
     * @inheritDoc
     * @param \GuzzleHttp\Promise\PromiseInterface $promise
     */
    public function awaitPromise(PromiseInterface $promise) {
//        $console = Mockery::mock('console');
//
//        $console->shouldReceive('log')
//            ->once()
//            ->with('success');
//
//        $p = $promise->then(
//            static function($data) use ($console) {
//                $console->log('success');
//                return $data;
//            }
//        );

        $value = $promise->wait();
        queue();

        return $value;
    }
}