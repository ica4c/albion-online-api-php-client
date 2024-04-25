<?php

declare(strict_types=1);

namespace Albion\API\Domain;

enum BattleSortType: string
{
    case TOTAL_FAME = 'totalFame';
    case TOTAL_KILLS = 'totalKills';
    case RECENT = 'recent';
}
