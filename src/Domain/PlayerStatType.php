<?php


namespace Albion\API\Domain;

use Solid\Foundation\Enum;

class PlayerStatType extends Enum
{
    const PVE = 'PvE';
    const PVP = 'PvP';
    const GATHERING = 'Gathering';
    const CRAFTING = 'Crafting';
}