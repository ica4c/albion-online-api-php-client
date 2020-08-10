<?php

namespace Albion\OnlineDataProject\Domain;

use InvalidArgumentException;

class Location
{
    const BRIDGEWATHCH = 'bridgewatch';
    const LYMHURST = 'lymhurst';
    const FORT_STERLING = 'fort_sterling';
    const THETFORD = 'thetford';
    const MARTLOCK = 'martlock';
    const KAERLEON = 'kaerleon';

    /**
     * Location constructor.
     *
     * @param \Albion\OnlineDataProject\Models\string $type
     */
    public function __construct(string $type)
    {
        switch ($type) {
            case static::FORT_STERLING:
            case static::THETFORD:
            case static::BRIDGEWATHCH:
            case static::LYMHURST:
            case static::MARTLOCK:
            case static::KAERLEON:
                break;

            default:
                throw new InvalidArgumentException('Unsupported enum type');
        }
    }

    public static function of($type) {
        return new static($type);
    }
}