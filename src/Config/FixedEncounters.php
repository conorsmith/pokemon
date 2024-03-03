<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

return [

    // KANTO
    [
        'id'       => "7ebee885-2d40-46cb-ab5e-2cd36fb97c59",
        'pokemon'  => PokedexNo::SNORLAX,
        'location' => LocationId::ROUTE_12,
        'level'    => 30,
    ],
    [
        'id'       => "50e89707-492d-4765-a7a7-9727c9f6224d",
        'pokemon'  => PokedexNo::SNORLAX,
        'location' => LocationId::ROUTE_16,
        'level'    => 30,
    ],
    [
        'id'       => "c023173f-d186-4ac4-9e50-70c0bbff5a4d",
        'pokemon'  => PokedexNo::ARTICUNO,
        'location' => LocationId::SEAFOAM_ISLANDS_B4F,
        'level'    => 50,
        'unlock'   => 50,
    ],
    [
        'id'       => "e92a1a17-d334-406e-9462-53afc9cac1d7",
        'pokemon'  => PokedexNo::ZAPDOS,
        'location' => LocationId::POWER_PLANT,
        'level'    => 50,
        'unlock'   => 75,
    ],
    [
        'id'       => "d02c0e33-5401-4d20-a4ca-3c2118612a62",
        'pokemon'  => PokedexNo::MOLTRES,
        'location' => LocationId::MT_EMBER_SUMMIT,
        'level'    => 50,
        'unlock'   => 100,
    ],
    [
        'id'       => "9a16926e-89e6-46fb-ac02-602bf9e5cfa9",
        'pokemon'  => PokedexNo::MEWTWO,
        'location' => LocationId::CERULEAN_CAVE_B1F,
        'level'    => 70,
        'unlock'   => 125,
    ],
    [
        'id'       => "53b9207b-ada0-4a7d-b3e3-aa2ae382bc34",
        'pokemon'  => PokedexNo::MEW,
        'location' => LocationId::VERMILLION_HARBOUR,
        'level'    => 10,
        'unlock'   => RegionId::KANTO,
    ],

    // JOHTO
    [
        'id'       => "7f10d3af-cda6-4263-8c4e-5898b0eeac67",
        'pokemon'  => PokedexNo::SUDOWOODO,
        'location' => LocationId::ROUTE_36,
        'level'    => 20,
    ],
    [
        'id'       => "f36e7835-51b1-4cf1-8e87-e82addcf0da0",
        'pokemon'  => PokedexNo::GYARADOS,
        'location' => LocationId::LAKE_OF_RAGE,
        'level'    => 30,
        'isShiny'  => true,
    ],
    [
        'id'       => "4d2f4db3-5ea8-4872-930e-eb0ce92f0176",
        'pokemon'  => PokedexNo::RAIKOU,
        'location' => RegionId::JOHTO,
        'level'    => 40,
        'unlock'   => 150,
    ],
    [
        'id'       => "79831df4-8763-4a23-9c19-da79625bffba",
        'pokemon'  => PokedexNo::ENTEI,
        'location' => RegionId::JOHTO,
        'level'    => 40,
        'unlock'   => 175,
    ],
    [
        'id'       => "3291d2ee-173c-4c2a-b1eb-78156bdd3550",
        'pokemon'  => PokedexNo::SUICUNE,
        'location' => RegionId::JOHTO,
        'level'    => 40,
        'unlock'   => 200,
    ],
    [
        'id'       => "f4b10fd9-af21-42a6-88ba-29b4fa0f78dc",
        'pokemon'  => PokedexNo::LUGIA,
        'location' => LocationId::WHIRL_ISLANDS_B3F,
        'level'    => 70,
        'unlock'   => 225,
    ],
    [
        'id'       => "50299135-90ba-4038-b6d1-186421a3bf00",
        'pokemon'  => PokedexNo::HO_OH,
        'location' => LocationId::BELL_TOWER_ROOF,
        'level'    => 70,
        'unlock'   => 250,
    ],
    [
        'id'       => "df42d926-1211-4492-83f0-2b6e9fbd2c03",
        'pokemon'  => PokedexNo::CELEBI,
        'location' => LocationId::ILEX_FOREST,
        'level'    => 30,
        'unlock'   => RegionId::JOHTO,
    ],

    // HOENN
    [
        'id'       => "25ba4875-8dec-4e63-9fda-3ae15deefb4d",
        'pokemon'  => PokedexNo::REGIROCK,
        'location' => LocationId::DESERT_RUINS,
        'level'    => 40,
        'unlock'   => 270,
    ],
    [
        'id'       => "2fc7deb2-e463-429e-957f-e12886d11893",
        'pokemon'  => PokedexNo::REGICE,
        'location' => LocationId::ISLAND_CAVE,
        'level'    => 40,
        'unlock'   => 290,
    ],
    [
        'id'       => "9328c4c2-373d-4f5a-b3a1-1517b1c6bf8a",
        'pokemon'  => PokedexNo::REGISTEEL,
        'location' => LocationId::ANCIENT_TOMB,
        'level'    => 40,
        'unlock'   => 310,
    ],
    [
        'id'       => "4d9dfc04-daa5-4f1a-83e5-278484caa5c0",
        'pokemon'  => PokedexNo::LATIAS,
        'location' => RegionId::HOENN,
        'level'    => 40,
        'unlock'   => 330,
    ],
    [
        'id'       => "088c80ee-b073-4c9e-a08b-c52fe0f85888",
        'pokemon'  => PokedexNo::LATIOS,
        'location' => RegionId::HOENN,
        'level'    => 40,
        'unlock'   => 350,
    ],
    [
        'id'       => "4ef71ad8-02e6-40d7-8d95-460be564247e",
        'pokemon'  => PokedexNo::KYOGRE,
        'location' => LocationId::CAVE_OF_ORIGIN,
        'level'    => 45,
        'unlock'   => 370,
    ],
    [
        'id'       => "27e147d2-7fb5-45d0-a13e-d0b9452f1457",
        'pokemon'  => PokedexNo::GROUDON,
        'location' => LocationId::MAGMA_HIDEOUT_6F,
        'level'    => 45,
        'unlock'   => 390,
    ],
    [
        'id'       => "b0324f04-407a-40c3-be80-7cfb2d43bb72",
        'pokemon'  => PokedexNo::RAYQUAZA,
        'location' => LocationId::SKY_PILLAR_APEX,
        'level'    => 70,
        'unlock'   => 410,
    ],
    [
        'id'       => "b85ec9fd-4a71-4d21-af42-558c86c1ac0d",
        'pokemon'  => PokedexNo::JIRACHI,
        'location' => LocationId::LITTLEROOT_TOWN,
        'level'    => 5,
        'unlock'   => RegionId::HOENN,
    ],
    [
        'id'       => "a7d4cced-8e23-4577-8b7d-ae27d0677df4",
        'pokemon'  => PokedexNo::DEOXYS,
        'location' => LocationId::MOSSDEEP_SPACE_CENTER,
        'level'    => 70,
        'unlock'   => RegionId::HOENN,
    ],

];
