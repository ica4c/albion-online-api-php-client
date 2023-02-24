<?php

namespace Albion\API\Infrastructure\GameInfo\Enums;

use Solid\Foundation\Enum;

class RealmHost extends Enum
{
    public const WEST = 'https://gameinfo.albiononline.com';
    public const EAST = 'https://gameinfo-sgp.albiononline.com';
}