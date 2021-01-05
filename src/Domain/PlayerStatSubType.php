<?php

namespace Albion\API\Domain;

use Solid\Foundation\Enum;

class PlayerStatSubType extends Enum
{
    const ALL = 'All';
    const FIBER = 'Fiber';
    const HIDE = 'Hide';
    const ORE = 'Ore';
    const ROCK = 'Rock';
    const WOOD = 'Wood';
}