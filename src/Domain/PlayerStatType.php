<?php

declare(strict_types=1);

namespace Albion\API\Domain;

enum PlayerStatType: string
{
    case ALL = 'All';
    case PVE = 'PvE';
    case PVP = 'PvP';
    case GATHERING = 'Gathering';
    case CRAFTING = 'Crafting';
}
