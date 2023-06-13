<?php
declare(strict_types=1);

use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

return [
    [
        'pokemon' => PokedexNo::ARTICUNO,
        'location' => LocationId::SEAFOAM_ISLANDS_B4F,
        'level' => 50,
        'unlock' => 50,
    ],
    [
        'pokemon' => PokedexNo::ZAPDOS,
        'location' => LocationId::POWER_PLANT,
        'level' => 50,
        'unlock' => 75,
    ],
    [
        'pokemon' => PokedexNo::MOLTRES,
        'location' => LocationId::MT_EMBER_SUMMIT,
        'level' => 50,
        'unlock' => 100,
    ],
    [
        'pokemon' => PokedexNo::MEWTWO,
        'location' => LocationId::CERULEAN_CAVE_B1F,
        'level' => 70,
        'unlock' => 125,
    ],
    [
        'pokemon' => PokedexNo::MEW,
        'location' => LocationId::VERMILLION_HARBOUR,
        'level' => 10,
        'unlock' => RegionId::KANTO,
    ],
    [
        'pokemon' => PokedexNo::RAIKOU,
        'location' => RegionId::JOHTO,
        'level' => 40,
        'unlock' => 150,
    ],
    [
        'pokemon' => PokedexNo::ENTEI,
        'location' => RegionId::JOHTO,
        'level' => 40,
        'unlock' => 175,
    ],
    [
        'pokemon' => PokedexNo::SUICUNE,
        'location' => RegionId::JOHTO,
        'level' => 40,
        'unlock' => 200,
    ],
    [
        'pokemon' => PokedexNo::LUGIA,
        'location' => LocationId::WHIRL_ISLANDS_B3F,
        'level' => 70,
        'unlock' => 225,
    ],
    [
        'pokemon' => PokedexNo::HO_OH,
        'location' => LocationId::BELL_TOWER_ROOF,
        'level' => 70,
        'unlock' => 250,
    ],
    [
        'pokemon' => PokedexNo::CELEBI,
        'location' => LocationId::ILEX_FOREST,
        'level' => 30,
        'unlock' => RegionId::JOHTO,
    ],
];
