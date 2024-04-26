<?php

declare(strict_types=1);

namespace Albion\API\Domain;

enum RegionType: string
{
    case TOTAL = 'Total';
    case ROYAL = 'Royal';
    case OUTLANDS = 'Outlands';
    case HELLGATE = 'Hellgate';
}
