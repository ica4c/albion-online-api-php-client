<?php

namespace Albion\API\Domain;

use Albion\API\Foundation\DataTypes\Enumerable;

class Range extends Enumerable
{
    const DAY = 'day';
    const WEEK = 'week';
    const MONTH = 'month';
    const LAST_WEEK = 'lastWeek';
    const LAST_MONTH = 'lastMonth';
}