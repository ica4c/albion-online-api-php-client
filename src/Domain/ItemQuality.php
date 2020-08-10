<?php

namespace Albion\OnlineDataProject\Domain;

class ItemQuality
{
    const NORMAL = 1;
    const GOOD = 2;
    const OUTSTANDING = 3;
    const EXCELLENT = 4;
    const MASTERPIECE = 5;

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