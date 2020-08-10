<?php


namespace Albion\OnlineDataProject\Domain;

use Albion\OnlineDataProject\Foundation\DataTypes\Enumerable;

class PlayerStatType extends Enumerable
{
    const PVE = 'PvE';
    const PVP = 'PvP';
    const GATHERING = 'Gathering';
}