<?php

declare(strict_types=1);

namespace Albion\API\Domain;

enum Location: string
{
    case BRIDGEWATCH = 'bridgewatch';
    case LYMHURST = 'lymhurst';
    case FORT_STERLING = 'fort_sterling';
    case THETFORD = 'thetford';
    case MARTLOCK = 'martlock';
    case CAERLEON = 'caerleon';
}
