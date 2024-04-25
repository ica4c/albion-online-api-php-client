<?php

declare(strict_types=1);

namespace Albion\API\Domain;

enum ItemQuality: int
{
    case NORMAL = 1;
    case GOOD = 2;
    case OUTSTANDING = 3;
    case EXCELLENT = 4;
    case MASTERPIECE = 5;
}
