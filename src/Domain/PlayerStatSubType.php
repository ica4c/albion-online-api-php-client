<?php

declare(strict_types=1);

namespace Albion\API\Domain;

enum PlayerStatSubType: string
{
    case ALL = 'All';
    case FIBER = 'Fiber';
    case HIDE = 'Hide';
    case ORE = 'Ore';
    case ROCK = 'Rock';
    case WOOD = 'Wood';
}
