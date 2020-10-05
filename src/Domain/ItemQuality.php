<?php

namespace Albion\API\Domain;

use Albion\API\Foundation\DataTypes\Enumerable;

class ItemQuality extends Enumerable
{
    const NORMAL = 1;
    const GOOD = 2;
    const OUTSTANDING = 3;
    const EXCELLENT = 4;
    const MASTERPIECE = 5;
}