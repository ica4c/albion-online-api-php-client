<?php

namespace Albion\API\Domain;

use Solid\Foundation\Enum;

class Range extends Enum
{
    const DAY = 'day';
    const WEEK = 'week';
    const MONTH = 'month';
    const LAST_WEEK = 'lastWeek';
    const LAST_MONTH = 'lastMonth';
}