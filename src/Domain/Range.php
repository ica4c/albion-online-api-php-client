<?php

declare(strict_types=1);

namespace Albion\API\Domain;

enum Range: string
{
    case DAY = 'day';
    case WEEK = 'week';
    case MONTH = 'month';
    case LAST_WEEK = 'lastWeek';
    case LAST_MONTH = 'lastMonth';
}
