<?php

namespace Albion\API\Domain;

use Solid\Foundation\Enum;

class BattleSortType extends Enum
{
    const TOTAL_FAME = 'totalFame';
    const TOTAL_KILLS = 'totalKills';
    const RECENT = 'recent';
}