<?php

declare(strict_types=1);

namespace Albion\API\Domain;

enum WeaponClass: string
{
    case ALL = 'all';
    case ARCANE_STAFF = 'arcanestaff';
    case AXE = 'axe';
    case BOW = 'bow';
    case CROSSBOW = 'crossbow';
    case CURSE_STAFF = 'cursestaff';
    case DAGGER = 'dagger';
    case FIRE_STAFF = 'firestaff';
    case FROST_STAFF = 'froststaff';
    case HAMMER = 'hammer';
    case HOLY_STAFF = 'holystaff';
    case MACE = 'mace';
    case NATURE_STAFF = 'naturestaff';
    case QUARTER_STAFF = 'quarterstaff';
    case SPEAR = 'spear';
    case SWORD = 'sword';
}
