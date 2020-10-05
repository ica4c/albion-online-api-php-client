<?php

namespace Albion\API\Domain;

use Albion\API\Foundation\DataTypes\Enumerable;

class PlayerStatSubType extends Enumerable
{
    const ALL = 'All';
    const FIBER = 'Fiber';
    const HIDE = 'Hide';
    const ORE = 'Ore';
    const ROCK = 'Rock';
    const WOOD = 'Wood';
}