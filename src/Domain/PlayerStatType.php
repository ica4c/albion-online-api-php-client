<?php


namespace Albion\API\Domain;

use Albion\API\Foundation\DataTypes\Enumerable;

class PlayerStatType extends Enumerable
{
    const PVE = 'PvE';
    const PVP = 'PvP';
    const GATHERING = 'Gathering';
}