<?php

namespace Albion\OnlineDataProject\Domain;

use Albion\OnlineDataProject\Foundation\DataTypes\Enumerable;

class BattleSortType extends Enumerable
{
    const TOTAL_FAME = 'totalFame';
    const TOTAL_KILLS = 'totalKills';
    const RECENT = 'recent';
}