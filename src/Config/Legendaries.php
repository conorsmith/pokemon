<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

return [
    [
        'pokemon'  => PokedexNo::ARTICUNO,
        'location' => LocationId::SEAFOAM_ISLANDS_B4F,
        'level'    => 50,
        'unlock'   => 50,
    ],
    [
        'pokemon'  => PokedexNo::ZAPDOS,
        'location' => LocationId::POWER_PLANT,
        'level'    => 50,
        'unlock'   => 75,
    ],
    [
        'pokemon'  => PokedexNo::MOLTRES,
        'location' => LocationId::MT_EMBER_SUMMIT,
        'level'    => 50,
        'unlock'   => 100,
    ],
    [
        'pokemon'  => PokedexNo::MEWTWO,
        'location' => LocationId::CERULEAN_CAVE_B1F,
        'level'    => 70,
        'unlock'   => 125,
    ],
    [
        'pokemon'  => PokedexNo::MEW,
        'location' => LocationId::VERMILLION_HARBOUR,
        'level'    => 10,
        'unlock'   => RegionId::KANTO,
    ],
    [
        'pokemon'  => PokedexNo::RAIKOU,
        'location' => RegionId::JOHTO,
        'level'    => 40,
        'unlock'   => 150,
    ],
    [
        'pokemon'  => PokedexNo::ENTEI,
        'location' => RegionId::JOHTO,
        'level'    => 40,
        'unlock'   => 175,
    ],
    [
        'pokemon'  => PokedexNo::SUICUNE,
        'location' => RegionId::JOHTO,
        'level'    => 40,
        'unlock'   => 200,
    ],
    [
        'pokemon'  => PokedexNo::LUGIA,
        'location' => LocationId::WHIRL_ISLANDS_B3F,
        'level'    => 70,
        'unlock'   => 225,
    ],
    [
        'pokemon'  => PokedexNo::HO_OH,
        'location' => LocationId::BELL_TOWER_ROOF,
        'level'    => 70,
        'unlock'   => 250,
    ],
    [
        'pokemon'  => PokedexNo::CELEBI,
        'location' => LocationId::ILEX_FOREST,
        'level'    => 30,
        'unlock'   => RegionId::JOHTO,
    ],
    [
        'pokemon'  => PokedexNo::REGIROCK,
        'location' => LocationId::DESERT_RUINS,
        'level'    => 40,
        'unlock'   => 270,
    ],
    [
        'pokemon'  => PokedexNo::REGICE,
        'location' => LocationId::ISLAND_CAVE,
        'level'    => 40,
        'unlock'   => 290,
    ],
    [
        'pokemon'  => PokedexNo::REGISTEEL,
        'location' => LocationId::ANCIENT_TOMB,
        'level'    => 40,
        'unlock'   => 310,
    ],
    [
        'pokemon'  => PokedexNo::LATIAS,
        'location' => RegionId::HOENN,
        'level'    => 40,
        'unlock'   => 330,
    ],
    [
        'pokemon'  => PokedexNo::LATIOS,
        'location' => RegionId::HOENN,
        'level'    => 40,
        'unlock'   => 350,
    ],
    [
        'pokemon'  => PokedexNo::KYOGRE,
        'location' => LocationId::CAVE_OF_ORIGIN,
        'level'    => 45,
        'unlock'   => 370,
    ],
    [
        'pokemon'  => PokedexNo::GROUDON,
        'location' => LocationId::MAGMA_HIDEOUT_6F,
        'level'    => 45,
        'unlock'   => 390,
    ],
    [
        'pokemon'  => PokedexNo::RAYQUAZA,
        'location' => LocationId::SKY_PILLAR_APEX,
        'level'    => 70,
        'unlock'   => 410,
    ],
    [
        'pokemon'  => PokedexNo::JIRACHI,
        'location' => LocationId::LITTLEROOT_TOWN,
        'level'    => 5,
        'unlock'   => RegionId::HOENN,
    ],
    [
        'pokemon'  => PokedexNo::DEOXYS,
        'location' => LocationId::MOSSDEEP_SPACE_CENTER,
        'level'    => 70,
        'unlock'   => RegionId::HOENN,
    ],
];
