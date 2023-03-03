<?php
declare(strict_types=1);

use ConorSmith\Pokemon\Direction;
use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\LocationType;
use ConorSmith\Pokemon\PokedexNo;

return [
    [
        'id' => LocationId::PALLET_TOWN,
        'name' => "Pallet Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_1,
            Direction::S => LocationId::ROUTE_21,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 1,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SHELLDER => [
                    'weight' => 40,
                    'levels' => [15, 25],
                ],
                PokedexNo::STARYU => [
                    'weight' => 40,
                    'levels' => [15, 25],
                ],
                PokedexNo::KINGLER => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::SEADRA => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_1,
        'name' => "Route 1",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::VIRIDIAN_CITY,
            Direction::S => LocationId::PALLET_TOWN,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 1,
                'levels' => [2, 5],
            ],
            PokedexNo::RATTATA => [
                'weight' => 1,
                'levels' => [2, 4],
            ],
        ],
    ],
    [
        'id' => LocationId::VIRIDIAN_CITY,
        'name' => "Viridian City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_2,
            Direction::W => LocationId::ROUTE_22,
            LocationId::VIRIDIAN_GYM,
            Direction::S => LocationId::ROUTE_1,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::POLIWHIRL => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::VIRIDIAN_GYM,
        'name' => "Viridian Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::VIRIDIAN_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_2,
        'name' => "Route 2",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::PEWTER_CITY,
            LocationId::VIRIDIAN_FOREST,
            LocationId::DIGLETTS_CAVE,
            Direction::S => LocationId::VIRIDIAN_CITY,
        ],
        'pokemon' => [
            PokedexNo::CATERPIE => [
                'weight' => 5,
                'levels' => [4, 5],
            ],
            PokedexNo::WEEDLE => [
                'weight' => 5,
                'levels' => [4, 5],
            ],
            PokedexNo::PIDGEY => [
                'weight' => 45,
                'levels' => [2, 5],
            ],
            PokedexNo::RATTATA => [
                'weight' => 45,
                'levels' => [2, 5],
            ],
        ],
    ],
    [
        'id' => LocationId::PEWTER_CITY,
        'name' => "Pewter City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_3,
            LocationId::PEWTER_GYM,
            Direction::S => LocationId::ROUTE_2,
        ],
    ],
    [
        'id' => LocationId::PEWTER_GYM,
        'name' => "Pewter Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::PEWTER_CITY,
        ],
        'pokemon' => [],
    ],
    [
        'id' => LocationId::VIRIDIAN_FOREST,
        'name' => "Viridian Forest",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_2,
        ],
        'pokemon' => [
            PokedexNo::CATERPIE => [
                'weight' => 45,
                'levels' => [3, 5],
            ],
            PokedexNo::METAPOD => [
                'weight' => 5,
                'levels' => [4, 6],
            ],
            PokedexNo::WEEDLE => [
                'weight' => 45,
                'levels' => [3, 5],
            ],
            PokedexNo::KAKUNA => [
                'weight' => 5,
                'levels' => [4, 6],
            ],
            PokedexNo::PIKACHU => [
                'weight' => 5,
                'levels' => [3, 5],
            ],
        ],
    ],
    [
        'id' => LocationId::DIGLETTS_CAVE,
        'name' => "Diglett's Cave",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_2,
            LocationId::ROUTE_11,
        ],
        'pokemon' => [
            PokedexNo::DIGLETT => [
                'weight' => 95,
                'levels' => [15, 22],
            ],
            PokedexNo::DUGTRIO => [
                'weight' => 5,
                'levels' => [29, 31],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_3,
        'name' => "Route 3",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::PEWTER_CITY,
            Direction::E => LocationId::MT_MOON_F1,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 30,
                'levels' => [6, 7],
            ],
            PokedexNo::SPEAROW => [
                'weight' => 35,
                'levels' => [6, 8],
            ],
            PokedexNo::NIDORAN_M => [
                'weight' => 15,
                'levels' => [6, 7],
            ],
            PokedexNo::NIDORAN_F => [
                'weight' => 15,
                'levels' => [6, 7],
            ],
            PokedexNo::JIGGLYPUFF => [
                'weight' => 10,
                'levels' => [3, 7],
            ],
            PokedexNo::MANKEY => [
                'weight' => 10,
                'levels' => 7,
            ],
        ],
    ],
    [
        'id' => LocationId::MT_MOON_F1,
        'name' => "Mt. Moon",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_3,
            Direction::D => LocationId::MT_MOON_BF1,
        ],
        'pokemon' => [
            PokedexNo::ZUBAT => [
                'weight' => 69,
                'levels' => [7, 10],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 25,
                'levels' => [7, 9],
            ],
            PokedexNo::PARAS => [
                'weight' => 5,
                'levels' => 8,
            ],
            PokedexNo::CLEFAIRY => [
                'weight' => 1,
                'levels' => 8,
            ],
        ],
    ],
    [
        'id' => LocationId::MT_MOON_BF1,
        'name' => "Mt. Moon",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::MT_MOON_F1,
            Direction::D => LocationId::MT_MOON_BF2,
        ],
        'pokemon' => [
            PokedexNo::PARAS => [
                'weight' => 100,
                'levels' => [5, 10],
            ],
        ],
    ],
    [
        'id' => LocationId::MT_MOON_BF2,
        'name' => "Mt. Moon",
        'section' => "2nd Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::MT_MOON_BF1,
            LocationId::ROUTE_4,
        ],
        'pokemon' => [
            PokedexNo::ZUBAT => [
                'weight' => 49,
                'levels' => [8, 11],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 30,
                'levels' => [9, 10],
            ],
            PokedexNo::PARAS => [
                'weight' => 15,
                'levels' => [10, 12],
            ],
            PokedexNo::CLEFAIRY => [
                'weight' => 6,
                'levels' => [10, 12],
            ],
            PokedexNo::CHARMANDER => [
                'weight' => 5,
                'levels' => [7, 10],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_4,
        'name' => "Route 4",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::MT_MOON_BF2,
            Direction::E => LocationId::CERULEAN_CITY,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::RATTATA => [
                    'weight' => 35,
                    'levels' => [8, 12],
                ],
                PokedexNo::SPEAROW => [
                    'weight' => 35,
                    'levels' => [8, 12],
                ],
                PokedexNo::EKANS => [
                    'weight' => 25,
                    'levels' => [6, 12],
                ],
                PokedexNo::SANDSHREW => [
                    'weight' => 25,
                    'levels' => [6, 12],
                ],
                PokedexNo::MANKEY => [
                    'weight' => 5,
                    'levels' => [10, 12],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::CERULEAN_CITY,
        'name' => "Cerulean City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_24,
            Direction::W => LocationId::ROUTE_4,
            Direction::E => LocationId::ROUTE_9,
            Direction::S => LocationId::ROUTE_5,
            LocationId::CERULEAN_GYM,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::CERULEAN_GYM,
        'name' => "Cerulean Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::CERULEAN_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_5,
        'name' => "Route 5",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::CERULEAN_CITY,
            Direction::S => LocationId::SAFFRON_CITY,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 40,
                'levels' => [13, 16],
            ],
            PokedexNo::MEOWTH => [
                'weight' => 35,
                'levels' => [10, 16],
            ],
            PokedexNo::ODDISH => [
                'weight' => 25,
                'levels' => [13, 16],
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 25,
                'levels' => [13, 16],
            ],
        ],
    ],
    [
        'id' => LocationId::SAFFRON_CITY,
        'name' => "Saffron City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_5,
            Direction::W => LocationId::ROUTE_7,
            Direction::E => LocationId::ROUTE_8,
            Direction::S => LocationId::ROUTE_6,
            LocationId::SAFFRON_GYM,
            LocationId::SILPH_CO_1F,
        ],
    ],
    [
        'id' => LocationId::SAFFRON_GYM,
        'name' => "Saffron Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::SAFFRON_CITY,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_1F,
        'name' => "Silph Co",
        'section' => "1st Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_2F,
            LocationId::SAFFRON_CITY,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_2F,
        'name' => "Silph Co",
        'section' => "2nd Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_3F,
            Direction::D => LocationId::SILPH_CO_1F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_3F,
        'name' => "Silph Co",
        'section' => "3rd Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_4F,
            Direction::D => LocationId::SILPH_CO_2F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_4F,
        'name' => "Silph Co",
        'section' => "4th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_5F,
            Direction::D => LocationId::SILPH_CO_3F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_5F,
        'name' => "Silph Co",
        'section' => "5th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_6F,
            Direction::D => LocationId::SILPH_CO_4F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_6F,
        'name' => "Silph Co",
        'section' => "6th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_7F,
            Direction::D => LocationId::SILPH_CO_5F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_7F,
        'name' => "Silph Co",
        'section' => "7th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_8F,
            Direction::D => LocationId::SILPH_CO_6F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_8F,
        'name' => "Silph Co",
        'section' => "8th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_9F,
            Direction::D => LocationId::SILPH_CO_7F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_9F,
        'name' => "Silph Co",
        'section' => "9th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_10F,
            Direction::D => LocationId::SILPH_CO_8F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_10F,
        'name' => "Silph Co",
        'section' => "10th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_11F,
            Direction::D => LocationId::SILPH_CO_9F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_11F,
        'name' => "Silph Co",
        'section' => "11th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::D => LocationId::SILPH_CO_10F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_6,
        'name' => "Route 6",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::SAFFRON_CITY,
            Direction::S => LocationId::VERMILLION_CITY,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::PIDGEY => [
                    'weight' => 40,
                    'levels' => [13, 16],
                ],
                PokedexNo::MEOWTH => [
                    'weight' => 35,
                    'levels' => [10, 16],
                ],
                PokedexNo::ODDISH => [
                    'weight' => 25,
                    'levels' => [13, 16],
                ],
                PokedexNo::BELLSPROUT => [
                    'weight' => 25,
                    'levels' => [13, 16],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::POLIWHIRL => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::VERMILLION_CITY,
        'name' => "Vermillion City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_6,
            Direction::E => LocationId::ROUTE_11,
            LocationId::VERMILLION_GYM,
            LocationId::VERMILLION_HARBOUR,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 100,
                    'levels' => [5, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SHELLDER => [
                    'weight' => 40,
                    'levels' => [15, 25],
                ],
                PokedexNo::STARYU => [
                    'weight' => 40,
                    'levels' => [15, 25],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::VERMILLION_GYM,
        'name' => "Vermillion Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::VERMILLION_CITY,
        ],
    ],
    [
        'id' => LocationId::VERMILLION_HARBOUR,
        'name' => "Vermillion Harbour",
        'directions' => [
            LocationId::VERMILLION_CITY,
            LocationId::SS_ANNE_1F,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::SQUIRTLE => [
                    'weight' => 10,
                    'levels' => [10, 14],
                ],
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 104,
                    'levels' => [5, 35],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 104,
                    'levels' => [5, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SHELLDER => [
                    'weight' => 40,
                    'levels' => [15, 25],
                ],
                PokedexNo::STARYU => [
                    'weight' => 40,
                    'levels' => [15, 25],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::SS_ANNE_1F,
        'name' => "S.S. Anne",
        'section' => "1st Floor",
        'directions' => [
            LocationId::VERMILLION_HARBOUR,
            Direction::D => LocationId::SS_ANNE_B1F,
            Direction::U => LocationId::SS_ANNE_2F,
        ],
    ],
    [
        'id' => LocationId::SS_ANNE_B1F,
        'name' => "S.S. Anne",
        'section' => "Basement 1st Floor",
        'directions' => [
            Direction::U => LocationId::SS_ANNE_1F,
        ],
    ],
    [
        'id' => LocationId::SS_ANNE_2F,
        'name' => "S.S. Anne",
        'section' => "2nd Floor",
        'directions' => [
            Direction::D => LocationId::SS_ANNE_1F,
            Direction::U => LocationId::SS_ANNE_DECK,
        ],
    ],
    [
        'id' => LocationId::SS_ANNE_DECK,
        'name' => "S.S. Anne",
        'section' => "Deck",
        'directions' => [
            Direction::D => LocationId::SS_ANNE_2F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_7,
        'name' => "Route 7",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::CELADON_CITY,
            Direction::E => LocationId::SAFFRON_CITY,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 30,
                'levels' => [19, 22],
            ],
            PokedexNo::VULPIX => [
                'weight' => 10,
                'levels' => [18, 20],
            ],
            PokedexNo::ODDISH => [
                'weight' => 20,
                'levels' => [19, 22],
            ],
            PokedexNo::MEOWTH => [
                'weight' => 40,
                'levels' => [17, 20],
            ],
            PokedexNo::GROWLITHE => [
                'weight' => 10,
                'levels' => [18, 20],
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 20,
                'levels' => [19, 22],
            ],
        ],
    ],
    [
        'id' => LocationId::CELADON_CITY,
        'name' => "Celadon City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::W => LocationId::ROUTE_16,
            Direction::E => LocationId::ROUTE_7,
            LocationId::CELADON_GYM,
            LocationId::ROCKET_GAME_CORNER,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 99,
                    'levels' => [5, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 99,
                    'levels' => [5, 40],
                ],
                PokedexNo::KOFFING => [
                    'weight' => 2,
                    'levels' => [30, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 299,
                    'levels' => [5, 35],
                ],
                PokedexNo::GRIMER => [
                    'weight' => 1,
                    'levels' => [30, 40],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::CELADON_GYM,
        'name' => "Celadon Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::CELADON_CITY,
        ],
    ],
    [
        'id' => LocationId::ROCKET_GAME_CORNER,
        'name' => "Rocket Game Corner",
        'type' => LocationType::TOWER,
        'directions' => [
            LocationId::CELADON_CITY,
            Direction::D => LocationId::TEAM_ROCKET_HIDEOUT_B1F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HIDEOUT_B1F,
        'name' => "Team Rocket Hideout",
        'section' => "1st Basement Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::ROCKET_GAME_CORNER,
            Direction::D => LocationId::TEAM_ROCKET_HIDEOUT_B2F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HIDEOUT_B2F,
        'name' => "Team Rocket Hideout",
        'section' => "2nd Basement Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::TEAM_ROCKET_HIDEOUT_B1F,
            Direction::D => LocationId::TEAM_ROCKET_HIDEOUT_B3F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HIDEOUT_B3F,
        'name' => "Team Rocket Hideout",
        'section' => "3rd Basement Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::TEAM_ROCKET_HIDEOUT_B2F,
            Direction::D => LocationId::TEAM_ROCKET_HIDEOUT_B4F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HIDEOUT_B4F,
        'name' => "Team Rocket Hideout",
        'section' => "4th Basement Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::TEAM_ROCKET_HIDEOUT_B3F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_8,
        'name' => "Route 8",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::SAFFRON_CITY,
            Direction::E => LocationId::LAVENDER_TOWN,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 30,
                'levels' => [18, 20],
            ],
            PokedexNo::EKANS => [
                'weight' => 20,
                'levels' => [17, 19],
            ],
            PokedexNo::SANDSHREW => [
                'weight' => 20,
                'levels' => [17, 19],
            ],
            PokedexNo::VULPIX => [
                'weight' => 20,
                'levels' => [15, 18],
            ],
            PokedexNo::MEOWTH => [
                'weight' => 30,
                'levels' => [18, 20],
            ],
            PokedexNo::GROWLITHE => [
                'weight' => 20,
                'levels' => [15, 18],
            ],
        ],
    ],
    [
        'id' => LocationId::LAVENDER_TOWN,
        'name' => "Lavender Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_10,
            Direction::W => LocationId::ROUTE_8,
            Direction::S => LocationId::ROUTE_12,
            LocationId::POKEMON_TOWER_1F,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_1F,
        'name' => "Pokémon Tower",
        'section' => "1st Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_2F,
            LocationId::LAVENDER_TOWN,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_2F,
        'name' => "Pokémon Tower",
        'section' => "2nd Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_3F,
            Direction::D => LocationId::POKEMON_TOWER_1F,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_3F,
        'name' => "Pokémon Tower",
        'section' => "3rd Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_4F,
            Direction::D => LocationId::POKEMON_TOWER_2F,
        ],
        'pokemon' => [
            PokedexNo::GASTLY => [
                'weight' => 90,
                'levels' => [13, 19],
            ],
            PokedexNo::HAUNTER => [
                'weight' => 1,
                'levels' => 20,
            ],
            PokedexNo::CUBONE => [
                'weight' => 9,
                'levels' => [15, 17],
            ],
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_4F,
        'name' => "Pokémon Tower",
        'section' => "4th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_5F,
            Direction::D => LocationId::POKEMON_TOWER_3F,
        ],
        'pokemon' => [
            PokedexNo::GASTLY => [
                'weight' => 86,
                'levels' => [13, 19],
            ],
            PokedexNo::HAUNTER => [
                'weight' => 5,
                'levels' => 20,
            ],
            PokedexNo::CUBONE => [
                'weight' => 9,
                'levels' => [15, 17],
            ],
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_5F,
        'name' => "Pokémon Tower",
        'section' => "5th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_6F,
            Direction::D => LocationId::POKEMON_TOWER_4F,
        ],
        'pokemon' => [
            PokedexNo::GASTLY => [
                'weight' => 86,
                'levels' => [13, 19],
            ],
            PokedexNo::HAUNTER => [
                'weight' => 5,
                'levels' => 20,
            ],
            PokedexNo::CUBONE => [
                'weight' => 9,
                'levels' => [15, 17],
            ],
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_6F,
        'name' => "Pokémon Tower",
        'section' => "6th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_7F,
            Direction::D => LocationId::POKEMON_TOWER_5F,
        ],
        'pokemon' => [
            PokedexNo::GASTLY => [
                'weight' => 85,
                'levels' => [14, 19],
            ],
            PokedexNo::HAUNTER => [
                'weight' => 6,
                'levels' => [21, 23],
            ],
            PokedexNo::CUBONE => [
                'weight' => 9,
                'levels' => [17, 19],
            ],
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_7F,
        'name' => "Pokémon Tower",
        'section' => "7th Floor",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::D => LocationId::POKEMON_TOWER_6F,
        ],
        'pokemon' => [
            PokedexNo::GASTLY => [
                'weight' => 75,
                'levels' => [15, 19],
            ],
            PokedexNo::HAUNTER => [
                'weight' => 15,
                'levels' => [23, 25],
            ],
            PokedexNo::CUBONE => [
                'weight' => 10,
                'levels' => [17, 19],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_9,
        'name' => "Route 9",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::CERULEAN_CITY,
            Direction::S => LocationId::ROCK_TUNNEL_1F,
            LocationId::POWER_PLANT,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::RATTATA => [
                    'weight' => 40,
                    'levels' => [14, 17],
                ],
                PokedexNo::SPEAROW => [
                    'weight' => 35,
                    'levels' => [13, 17],
                ],
                PokedexNo::EKANS => [
                    'weight' => 25,
                    'levels' => [11, 17],
                ],
                PokedexNo::SANDSHREW => [
                    'weight' => 25,
                    'levels' => [11, 17],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::POWER_PLANT,
        'name' => "Power Plant",
        'type' => LocationType::TOWER,
        'directions' => [
            LocationId::ROUTE_9,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::PIKACHU => [
                    'weight' => 25,
                    'levels' => [22, 26],
                ],
                PokedexNo::MAGNEMITE => [
                    'weight' => 30,
                    'levels' => [22, 25],
                ],
                PokedexNo::MAGNETON => [
                    'weight' => 15,
                    'levels' => [31, 34],
                ],
                PokedexNo::VOLTORB => [
                    'weight' => 30,
                    'levels' => [22, 25],
                ],
                PokedexNo::ELECTABUZZ => [
                    'weight' => 5,
                    'levels' => [32, 35],
                ],
                PokedexNo::PORYGON => [
                    'weight' => 5,
                    'levels' => [30, 32],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROCK_TUNNEL_1F,
        'name' => "Rock Tunnel",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_9,
            Direction::D => LocationId::ROCK_TUNNEL_B1F,
            LocationId::ROUTE_10,
        ],
        'pokemon' => [
            PokedexNo::GEODUDE => [
                'weight' => 35,
                'levels' => [15, 17],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 30,
                'levels' => [15, 16],
            ],
            PokedexNo::MANKEY => [
                'weight' => 15,
                'levels' => [16, 17],
            ],
            PokedexNo::MACHOP => [
                'weight' => 15,
                'levels' => [16, 17],
            ],
            PokedexNo::ONIX => [
                'weight' => 5,
                'levels' => [13, 15],
            ],
            PokedexNo::HITMONCHAN => [
                'weight' => 1,
                'levels' => 20,
            ],
        ],
    ],
    [
        'id' => LocationId::ROCK_TUNNEL_B1F,
        'name' => "Rock Tunnel",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::ROCK_TUNNEL_1F,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::GEODUDE => [
                    'weight' => 35,
                    'levels' => [15, 17],
                ],
                PokedexNo::ZUBAT => [
                    'weight' => 30,
                    'levels' => [15, 16],
                ],
                PokedexNo::MANKEY => [
                    'weight' => 15,
                    'levels' => [16, 17],
                ],
                PokedexNo::MACHOP => [
                    'weight' => 10,
                    'levels' => 17,
                ],
                PokedexNo::ONIX => [
                    'weight' => 10,
                    'levels' => [13, 17],
                ],
                PokedexNo::HITMONLEE => [
                    'weight' => 1,
                    'levels' => 20,
                ],
            ],
            EncounterType::ROCK_SMASH => [
                PokedexNo::GEODUDE => [
                    'weight' => 90,
                    'levels' => [5, 30],
                ],
                PokedexNo::GRAVELER => [
                    'weight' => 10,
                    'levels' => [25, 40],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_10,
        'name' => "Route 10",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROCK_TUNNEL_1F,
            Direction::S => LocationId::LAVENDER_TOWN,
        ],
        'pokemon' => [
            PokedexNo::SPEAROW => [
                'weight' => 35,
                'levels' => [13, 17],
            ],
            PokedexNo::EKANS => [
                'weight' => 25,
                'levels' => [11, 17],
            ],
            PokedexNo::SANDSHREW => [
                'weight' => 25,
                'levels' => [11, 17],
            ],
            PokedexNo::VOLTORB => [
                'weight' => 40,
                'levels' => [14, 17],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_11,
        'name' => "Route 11",
        'type' => LocationType::ROUTE,
        'directions' => [
            LocationId::DIGLETTS_CAVE,
            Direction::W => LocationId::VERMILLION_CITY,
            Direction::E => LocationId::ROUTE_12,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::SPEAROW => [
                    'weight' => 35,
                    'levels' => [13, 17],
                ],
                PokedexNo::EKANS => [
                    'weight' => 40,
                    'levels' => [12, 15],
                ],
                PokedexNo::SANDSHREW => [
                    'weight' => 40,
                    'levels' => [12, 15],
                ],
                PokedexNo::DROWZEE => [
                    'weight' => 25,
                    'levels' => [11, 15],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_12,
        'name' => "Route 12",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::LAVENDER_TOWN,
            Direction::W => LocationId::ROUTE_11,
            Direction::S => LocationId::ROUTE_13,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::PIDGEY => [
                    'weight' => 30,
                    'levels' => [23, 27],
                ],
                PokedexNo::ODDISH => [
                    'weight' => 35,
                    'levels' => [22, 26],
                ],
                PokedexNo::GLOOM => [
                    'weight' => 5,
                    'levels' => [28, 30],
                ],
                PokedexNo::VENONAT => [
                    'weight' => 30,
                    'levels' => [24, 26],
                ],
                PokedexNo::BELLSPROUT => [
                    'weight' => 35,
                    'levels' => [22, 26],
                ],
                PokedexNo::WEEPINBELL => [
                    'weight' => 5,
                    'levels' => [28, 30],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_13,
        'name' => "Route 13",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::ROUTE_14,
            Direction::N => LocationId::ROUTE_12,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::PIDGEY => [
                    'weight' => 20,
                    'levels' => [25, 27],
                ],
                PokedexNo::PIDGEOTTO => [
                    'weight' => 5,
                    'levels' => 29,
                ],
                PokedexNo::ODDISH => [
                    'weight' => 35,
                    'levels' => [22, 26],
                ],
                PokedexNo::GLOOM => [
                    'weight' => 5,
                    'levels' => [28, 30],
                ],
                PokedexNo::VENONAT => [
                    'weight' => 30,
                    'levels' => [24, 26],
                ],
                PokedexNo::BELLSPROUT => [
                    'weight' => 35,
                    'levels' => [22, 26],
                ],
                PokedexNo::WEEPINBELL => [
                    'weight' => 5,
                    'levels' => [28, 30],
                ],
                PokedexNo::DITTO => [
                    'weight' => 5,
                    'levels' => 25,
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_14,
        'name' => "Route 14",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_13,
            Direction::S => LocationId::ROUTE_15,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 10,
                'levels' => 27,
            ],
            PokedexNo::PIDGEOTTO => [
                'weight' => 5,
                'levels' => 29,
            ],
            PokedexNo::ODDISH => [
                'weight' => 35,
                'levels' => [22, 26],
            ],
            PokedexNo::GLOOM => [
                'weight' => 5,
                'levels' => 30,
            ],
            PokedexNo::VENONAT => [
                'weight' => 30,
                'levels' => [24, 26],
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 35,
                'levels' => [22, 26],
            ],
            PokedexNo::WEEPINBELL => [
                'weight' => 5,
                'levels' => 30,
            ],
            PokedexNo::DITTO => [
                'weight' => 15,
                'levels' => 23,
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_15,
        'name' => "Route 15",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::FUCHSIA_CITY,
            Direction::N => LocationId::ROUTE_14,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 20,
                'levels' => [25, 27],
            ],
            PokedexNo::PIDGEOTTO => [
                'weight' => 5,
                'levels' => 29,
            ],
            PokedexNo::ODDISH => [
                'weight' => 35,
                'levels' => [22, 26],
            ],
            PokedexNo::GLOOM => [
                'weight' => 5,
                'levels' => [28, 30],
            ],
            PokedexNo::VENONAT => [
                'weight' => 30,
                'levels' => [24, 26],
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 35,
                'levels' => [22, 26],
            ],
            PokedexNo::WEEPINBELL => [
                'weight' => 5,
                'levels' => [28, 30],
            ],
            PokedexNo::DITTO => [
                'weight' => 5,
                'levels' => 25,
            ],
            PokedexNo::FARFETCHD => [
                'weight' => 25,
                'levels' => [20, 30],
            ],
        ],
    ],
    [
        'id' => LocationId::FUCHSIA_CITY,
        'name' => "Fuchsia City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::SAFARI_ZONE_S,
            Direction::W => LocationId::ROUTE_18,
            Direction::E => LocationId::ROUTE_15,
            Direction::S => LocationId::ROUTE_19,
            LocationId::FUCHSIA_GYM,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 60,
                    'levels' => [5, 15],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 60,
                    'levels' => [5, 25],
                ],
                PokedexNo::SEAKING => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::FUCHSIA_GYM,
        'name' => "Fuchsia Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::FUCHSIA_CITY,
        ],
    ],
    [
        'id' => LocationId::SAFARI_ZONE_S,
        'name' => "Safari Zone",
        'section' => "South",
        'directions' => [
            Direction::N => LocationId::SAFARI_ZONE_N,
            Direction::W => LocationId::SAFARI_ZONE_W,
            Direction::E => LocationId::SAFARI_ZONE_E,
            Direction::S => LocationId::FUCHSIA_CITY,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::NIDORAN_F => [
                    'weight' => 20,
                    'levels' => 22,
                ],
                PokedexNo::NIDORINA => [
                    'weight' => 20,
                    'levels' => 31,
                ],
                PokedexNo::NIDORAN_M => [
                    'weight' => 20,
                    'levels' => 22,
                ],
                PokedexNo::NIDORINO => [
                    'weight' => 20,
                    'levels' => 31,
                ],
                PokedexNo::PARASECT => [
                    'weight' => 5,
                    'levels' => 30,
                ],
                PokedexNo::VENONAT => [
                    'weight' => 15,
                    'levels' => 22,
                ],
                PokedexNo::EXEGGCUTE => [
                    'weight' => 20,
                    'levels' => [24, 25],
                ],
                PokedexNo::RHYHORN => [
                    'weight' => 20,
                    'levels' => 25,
                ],
                PokedexNo::CHANSEY => [
                    'weight' => 1,
                    'levels' => 23,
                ],
                PokedexNo::SCYTHER => [
                    'weight' => 4,
                    'levels' => 23,
                ],
                PokedexNo::PINSIR => [
                    'weight' => 4,
                    'levels' => 23,
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
                PokedexNo::SEAKING => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::DRATINI => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
                PokedexNo::DRAGONAIR => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::KABUTO => [
                    'weight' => 1,
                    'levels' => 30,
                ],
                PokedexNo::OMANYTE => [
                    'weight' => 1,
                    'levels' => 30,
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::SAFARI_ZONE_N,
        'name' => "Safari Zone",
        'section' => "North",
        'directions' => [
            Direction::W => LocationId::SAFARI_ZONE_W,
            Direction::E => LocationId::SAFARI_ZONE_E,
            Direction::S => LocationId::SAFARI_ZONE_S,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::NIDORAN_F => [
                    'weight' => 20,
                    'levels' => 30,
                ],
                PokedexNo::NIDORINA => [
                    'weight' => 10,
                    'levels' => 30,
                ],
                PokedexNo::NIDORAN_M => [
                    'weight' => 20,
                    'levels' => 30,
                ],
                PokedexNo::NIDORINO => [
                    'weight' => 10,
                    'levels' => 30,
                ],
                PokedexNo::PARAS => [
                    'weight' => 15,
                    'levels' => 23,
                ],
                PokedexNo::VENOMOTH => [
                    'weight' => 5,
                    'levels' => 32,
                ],
                PokedexNo::EXEGGCUTE => [
                    'weight' => 20,
                    'levels' => [25, 27],
                ],
                PokedexNo::RHYHORN => [
                    'weight' => 20,
                    'levels' => 26,
                ],
                PokedexNo::CHANSEY => [
                    'weight' => 4,
                    'levels' => 26,
                ],
                PokedexNo::TAUROS => [
                    'weight' => 1,
                    'levels' => 28,
                ],
                PokedexNo::LICKITUNG => [
                    'weight' => 1,
                    'levels' => [25, 28],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
                PokedexNo::SEAKING => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::DRATINI => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
                PokedexNo::DRAGONAIR => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::OMANYTE => [
                    'weight' => 5,
                    'levels' => 30,
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::SAFARI_ZONE_E,
        'name' => "Safari Zone",
        'section' => "East",
        'directions' => [
            Direction::N => LocationId::SAFARI_ZONE_N,
            Direction::S => LocationId::SAFARI_ZONE_S,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::NIDORAN_F => [
                    'weight' => 20,
                    'levels' => 24,
                ],
                PokedexNo::NIDORINA => [
                    'weight' => 10,
                    'levels' => 33,
                ],
                PokedexNo::NIDORAN_M => [
                    'weight' => 20,
                    'levels' => 24,
                ],
                PokedexNo::NIDORINO => [
                    'weight' => 10,
                    'levels' => 33,
                ],
                PokedexNo::PARAS => [
                    'weight' => 15,
                    'levels' => 22,
                ],
                PokedexNo::PARASECT => [
                    'weight' => 5,
                    'levels' => 25,
                ],
                PokedexNo::DODUO => [
                    'weight' => 20,
                    'levels' => 26,
                ],
                PokedexNo::EXEGGCUTE => [
                    'weight' => 20,
                    'levels' => [23, 25],
                ],
                PokedexNo::KANGASKHAN => [
                    'weight' => 4,
                    'levels' => 25,
                ],
                PokedexNo::SCYTHER => [
                    'weight' => 1,
                    'levels' => 28,
                ],
                PokedexNo::PINSIR => [
                    'weight' => 1,
                    'levels' => 28,
                ],
                PokedexNo::LICKITUNG => [
                    'weight' => 4,
                    'levels' => [25, 28],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
                PokedexNo::SEAKING => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::DRATINI => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
                PokedexNo::DRAGONAIR => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::KABUTO => [
                    'weight' => 5,
                    'levels' => 30,
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::SAFARI_ZONE_W,
        'name' => "Safari Zone",
        'section' => "West",
        'directions' => [
            Direction::N => LocationId::SAFARI_ZONE_N,
            Direction::S => LocationId::SAFARI_ZONE_S,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::NIDORAN_F => [
                    'weight' => 20,
                    'levels' => 22,
                ],
                PokedexNo::NIDORINA => [
                    'weight' => 10,
                    'levels' => 30,
                ],
                PokedexNo::NIDORAN_M => [
                    'weight' => 20,
                    'levels' => 22,
                ],
                PokedexNo::NIDORINO => [
                    'weight' => 10,
                    'levels' => 30,
                ],
                PokedexNo::VENONAT => [
                    'weight' => 15,
                    'levels' => 23,
                ],
                PokedexNo::VENOMOTH => [
                    'weight' => 5,
                    'levels' => 32,
                ],
                PokedexNo::DODUO => [
                    'weight' => 20,
                    'levels' => 26,
                ],
                PokedexNo::EXEGGCUTE => [
                    'weight' => 20,
                    'levels' => [25, 27],
                ],
                PokedexNo::KANGASKHAN => [
                    'weight' => 1,
                    'levels' => 28,
                ],
                PokedexNo::TAUROS => [
                    'weight' => 4,
                    'levels' => 25,
                ],
                PokedexNo::AERODACTYL => [
                    'weight' => 1,
                    'levels' => 30,
                ],
                PokedexNo::LICKITUNG => [
                    'weight' => 1,
                    'levels' => [25, 28],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
                PokedexNo::SEAKING => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::DRATINI => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
                PokedexNo::DRAGONAIR => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_16,
        'name' => "Route 16",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::CELADON_CITY,
            Direction::S => LocationId::ROUTE_17,
        ],
        'pokemon' => [
            PokedexNo::RATTATA => [
                'weight' => 30,
                'levels' => [18, 22],
            ],
            PokedexNo::RATICATE => [
                'weight' => 5,
                'levels' => [23, 25],
            ],
            PokedexNo::SPEAROW => [
                'weight' => 30,
                'levels' => [20, 22],
            ],
            PokedexNo::DODUO => [
                'weight' => 35,
                'levels' => [18, 22],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_17,
        'name' => "Route 17",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_16,
            Direction::S => LocationId::ROUTE_18,
        ],
        'pokemon' => [
            PokedexNo::RATTATA => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::RATICATE => [
                'weight' => 25,
                'levels' => [25, 29],
            ],
            PokedexNo::SPEAROW => [
                'weight' => 30,
                'levels' => [20, 22],
            ],
            PokedexNo::FEAROW => [
                'weight' => 5,
                'levels' => [25, 27],
            ],
            PokedexNo::DODUO => [
                'weight' => 35,
                'levels' => [24, 28],
            ],
            PokedexNo::EEVEE => [
                'weight' => 5,
                'levels' => [22, 25],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_18,
        'name' => "Route 18",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_17,
            Direction::E => LocationId::FUCHSIA_CITY,
        ],
        'pokemon' => [
            PokedexNo::RATTATA => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::RATICATE => [
                'weight' => 15,
                'levels' => [25, 29],
            ],
            PokedexNo::SPEAROW => [
                'weight' => 30,
                'levels' => [20, 22],
            ],
            PokedexNo::FEAROW => [
                'weight' => 15,
                'levels' => [25, 29],
            ],
            PokedexNo::DODUO => [
                'weight' => 35,
                'levels' => [24, 28],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_19,
        'name' => "Route 19",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::FUCHSIA_CITY,
            Direction::W => LocationId::ROUTE_20,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 140,
                    'levels' => [5, 25],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 140,
                    'levels' => [5, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::KINGLER => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::SEADRA => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_20,
        'name' => "Route 20",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::CINNABAR_ISLAND,
            LocationId::SEAFOAM_ISLANDS_1F,
            Direction::E => LocationId::ROUTE_19,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 140,
                    'levels' => [5, 25],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 140,
                    'levels' => [5, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::KINGLER => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::SEADRA => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_1F,
        'name' => "Seafoam Islands",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_20,
            Direction::D => LocationId::SEAFOAM_ISLANDS_B1F,
        ],
        'pokemon' => [
            PokedexNo::PSYDUCK => [
                'weight' => 55,
                'levels' => [26, 33],
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 55,
                'levels' => [26, 33],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 34,
                'levels' => [22, 26],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 11,
                'levels' => [26, 30],
            ],
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_B1F,
        'name' => "Seafoam Islands",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::SEAFOAM_ISLANDS_1F,
            Direction::D => LocationId::SEAFOAM_ISLANDS_B2F,
        ],
        'pokemon' => [
            PokedexNo::PSYDUCK => [
                'weight' => 40,
                'levels' => [29, 31],
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 40,
                'levels' => [29, 31],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 34,
                'levels' => [22, 26],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 11,
                'levels' => [26, 30],
            ],
            PokedexNo::SEEL => [
                'weight' => 10,
                'levels' => 28,
            ],
            PokedexNo::GOLDUCK => [
                'weight' => 5,
                'levels' => [33, 35],
            ],
            PokedexNo::SLOWBRO => [
                'weight' => 5,
                'levels' => [33, 35],
            ],
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_B2F,
        'name' => "Seafoam Islands",
        'section' => "2nd Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::SEAFOAM_ISLANDS_B1F,
            Direction::D => LocationId::SEAFOAM_ISLANDS_B3F,
        ],
        'pokemon' => [
            PokedexNo::PSYDUCK => [
                'weight' => 40,
                'levels' => [30, 32],
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 40,
                'levels' => [30, 32],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => [22, 24],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 10,
                'levels' => [26, 30],
            ],
            PokedexNo::SEEL => [
                'weight' => 20,
                'levels' => [30, 32],
            ],
            PokedexNo::GOLDUCK => [
                'weight' => 10,
                'levels' => [32, 34],
            ],
            PokedexNo::SLOWBRO => [
                'weight' => 10,
                'levels' => [32, 34],
            ],
            PokedexNo::JYNX => [
                'weight' => 1,
                'levels' => [32, 34],
            ],
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_B3F,
        'name' => "Seafoam Islands",
        'section' => "3rd Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::SEAFOAM_ISLANDS_B2F,
            Direction::D => LocationId::SEAFOAM_ISLANDS_B4F,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 20,
                    'levels' => [30, 32],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 20,
                    'levels' => [30, 32],
                ],
                PokedexNo::ZUBAT => [
                    'weight' => 10,
                    'levels' => 24,
                ],
                PokedexNo::GOLBAT => [
                    'weight' => 10,
                    'levels' => [26, 30],
                ],
                PokedexNo::SEEL => [
                    'weight' => 40,
                    'levels' => [30, 32],
                ],
                PokedexNo::GOLDUCK => [
                    'weight' => 15,
                    'levels' => [32, 34],
                ],
                PokedexNo::SLOWBRO => [
                    'weight' => 15,
                    'levels' => [32, 34],
                ],
                PokedexNo::DEWGONG => [
                    'weight' => 5,
                    'levels' => [32, 34],
                ],
                PokedexNo::JYNX => [
                    'weight' => 5,
                    'levels' => [32, 34],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::SEEL => [
                    'weight' => 60,
                    'levels' => [25, 35],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 30,
                    'levels' => [25, 30],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 30,
                    'levels' => [25, 30],
                ],
                PokedexNo::DEWGONG => [
                    'weight' => 5,
                    'levels' => [35, 40],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 4,
                    'levels' => [30, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 4,
                    'levels' => [30, 40],
                ],
                PokedexNo::GOLDUCK => [
                    'weight' => 1,
                    'levels' => [35, 40],
                ],
                PokedexNo::SLOWBRO => [
                    'weight' => 1,
                    'levels' => [35, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 140,
                    'levels' => [5, 30],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 140,
                    'levels' => [5, 30],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 16,
                    'levels' => [15, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 4,
                    'levels' => [15, 25],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 4,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_B4F,
        'name' => "Seafoam Islands",
        'section' => "4th Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::SEAFOAM_ISLANDS_B3F,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 10,
                    'levels' => 32,
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 10,
                    'levels' => 32,
                ],
                PokedexNo::GOLBAT => [
                    'weight' => 15,
                    'levels' => [26, 30],
                ],
                PokedexNo::SEEL => [
                    'weight' => 50,
                    'levels' => [30, 34],
                ],
                PokedexNo::GOLDUCK => [
                    'weight' => 15,
                    'levels' => [32, 34],
                ],
                PokedexNo::SLOWBRO => [
                    'weight' => 15,
                    'levels' => [32, 34],
                ],
                PokedexNo::DEWGONG => [
                    'weight' => 10,
                    'levels' => [34, 36],
                ],
                PokedexNo::JYNX => [
                    'weight' => 5,
                    'levels' => [32, 34],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::SEEL => [
                    'weight' => 60,
                    'levels' => [25, 35],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 30,
                    'levels' => [25, 30],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 30,
                    'levels' => [25, 30],
                ],
                PokedexNo::DEWGONG => [
                    'weight' => 5,
                    'levels' => [35, 40],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 4,
                    'levels' => [30, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 4,
                    'levels' => [30, 40],
                ],
                PokedexNo::GOLDUCK => [
                    'weight' => 1,
                    'levels' => [35, 40],
                ],
                PokedexNo::SLOWBRO => [
                    'weight' => 1,
                    'levels' => [35, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 140,
                    'levels' => [5, 30],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 140,
                    'levels' => [5, 30],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 16,
                    'levels' => [15, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 4,
                    'levels' => [15, 25],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 4,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::CINNABAR_ISLAND,
        'name' => "Cinnabar Island",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_21,
            LocationId::POKEMON_MANSION,
            LocationId::CINNABAR_GYM,
            Direction::E => LocationId::ROUTE_20,
        ],
        'pokemon' => [
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::SHELLDER => [
                    'weight' => 40,
                    'levels' => [15, 25],
                ],
                PokedexNo::STARYU => [
                    'weight' => 40,
                    'levels' => [15, 25],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
                PokedexNo::SEADRA => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWBRO => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
            ],
        ]
    ],
    [
        'id' => LocationId::CINNABAR_GYM,
        'name' => "Cinnabar Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::CINNABAR_ISLAND,
        ],
    ],
    [
        'id' => LocationId::POKEMON_MANSION,
        'name' => "Pokémon Mansion",
        'type' => LocationType::TOWER,
        'directions' => [
            LocationId::CINNABAR_ISLAND,
        ],
        'pokemon' => [
            PokedexNo::RATTATA => [
                'weight' => 15,
                'levels' => [26, 28],
            ],
            PokedexNo::RATICATE => [
                'weight' => 30,
                'levels' => [32, 36],
            ],
            PokedexNo::VULPIX => [
                'weight' => 15,
                'levels' => [30, 32],
            ],
            PokedexNo::GROWLITHE => [
                'weight' => 15,
                'levels' => [30, 32],
            ],
            PokedexNo::GRIMER => [
                'weight' => 30,
                'levels' => [28, 30],
            ],
            PokedexNo::MUK => [
                'weight' => 5,
                'levels' => 32,
            ],
            PokedexNo::KOFFING => [
                'weight' => 30,
                'levels' => [28, 30],
            ],
            PokedexNo::WEEZING => [
                'weight' => 5,
                'levels' => 32,
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_21,
        'name' => "Route 21",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::PALLET_TOWN,
            Direction::S => LocationId::CINNABAR_ISLAND,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::TANGELA => [
                    'weight' => 90,
                    'levels' => [17, 28],
                ],
                PokedexNo::MRMIME => [
                    'weight' => 10,
                    'levels' => [28, 32],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 1,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 140,
                    'levels' => [5, 25],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 140,
                    'levels' => [5, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::KINGLER => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::SEADRA => [
                    'weight' => 4,
                    'levels' => [25, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_22,
        'name' => "Route 22",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::VICTORY_ROAD_1F,
            Direction::E => LocationId::VIRIDIAN_CITY,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::RATTATA => [
                    'weight' => 45,
                    'levels' => [2, 5],
                ],
                PokedexNo::SPEAROW => [
                    'weight' => 10,
                    'levels' => [3, 5],
                ],
                PokedexNo::MANKEY => [
                    'weight' => 45,
                    'levels' => [2, 5],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::POLIWHIRL => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::VICTORY_ROAD_1F,
        'name' => "Victory Road",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::VICTORY_ROAD_2F,
            LocationId::ROUTE_22,
        ],
        'pokemon' => [
            PokedexNo::ARBOK => [
                'weight' => 5,
                'levels' => 44,
            ],
            PokedexNo::SANDSLASH => [
                'weight' => 5,
                'levels' => 44,
            ],
            PokedexNo::ZUBAT => [
                'weight' => 10,
                'levels' => 32,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 5,
                'levels' => 44,
            ],
            PokedexNo::MACHOP => [
                'weight' => 20,
                'levels' => 32,
            ],
            PokedexNo::MACHOKE => [
                'weight' => 5,
                'levels' => [44, 46],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 20,
                'levels' => 32,
            ],
            PokedexNo::ONIX => [
                'weight' => 30,
                'levels' => [40, 46],
            ],
            PokedexNo::MAROWAK => [
                'weight' => 5,
                'levels' => [44, 46],
            ],
        ],
    ],
    [
        'id' => LocationId::VICTORY_ROAD_2F,
        'name' => "Victory Road",
        'section' => "2nd Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::D => LocationId::VICTORY_ROAD_1F,
            Direction::U => LocationId::VICTORY_ROAD_3F,
        ],
        'pokemon' => [
            PokedexNo::ARBOK => [
                'weight' => 5,
                'levels' => 46,
            ],
            PokedexNo::SANDSLASH => [
                'weight' => 5,
                'levels' => 46,
            ],
            PokedexNo::ZUBAT => [
                'weight' => 10,
                'levels' => 34,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 5,
                'levels' => 46,
            ],
            PokedexNo::PRIMEAPE => [
                'weight' => 10,
                'levels' => 42,
            ],
            PokedexNo::MACHOP => [
                'weight' => 20,
                'levels' => 34,
            ],
            PokedexNo::MACHOKE => [
                'weight' => 5,
                'levels' => [46, 48],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 20,
                'levels' => 34,
            ],
            PokedexNo::ONIX => [
                'weight' => 20,
                'levels' => [45, 48],
            ],
            PokedexNo::MAROWAK => [
                'weight' => 5,
                'levels' => [46, 48],
            ],
        ],
    ],
    [
        'id' => LocationId::VICTORY_ROAD_3F,
        'name' => "Victory Road",
        'section' => "3rd Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_23,
            Direction::D => LocationId::VICTORY_ROAD_2F,
        ],
        'pokemon' => [
            PokedexNo::ARBOK => [
                'weight' => 5,
                'levels' => 44,
            ],
            PokedexNo::SANDSLASH => [
                'weight' => 5,
                'levels' => 44,
            ],
            PokedexNo::ZUBAT => [
                'weight' => 10,
                'levels' => 32,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 5,
                'levels' => 44,
            ],
            PokedexNo::MACHOP => [
                'weight' => 20,
                'levels' => 32,
            ],
            PokedexNo::MACHOKE => [
                'weight' => 5,
                'levels' => [44, 46],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 20,
                'levels' => 32,
            ],
            PokedexNo::ONIX => [
                'weight' => 30,
                'levels' => [40, 46],
            ],
            PokedexNo::MAROWAK => [
                'weight' => 5,
                'levels' => [44, 46],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_23,
        'name' => "Route 23",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::INDIGO_PLATEAU,
            Direction::S => LocationId::VICTORY_ROAD_3F,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::SPEAROW => [
                    'weight' => 15,
                    'levels' => [32, 34],
                ],
                PokedexNo::FEAROW => [
                    'weight' => 25,
                    'levels' => [40, 44],
                ],
                PokedexNo::EKANS => [
                    'weight' => 20,
                    'levels' => [32, 34],
                ],
                PokedexNo::ARBOK => [
                    'weight' => 5,
                    'levels' => 44,
                ],
                PokedexNo::SANDSHREW => [
                    'weight' => 20,
                    'levels' => [32, 34],
                ],
                PokedexNo::SANDSLASH => [
                    'weight' => 5,
                    'levels' => 44,
                ],
                PokedexNo::MANKEY => [
                    'weight' => 30,
                    'levels' => [32, 34],
                ],
                PokedexNo::PRIMEAPE => [
                    'weight' => 5,
                    'levels' => 42,
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::POLIWHIRL => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::INDIGO_PLATEAU,
        'name' => "Indigo Plateau",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::ROUTE_23,
        ],
    ],
    [
        'id' => LocationId::ROUTE_24,
        'name' => "Route 24",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_25,
            Direction::S => LocationId::CERULEAN_CITY,
            LocationId::CERULEAN_CAVE_1F,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::CATERPIE => [
                    'weight' => 20,
                    'levels' => 7,
                ],
                PokedexNo::METAPOD => [
                    'weight' => 5,
                    'levels' => 8,
                ],
                PokedexNo::WEEDLE => [
                    'weight' => 20,
                    'levels' => 7,
                ],
                PokedexNo::KAKUNA => [
                    'weight' => 5,
                    'levels' => 8,
                ],
                PokedexNo::PIDGEY => [
                    'weight' => 15,
                    'levels' => [11, 13],
                ],
                PokedexNo::ODDISH => [
                    'weight' => 25,
                    'levels' => [12, 14],
                ],
                PokedexNo::BELLSPROUT => [
                    'weight' => 25,
                    'levels' => [12, 14],
                ],
                PokedexNo::ABRA => [
                    'weight' => 15,
                    'levels' => [8, 12],
                ],
                PokedexNo::BULBASAUR => [
                    'weight' => 5,
                    'levels' => [7, 11],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::TENTACOOL => [
                    'weight' => 100,
                    'levels' => [5, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::HORSEA => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::KRABBY => [
                    'weight' => 144,
                    'levels' => [5, 35],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 1,
                    'levels' => [25, 35],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_25,
        'name' => "Route 25",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::ROUTE_24,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::CATERPIE => [
                    'weight' => 20,
                    'levels' => 8,
                ],
                PokedexNo::METAPOD => [
                    'weight' => 5,
                    'levels' => 9,
                ],
                PokedexNo::WEEDLE => [
                    'weight' => 20,
                    'levels' => 8,
                ],
                PokedexNo::KAKUNA => [
                    'weight' => 5,
                    'levels' => 9,
                ],
                PokedexNo::PIDGEY => [
                    'weight' => 15,
                    'levels' => [11, 13],
                ],
                PokedexNo::ODDISH => [
                    'weight' => 25,
                    'levels' => [12, 14],
                ],
                PokedexNo::BELLSPROUT => [
                    'weight' => 25,
                    'levels' => [12, 14],
                ],
                PokedexNo::ABRA => [
                    'weight' => 15,
                    'levels' => [9, 13],
                ],
                PokedexNo::BULBASAUR => [
                    'weight' => 5,
                    'levels' => [7, 11],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 100,
                    'levels' => [20, 40],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWHIRL => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::CERULEAN_CAVE_1F,
        'name' => "Cerulean Cave",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_24,
            Direction::U => LocationId::CERULEAN_CAVE_2F,
            Direction::D => LocationId::CERULEAN_CAVE_B1F,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::PARASECT => [
                    'weight' => 25,
                    'levels' => [49, 58],
                ],
                PokedexNo::MAGNETON => [
                    'weight' => 20,
                    'levels' => 49,
                ],
                PokedexNo::GOLBAT => [
                    'weight' => 14,
                    'levels' => [46, 55],
                ],
                PokedexNo::PRIMEAPE => [
                    'weight' => 11,
                    'levels' => [52, 61],
                ],
                PokedexNo::DITTO => [
                    'weight' => 11,
                    'levels' => [52, 61],
                ],
                PokedexNo::MACHOKE => [
                    'weight' => 10,
                    'levels' => 46,
                ],
                PokedexNo::ELECTRODE => [
                    'weight' => 5,
                    'levels' => 58,
                ],
                PokedexNo::SNORLAX => [
                    'weight' => 4,
                    'levels' => 55,
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 65,
                    'levels' => [30, 50],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 65,
                    'levels' => [30, 50],
                ],
                PokedexNo::GOLDUCK => [
                    'weight' => 35,
                    'levels' => [40, 55],
                ],
                PokedexNo::SLOWBRO => [
                    'weight' => 35,
                    'levels' => [40, 55],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWHIRL => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 15,
                    'levels' => [15, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 5,
                    'levels' => [15, 35],
                ],
            ],
            EncounterType::ROCK_SMASH => [
                PokedexNo::GEODUDE => [
                    'weight' => 65,
                    'levels' => [30, 50],
                ],
                PokedexNo::GRAVELER => [
                    'weight' => 35,
                    'levels' => [40, 55],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::CERULEAN_CAVE_2F,
        'name' => "Cerulean Cave",
        'section' => "2nd Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::D => LocationId::CERULEAN_CAVE_1F,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::PARASECT => [
                    'weight' => 14,
                    'levels' => [52, 61],
                ],
                PokedexNo::MAGNETON => [
                    'weight' => 10,
                    'levels' => 52,
                ],
                PokedexNo::GOLBAT => [
                    'weight' => 25,
                    'levels' => [49, 58],
                ],
                PokedexNo::DITTO => [
                    'weight' => 11,
                    'levels' => [55, 64],
                ],
                PokedexNo::MACHOKE => [
                    'weight' => 20,
                    'levels' => 49,
                ],
                PokedexNo::ELECTRODE => [
                    'weight' => 4,
                    'levels' => 61,
                ],
                PokedexNo::SNORLAX => [
                    'weight' => 5,
                    'levels' => 58,
                ],
                PokedexNo::KADABRA => [
                    'weight' => 11,
                    'levels' => [55, 64],
                ],
            ],
            EncounterType::ROCK_SMASH => [
                PokedexNo::GEODUDE => [
                    'weight' => 65,
                    'levels' => [30, 50],
                ],
                PokedexNo::GRAVELER => [
                    'weight' => 35,
                    'levels' => [40, 55],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::CERULEAN_CAVE_B1F,
        'name' => "Cerulean Cave",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::CERULEAN_CAVE_1F,
        ],
        'pokemon' => [
            EncounterType::WALKING => [
                PokedexNo::PARASECT => [
                    'weight' => 14,
                    'levels' => [55, 64],
                ],
                PokedexNo::MAGNETON => [
                    'weight' => 10,
                    'levels' => 55,
                ],
                PokedexNo::GOLBAT => [
                    'weight' => 11,
                    'levels' => [52, 61],
                ],
                PokedexNo::DITTO => [
                    'weight' => 25,
                    'levels' => [58, 67],
                ],
                PokedexNo::MACHOKE => [
                    'weight' => 10,
                    'levels' => 52,
                ],
                PokedexNo::ELECTRODE => [
                    'weight' => 4,
                    'levels' => 64,
                ],
                PokedexNo::SNORLAX => [
                    'weight' => 1,
                    'levels' => 61,
                ],
                PokedexNo::KADABRA => [
                    'weight' => 25,
                    'levels' => [58, 67],
                ],
            ],
            EncounterType::SURFING => [
                PokedexNo::PSYDUCK => [
                    'weight' => 65,
                    'levels' => [30, 50],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 65,
                    'levels' => [30, 50],
                ],
                PokedexNo::GOLDUCK => [
                    'weight' => 35,
                    'levels' => [40, 55],
                ],
                PokedexNo::SLOWBRO => [
                    'weight' => 35,
                    'levels' => [40, 55],
                ],
            ],
            EncounterType::FISHING => [
                PokedexNo::MAGIKARP => [
                    'weight' => 120,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWAG => [
                    'weight' => 100,
                    'levels' => [5, 25],
                ],
                PokedexNo::GOLDEEN => [
                    'weight' => 20,
                    'levels' => [5, 15],
                ],
                PokedexNo::POLIWHIRL => [
                    'weight' => 40,
                    'levels' => [20, 30],
                ],
                PokedexNo::GYARADOS => [
                    'weight' => 16,
                    'levels' => [15, 25],
                ],
                PokedexNo::PSYDUCK => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
                PokedexNo::SLOWPOKE => [
                    'weight' => 4,
                    'levels' => [15, 35],
                ],
            ],
            EncounterType::ROCK_SMASH => [
                PokedexNo::GEODUDE => [
                    'weight' => 65,
                    'levels' => [30, 50],
                ],
                PokedexNo::GRAVELER => [
                    'weight' => 35,
                    'levels' => [40, 55],
                ],
            ],
        ],
    ],
];
