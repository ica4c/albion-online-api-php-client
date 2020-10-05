<?php

namespace Albion\API\Domain;

use Albion\API\Foundation\DataTypes\Enumerable;
use InvalidArgumentException;

class Location extends Enumerable
{
    const BRIDGEWATHCH = 'bridgewatch';
    const LYMHURST = 'lymhurst';
    const FORT_STERLING = 'fort_sterling';
    const THETFORD = 'thetford';
    const MARTLOCK = 'martlock';
    const KAERLEON = 'kaerleon';
}