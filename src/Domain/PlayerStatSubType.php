<?php

namespace Albion\OnlineDataProject\Domain;

use Albion\OnlineDataProject\Foundation\DataTypes\Enumerable;

class PlayerStatSubType extends Enumerable
{
    const ALL = 'All';
    const FIBER = 'Fiber';
    const HIDE = 'Hide';
    const ORE = 'Ore';
    const ROCK = 'Rock';
    const WOOD = 'Wood';
}