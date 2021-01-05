<?php

namespace Albion\API\Domain;

use Solid\Foundation\Enum;

class ItemQuality extends Enum
{
    const NORMAL = 1;
    const GOOD = 2;
    const OUTSTANDING = 3;
    const EXCELLENT = 4;
    const MASTERPIECE = 5;
}