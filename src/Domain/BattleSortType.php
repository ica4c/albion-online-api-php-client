<?php

namespace Albion\API\Domain;

use Albion\API\Foundation\DataTypes\Enumerable;

class BattleSortType extends Enumerable
{
    const TOTAL_FAME = 'totalFame';
    const TOTAL_KILLS = 'totalKills';
    const RECENT = 'recent';
}