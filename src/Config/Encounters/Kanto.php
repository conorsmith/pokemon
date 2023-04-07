<?php
declare(strict_types=1);

use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;

return [
    LocationId::PALLET_TOWN => [
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
    LocationId::ROUTE_1 => [
        EncounterType::WALKING => [
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
    LocationId::VIRIDIAN_CITY => [
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
    LocationId::ROUTE_2 => [
        EncounterType::WALKING => [
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
    LocationId::VIRIDIAN_FOREST => [
        EncounterType::WALKING => [
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
    LocationId::DIGLETTS_CAVE => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_3 => [
        EncounterType::WALKING => [
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
    LocationId::MT_MOON_F1 => [
        EncounterType::WALKING => [
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
    LocationId::MT_MOON_BF1 => [
        EncounterType::WALKING => [
            PokedexNo::PARAS => [
                'weight' => 100,
                'levels' => [5, 10],
            ],
        ],
    ],
    LocationId::MT_MOON_BF2 => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_4 => [
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
    LocationId::CERULEAN_CITY => [
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
    LocationId::ROUTE_5 => [
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
    ],
    LocationId::ROUTE_6 => [
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
    LocationId::VERMILLION_CITY => [
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
    LocationId::VERMILLION_HARBOUR => [
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
    LocationId::ROUTE_7 => [
        EncounterType::WALKING => [
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
    LocationId::CELADON_CITY => [
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
    LocationId::ROUTE_8 => [
        EncounterType::WALKING => [
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
    LocationId::POKEMON_TOWER_3F => [
        EncounterType::WALKING => [
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
    LocationId::POKEMON_TOWER_4F => [
        EncounterType::WALKING => [
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
    LocationId::POKEMON_TOWER_5F => [
        EncounterType::WALKING => [
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
    LocationId::POKEMON_TOWER_6F => [
        EncounterType::WALKING => [
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
    LocationId::POKEMON_TOWER_7F => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_9 => [
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
    LocationId::POWER_PLANT => [
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
    LocationId::ROCK_TUNNEL_1F => [
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
    LocationId::ROCK_TUNNEL_B1F => [
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
    LocationId::ROUTE_10 => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_11 => [
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
    LocationId::ROUTE_12 => [
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
    LocationId::ROUTE_13 => [
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
    LocationId::ROUTE_14 => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_15 => [
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
            PokedexNo::FARFETCH_D => [
                'weight' => 25,
                'levels' => [20, 30],
            ],
        ],
    ],
    LocationId::FUCHSIA_CITY => [
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
    LocationId::SAFARI_ZONE_S => [
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
    LocationId::SAFARI_ZONE_N => [
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
    LocationId::SAFARI_ZONE_E => [
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
    LocationId::SAFARI_ZONE_W => [
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
    LocationId::ROUTE_16 => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_17 => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_18 => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_19 => [
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
    LocationId::ROUTE_20 => [
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
    LocationId::SEAFOAM_ISLANDS_1F => [
        EncounterType::WALKING => [
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
    LocationId::SEAFOAM_ISLANDS_B1F => [
        EncounterType::WALKING => [
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
    LocationId::SEAFOAM_ISLANDS_B2F => [
        EncounterType::WALKING => [
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
    LocationId::SEAFOAM_ISLANDS_B3F => [
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
    LocationId::SEAFOAM_ISLANDS_B4F => [
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
    LocationId::CINNABAR_ISLAND => [
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
    ],
    LocationId::POKEMON_MANSION => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_21 => [
        EncounterType::WALKING => [
            PokedexNo::TANGELA => [
                'weight' => 90,
                'levels' => [17, 28],
            ],
            PokedexNo::MR_MIME => [
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
    LocationId::ROUTE_22 => [
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
    LocationId::VICTORY_ROAD_1F => [
        EncounterType::WALKING => [
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
    LocationId::VICTORY_ROAD_2F => [
        EncounterType::WALKING => [
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
    LocationId::VICTORY_ROAD_3F => [
        EncounterType::WALKING => [
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
    LocationId::ROUTE_23 => [
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
    LocationId::ROUTE_24 => [
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
    LocationId::ROUTE_25 => [
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
    LocationId::CERULEAN_CAVE_1F => [
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
    LocationId::CERULEAN_CAVE_2F => [
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
    LocationId::CERULEAN_CAVE_B1F => [
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
    LocationId::KNOT_ISLAND => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::TREASURE_BEACH => [
        EncounterType::WALKING => [
            PokedexNo::SPEAROW => [
                'weight' => 30,
                'levels' => [31, 32],
            ],
            PokedexNo::FEAROW => [
                'weight' => 20,
                'levels' => [36, 40],
            ],
            PokedexNo::MEOWTH => [
                'weight' => 10,
                'levels' => 31,
            ],
            PokedexNo::PERSIAN => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 31,
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 31,
            ],
            PokedexNo::TANGELA => [
                'weight' => 30,
                'levels' => [33, 35],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::KRABBY => [
                'weight' => 160,
                'levels' => [5, 25],
            ],
            PokedexNo::HORSEA => [
                'weight' => 160,
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
    LocationId::KINDLE_ROAD => [
        EncounterType::WALKING => [
            PokedexNo::SPEAROW => [
                'weight' => 25,
                'levels' => [30, 32],
            ],
            PokedexNo::FEAROW => [
                'weight' => 10,
                'levels' => 36,
            ],
            PokedexNo::MEOWTH => [
                'weight' => 10,
                'levels' => 31,
            ],
            PokedexNo::PERSIAN => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 34,
            ],
            PokedexNo::GEODUDE => [
                'weight' => 10,
                'levels' => 31,
            ],
            PokedexNo::PONYTA => [
                'weight' => 30,
                'levels' => [31, 34],
            ],
            PokedexNo::RAPIDASH => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 34,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::KRABBY => [
                'weight' => 160,
                'levels' => [5, 25],
            ],
            PokedexNo::HORSEA => [
                'weight' => 160,
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
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 95,
                'levels' => [5, 30],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 5,
                'levels' => [25, 40],
            ],
        ],
    ],
    LocationId::MT_EMBER_BASE => [
        EncounterType::WALKING => [
            PokedexNo::SPEAROW => [
                'weight' => 25,
                'levels' => [30, 32],
            ],
            PokedexNo::FEAROW => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::MACHOP => [
                'weight' => 10,
                'levels' => 35,
            ],
            PokedexNo::GEODUDE => [
                'weight' => 10,
                'levels' => 33,
            ],
            PokedexNo::PONYTA => [
                'weight' => 35,
                'levels' => [30, 36],
            ],
            PokedexNo::RAPIDASH => [
                'weight' => 5,
                'levels' => [39, 42],
            ],
            PokedexNo::MAGMAR => [
                'weight' => 5,
                'levels' => [38, 40],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 95,
                'levels' => [5, 30],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 5,
                'levels' => [25, 40],
            ],
        ],
    ],
    LocationId::MT_EMBER_SUMMIT_PATH_1 => [
        EncounterType::WALKING => [
            PokedexNo::MACHOP => [
                'weight' => 50,
                'levels' => [31, 39],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 50,
                'levels' => [29, 37],
            ],
        ],
    ],
    LocationId::MT_EMBER_SUMMIT_PATH_2 => [
        EncounterType::WALKING => [
            PokedexNo::MACHOP => [
                'weight' => 40,
                'levels' => [32, 36],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 40,
                'levels' => [30, 34],
            ],
            PokedexNo::MACHOKE => [
                'weight' => 20,
                'levels' => [38, 40],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 95,
                'levels' => [5, 30],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 5,
                'levels' => [25, 40],
            ],
        ],
    ],
    LocationId::MT_EMBER_SUMMIT_PATH_3 => [
        EncounterType::WALKING => [
            PokedexNo::MACHOP => [
                'weight' => 50,
                'levels' => [31, 39],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 50,
                'levels' => [29, 37],
            ],
        ],
    ],
    LocationId::MT_EMBER_SUMMIT => [
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 95,
                'levels' => [5, 30],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 5,
                'levels' => [25, 40],
            ],
        ],
    ],
    LocationId::MT_EMBER_1F => [
        EncounterType::WALKING => [
            PokedexNo::GEODUDE => [
                'weight' => 50,
                'levels' => [32, 40],
            ],
            PokedexNo::MACHOP => [
                'weight' => 40,
                'levels' => [34, 38],
            ],
            PokedexNo::MACHOKE => [
                'weight' => 10,
                'levels' => [40, 42],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 65,
                'levels' => [25, 40],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 35,
                'levels' => [30, 50],
            ],
        ],
    ],
    LocationId::MT_EMBER_B1F => [
        EncounterType::WALKING => [
            PokedexNo::GEODUDE => [
                'weight' => 70,
                'levels' => [34, 42],
            ],
            PokedexNo::SLUGMA => [
                'weight' => 30,
                'levels' => [24, 30],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 65,
                'levels' => [25, 40],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 35,
                'levels' => [30, 50],
            ],
        ],
    ],
    LocationId::MT_EMBER_B2F => [
        EncounterType::WALKING => [
            PokedexNo::SLUGMA => [
                'weight' => 60,
                'levels' => [22, 32],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 40,
                'levels' => [40, 44],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 65,
                'levels' => [25, 40],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 35,
                'levels' => [30, 50],
            ],
        ],
    ],
    LocationId::MT_EMBER_B3F => [
        EncounterType::WALKING => [
            PokedexNo::SLUGMA => [
                'weight' => 100,
                'levels' => [18, 36],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::SLUGMA => [
                'weight' => 90,
                'levels' => [15, 35],
            ],
            PokedexNo::MAGCARGO => [
                'weight' => 10,
                'levels' => [25, 45],
            ],
        ],
    ],
    LocationId::MT_EMBER_B4F => [
        EncounterType::WALKING => [
            PokedexNo::SLUGMA => [
                'weight' => 60,
                'levels' => [22, 32],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 40,
                'levels' => [40, 44],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 65,
                'levels' => [25, 40],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 35,
                'levels' => [30, 50],
            ],
        ],
    ],
    LocationId::MT_EMBER_B5F => [
        EncounterType::WALKING => [
            PokedexNo::GEODUDE => [
                'weight' => 70,
                'levels' => [34, 42],
            ],
            PokedexNo::SLUGMA => [
                'weight' => 30,
                'levels' => [24, 30],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 65,
                'levels' => [25, 40],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 35,
                'levels' => [30, 50],
            ],
        ],
    ],
    LocationId::CAPE_BRINK => [
        EncounterType::WALKING => [
            PokedexNo::SPEAROW => [
                'weight' => 20,
                'levels' => 31,
            ],
            PokedexNo::FEAROW => [
                'weight' => 10,
                'levels' => 36,
            ],
            PokedexNo::ODDISH => [
                'weight' => 30,
                'levels' => [30, 32],
            ],
            PokedexNo::GLOOM => [
                'weight' => 15,
                'levels' => [36, 38],
            ],
            PokedexNo::MEOWTH => [
                'weight' => 10,
                'levels' => 31,
            ],
            PokedexNo::PERSIAN => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 31,
            ],
            PokedexNo::GOLDUCK => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 30,
                'levels' => [30, 32],
            ],
            PokedexNo::WEEPINBELL => [
                'weight' => 15,
                'levels' => [36, 38],
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 31,
            ],
            PokedexNo::SLOWBRO => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::PSYDUCK => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::GOLDUCK => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::SLOWBRO => [
                'weight' => 5,
                'levels' => [35, 40],
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
    LocationId::KIN_ISLAND_PORT => [
        EncounterType::WALKING => [
            PokedexNo::DUNSPARCE => [
                'weight' => 100,
                'levels' => [5, 35],
            ],
        ],
    ],
    LocationId::BOND_BRIDGE => [
        EncounterType::WALKING => [
            PokedexNo::PIDGEY => [
                'weight' => 30,
                'levels' => [29, 32],
            ],
            PokedexNo::PIDGEOTTO => [
                'weight' => 15,
                'levels' => [34, 40],
            ],
            PokedexNo::ODDISH => [
                'weight' => 20,
                'levels' => 31,
            ],
            PokedexNo::GLOOM => [
                'weight' => 10,
                'levels' => 36,
            ],
            PokedexNo::VENONAT => [
                'weight' => 5,
                'levels' => 34,
            ],
            PokedexNo::MEOWTH => [
                'weight' => 10,
                'levels' => 31,
            ],
            PokedexNo::PERSIAN => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 31,
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 20,
                'levels' => 31,
            ],
            PokedexNo::WEEPINBELL => [
                'weight' => 10,
                'levels' => 36,
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 31,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::KRABBY => [
                'weight' => 160,
                'levels' => [5, 25],
            ],
            PokedexNo::HORSEA => [
                'weight' => 160,
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
    LocationId::BERRY_FOREST => [
        EncounterType::WALKING => [
            PokedexNo::PIDGEY => [
                'weight' => 10,
                'levels' => 32,
            ],
            PokedexNo::PIDGEOTTO => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::ODDISH => [
                'weight' => 10,
                'levels' => 30,
            ],
            PokedexNo::GLOOM => [
                'weight' => 20,
                'levels' => 35,
            ],
            PokedexNo::VENONAT => [
                'weight' => 10,
                'levels' => 34,
            ],
            PokedexNo::VENOMOTH => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 31,
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 10,
                'levels' => 30,
            ],
            PokedexNo::WEEPINBELL => [
                'weight' => 20,
                'levels' => 35,
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 31,
            ],
            PokedexNo::DROWZEE => [
                'weight' => 10,
                'levels' => 34,
            ],
            PokedexNo::HYPNO => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
            PokedexNo::EXEGGCUTE => [
                'weight' => 5,
                'levels' => 35,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::PSYDUCK => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::GOLDUCK => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::SLOWBRO => [
                'weight' => 5,
                'levels' => [35, 40],
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
                'weight' => 5,
                'levels' => [15, 35],
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => [15, 35],
            ],
            PokedexNo::SEAKING => [
                'weight' => 40,
                'levels' => [20, 30],
            ],
            PokedexNo::GYARADOS => [
                'weight' => 15,
                'levels' => [15, 25],
            ],
        ],
    ],
    LocationId::ICEFALL_CAVE_ENTRANCE => [
        EncounterType::WALKING => [
            PokedexNo::SEEL => [
                'weight' => 40,
                'levels' => [43, 47],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 25,
                'levels' => [45, 48],
            ],
            PokedexNo::DEWGONG => [
                'weight' => 20,
                'levels' => [49, 53],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 10,
                'levels' => 40,
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 41,
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 41,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::SEEL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 30,
                'levels' => [5, 35],
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 30,
                'levels' => [5, 35],
            ],
            PokedexNo::DEWGONG => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
            PokedexNo::WOOPER => [
                'weight' => 5,
                'levels' => [5, 15],
            ],
            PokedexNo::MARILL => [
                'weight' => 5,
                'levels' => [5, 15],
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
    LocationId::ICEFALL_CAVE_1F => [
        EncounterType::WALKING => [
            PokedexNo::SWINUB => [
                'weight' => 50,
                'levels' => [23, 31],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 25,
                'levels' => [45, 48],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 10,
                'levels' => 40,
            ],
            PokedexNo::SEEL => [
                'weight' => 10,
                'levels' => 45,
            ],
            PokedexNo::DELIBIRD => [
                'weight' => 5,
                'levels' => 30,
            ],
            PokedexNo::SNEASEL => [
                'weight' => 5,
                'levels' => 30,
            ],
        ],
    ],
    LocationId::ICEFALL_CAVE_B1F => [
        EncounterType::WALKING => [
            PokedexNo::SWINUB => [
                'weight' => 50,
                'levels' => [23, 31],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 25,
                'levels' => [45, 48],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 10,
                'levels' => 40,
            ],
            PokedexNo::SEEL => [
                'weight' => 10,
                'levels' => 45,
            ],
            PokedexNo::DELIBIRD => [
                'weight' => 5,
                'levels' => 30,
            ],
            PokedexNo::SNEASEL => [
                'weight' => 5,
                'levels' => 30,
            ],
        ],
    ],
    LocationId::ICEFALL_CAVE_BACK_CAVE => [
        EncounterType::WALKING => [
            PokedexNo::SEEL => [
                'weight' => 40,
                'levels' => [43, 47],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 25,
                'levels' => [45, 48],
            ],
            PokedexNo::DEWGONG => [
                'weight' => 20,
                'levels' => [49, 53],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 10,
                'levels' => 40,
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 41,
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 41,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 95,
                'levels' => [5, 45],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 4,
                'levels' => [35, 45],
            ],
            PokedexNo::LAPRAS => [
                'weight' => 1,
                'levels' => [30, 45],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::CHRONO_ISLAND => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 65,
                'levels' => [5, 40],
            ],
            PokedexNo::HOPPIP => [
                'weight' => 30,
                'levels' => [5, 15],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::CHRONO_ISLE_MEADOW => [
        EncounterType::WALKING => [
            PokedexNo::SENTRET => [
                'weight' => 30,
                'levels' => [10, 15],
            ],
            PokedexNo::PIDGEY => [
                'weight' => 20,
                'levels' => 44,
            ],
            PokedexNo::PIDGEOTTO => [
                'weight' => 15,
                'levels' => [48, 50],
            ],
            PokedexNo::HOPPIP => [
                'weight' => 15,
                'levels' => [10, 15],
            ],
            PokedexNo::MEOWTH => [
                'weight' => 10,
                'levels' => 41,
            ],
            PokedexNo::PERSIAN => [
                'weight' => 5,
                'levels' => [47, 50],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 41,
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 41,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 65,
                'levels' => [5, 40],
            ],
            PokedexNo::HOPPIP => [
                'weight' => 30,
                'levels' => [5, 15],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::QWILFISH => [
                'weight' => 40,
                'levels' => [15, 25],
            ],
            PokedexNo::REMORAID => [
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::MEMORIAL_PILLAR => [
        EncounterType::WALKING => [
            PokedexNo::HOPPIP => [
                'weight' => 100,
                'levels' => [6, 16],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 65,
                'levels' => [5, 40],
            ],
            PokedexNo::HOPPIP => [
                'weight' => 30,
                'levels' => [5, 15],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::QWILFISH => [
                'weight' => 40,
                'levels' => [15, 25],
            ],
            PokedexNo::REMORAID => [
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::WATER_LABYRINTH => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 65,
                'levels' => [5, 40],
            ],
            PokedexNo::HOPPIP => [
                'weight' => 30,
                'levels' => [5, 15],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::QWILFISH => [
                'weight' => 40,
                'levels' => [15, 25],
            ],
            PokedexNo::REMORAID => [
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::RESORT_GORGEOUS => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 65,
                'levels' => [5, 40],
            ],
            PokedexNo::HOPPIP => [
                'weight' => 30,
                'levels' => [5, 15],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::QWILFISH => [
                'weight' => 40,
                'levels' => [15, 25],
            ],
            PokedexNo::REMORAID => [
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::LOST_CAVE_1F => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_1 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_2 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_3 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_4 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GASTLY => [
                'weight' => 20,
                'levels' => 40,
            ],
            PokedexNo::MURKROW => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 10,
                'levels' => 41,
            ],
        ],
    ],

    LocationId::LOST_CAVE_B1F_5 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_6 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GASTLY => [
                'weight' => 20,
                'levels' => 40,
            ],
            PokedexNo::MURKROW => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 10,
                'levels' => 41,
            ],
        ],
    ],

    LocationId::LOST_CAVE_B1F_7 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_8 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_9 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GASTLY => [
                'weight' => 20,
                'levels' => 40,
            ],
            PokedexNo::MURKROW => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 10,
                'levels' => 41,
            ],
        ],
    ],

    LocationId::LOST_CAVE_B1F_10 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_11 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_12 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::GASTLY => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GOLBAT => [
                'weight' => 20,
                'levels' => [41, 43],
            ],
            PokedexNo::MURKROW => [
                'weight' => 5,
                'levels' => 22,
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 5,
                'levels' => 22,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_13 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GASTLY => [
                'weight' => 20,
                'levels' => 40,
            ],
            PokedexNo::MURKROW => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 10,
                'levels' => 41,
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_14 => [
        EncounterType::WALKING => [
            PokedexNo::HAUNTER => [
                'weight' => 30,
                'levels' => [44, 52],
            ],
            PokedexNo::ZUBAT => [
                'weight' => 20,
                'levels' => 37,
            ],
            PokedexNo::GASTLY => [
                'weight' => 20,
                'levels' => 40,
            ],
            PokedexNo::MURKROW => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::MISDREAVUS => [
                'weight' => 20,
                'levels' => [15, 22],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 10,
                'levels' => 41,
            ],
        ],
    ],
    LocationId::WATER_PATH => [
        EncounterType::WALKING => [
            PokedexNo::SPEAROW => [
                'weight' => 20,
                'levels' => 44,
            ],
            PokedexNo::FEAROW => [
                'weight' => 15,
                'levels' => [48, 50],
            ],
            PokedexNo::ODDISH => [
                'weight' => 10,
                'levels' => 44,
            ],
            PokedexNo::GLOOM => [
                'weight' => 5,
                'levels' => 48,
            ],
            PokedexNo::MEOWTH => [
                'weight' => 10,
                'levels' => 41,
            ],
            PokedexNo::PERSIAN => [
                'weight' => 5,
                'levels' => [47, 50],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 41,
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 10,
                'levels' => 44,
            ],
            PokedexNo::WEEPINBELL => [
                'weight' => 5,
                'levels' => 48,
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 41,
            ],
            PokedexNo::SENTRET => [
                'weight' => 30,
                'levels' => [10, 15],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
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
            PokedexNo::QWILFISH => [
                'weight' => 40,
                'levels' => [15, 25],
            ],
            PokedexNo::REMORAID => [
                'weight' => 40,
                'levels' => [15, 25],
            ],
        ],
    ],
    LocationId::GREEN_PATH => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::QWILFISH => [
                'weight' => 40,
                'levels' => [15, 25],
            ],
            PokedexNo::REMORAID => [
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::OUTCAST_ISLAND => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 95,
                'levels' => [5, 40],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::QWILFISH => [
                'weight' => 40,
                'levels' => [15, 25],
            ],
            PokedexNo::REMORAID => [
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::ALTERING_CAVE => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT => [
                'weight' => 100,
                'levels' => [6, 16],
            ],
            PokedexNo::MAREEP => [
                'weight' => 100,
                'levels' => [3, 13],
            ],
            PokedexNo::AIPOM => [
                'weight' => 100,
                'levels' => [18, 28],
            ],
            PokedexNo::PINECO => [
                'weight' => 100,
                'levels' => [19, 29],
            ],
            PokedexNo::SHUCKLE => [
                'weight' => 100,
                'levels' => [18, 28],
            ],
            PokedexNo::TEDDIURSA => [
                'weight' => 100,
                'levels' => [18, 28],
            ],
            PokedexNo::HOUNDOUR => [
                'weight' => 100,
                'levels' => [12, 20],
            ],
            PokedexNo::STANTLER => [
                'weight' => 100,
                'levels' => [18, 28],
            ],
            PokedexNo::SMEARGLE => [
                'weight' => 100,
                'levels' => [18, 28],
            ],
        ],
    ],
    LocationId::RUIN_VALLEY => [
        EncounterType::WALKING => [
            PokedexNo::SPEAROW => [
                'weight' => 20,
                'levels' => 44,
            ],
            PokedexNo::FEAROW => [
                'weight' => 10,
                'levels' => 49,
            ],
            PokedexNo::MEOWTH => [
                'weight' => 10,
                'levels' => 43,
            ],
            PokedexNo::PERSIAN => [
                'weight' => 5,
                'levels' => [49, 52],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 41,
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 41,
            ],
            PokedexNo::NATU => [
                'weight' => 25,
                'levels' => [15, 20],
            ],
            PokedexNo::MARILL => [
                'weight' => 10,
                'levels' => 15,
            ],
            PokedexNo::YANMA => [
                'weight' => 10,
                'levels' => 18,
            ],
            PokedexNo::WOOPER => [
                'weight' => 10,
                'levels' => 15,
            ],
            PokedexNo::WOBBUFFET => [
                'weight' => 5,
                'levels' => 25,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::MARILL => [
                'weight' => 100,
                'levels' => [5, 25],
            ],
            PokedexNo::WOOPER => [
                'weight' => 100,
                'levels' => [5, 25],
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
    LocationId::PATTERN_BUSH => [
        EncounterType::WALKING => [
            PokedexNo::CATERPIE => [
                'weight' => 10,
                'levels' => 6,
            ],
            PokedexNo::METAPOD => [
                'weight' => 25,
                'levels' => 9,
            ],
            PokedexNo::WEEDLE => [
                'weight' => 10,
                'levels' => 6,
            ],
            PokedexNo::KAKUNA => [
                'weight' => 25,
                'levels' => 9,
            ],
            PokedexNo::LEDYBA => [
                'weight' => 35,
                'levels' => [9, 14],
            ],
            PokedexNo::SPINARAK => [
                'weight' => 35,
                'levels' => [9, 14],
            ],
            PokedexNo::HERACROSS => [
                'weight' => 20,
                'levels' => [15, 30],
            ],
        ],
    ],
    LocationId::CANYON_ENTRANCE => [
        EncounterType::WALKING => [
            PokedexNo::SPEAROW => [
                'weight' => 20,
                'levels' => 44,
            ],
            PokedexNo::FEAROW => [
                'weight' => 15,
                'levels' => [48, 50],
            ],
            PokedexNo::MEOWTH => [
                'weight' => 10,
                'levels' => 41,
            ],
            PokedexNo::PERSIAN => [
                'weight' => 5,
                'levels' => [47, 50],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => 41,
            ],
            PokedexNo::SLOWPOKE => [
                'weight' => 5,
                'levels' => 41,
            ],
            PokedexNo::SENTRET => [
                'weight' => 30,
                'levels' => [10, 15],
            ],
            PokedexNo::PHANPY => [
                'weight' => 15,
                'levels' => [10, 15],
            ],
        ],
    ],
    LocationId::SEVAULT_CANYON => [
        EncounterType::WALKING => [
            PokedexNo::FEAROW => [
                'weight' => 25,
                'levels' => 50,
            ],
            PokedexNo::MEOWTH => [
                'weight' => 10,
                'levels' => 43,
            ],
            PokedexNo::PERSIAN => [
                'weight' => 5,
                'levels' => [49, 52],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 20,
                'levels' => 46,
            ],
            PokedexNo::ONIX => [
                'weight' => 5,
                'levels' => 54,
            ],
            PokedexNo::CUBONE => [
                'weight' => 10,
                'levels' => 46,
            ],
            PokedexNo::MAROWAK => [
                'weight' => 10,
                'levels' => 52,
            ],
            PokedexNo::SKARMORY => [
                'weight' => 5,
                'levels' => 30,
            ],
            PokedexNo::PHANPY => [
                'weight' => 20,
                'levels' => 15,
            ],
            PokedexNo::LARVITAR => [
                'weight' => 5,
                'levels' => [15, 20],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 65,
                'levels' => [25, 40],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 35,
                'levels' => [30, 50],
            ],
        ],
    ],
    LocationId::TANOBY_RUINS => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 185,
                'levels' => [5, 40],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
            PokedexNo::MANTINE => [
                'weight' => 5,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 120,
                'levels' => [5, 15],
            ],
            PokedexNo::HORSEA => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::KRABBY => [
                'weight' => 120,
                'levels' => [5, 25],
            ],
            PokedexNo::QWILFISH => [
                'weight' => 40,
                'levels' => [15, 25],
            ],
            PokedexNo::REMORAID => [
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
            PokedexNo::KINGLER => [
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
    ],
    LocationId::TANOBY_MONEAN_CHAMBER => [
        EncounterType::WALKING => [
            PokedexNo::UNOWN => [
                [
                    'form' => "A",
                    'weight' => 99,
                    'levels' => 25,
                ],
                [
                    'form' => "?",
                    'weight' => 1,
                    'levels' => 25,
                ],
            ],
        ],
    ],
    LocationId::TANOBY_LIPTOO_CHAMBER => [
        EncounterType::WALKING => [
            PokedexNo::UNOWN => [
                [
                    'form' => "C",
                    'weight' => 50,
                    'levels' => 25,
                ],
                [
                    'form' => "D",
                    'weight' => 30,
                    'levels' => 25,
                ],
                [
                    'form' => "H",
                    'weight' => 14,
                    'levels' => 25,
                ],
                [
                    'form' => "U",
                    'weight' => 5,
                    'levels' => 25,
                ],
                [
                    'form' => "O",
                    'weight' => 1,
                    'levels' => 25,
                ],
            ],
        ],
    ],
    LocationId::TANOBY_WEEPTH_CHAMBER => [
        EncounterType::WALKING => [
            PokedexNo::UNOWN => [
                [
                    'form' => "N",
                    'weight' => 60,
                    'levels' => 25,
                ],
                [
                    'form' => "S",
                    'weight' => 30,
                    'levels' => 25,
                ],
                [
                    'form' => "I",
                    'weight' => 8,
                    'levels' => 25,
                ],
                [
                    'form' => "E",
                    'weight' => 2,
                    'levels' => 25,
                ],
            ],
        ],
    ],
    LocationId::TANOBY_DILFORD_CHAMBER => [
        EncounterType::WALKING => [
            PokedexNo::UNOWN => [
                [
                    'form' => "P",
                    'weight' => 40,
                    'levels' => 25,
                ],
                [
                    'form' => "J",
                    'weight' => 20,
                    'levels' => 25,
                ],
                [
                    'form' => "L",
                    'weight' => 20,
                    'levels' => 25,
                ],
                [
                    'form' => "R",
                    'weight' => 14,
                    'levels' => 25,
                ],
                [
                    'form' => "Q",
                    'weight' => 6,
                    'levels' => 25,
                ],
            ],
        ],
    ],
    LocationId::TANOBY_SCUFIB_CHAMBER => [
        EncounterType::WALKING => [
            PokedexNo::UNOWN => [
                [
                    'form' => "Y",
                    'weight' => 40,
                    'levels' => 25,
                ],
                [
                    'form' => "G",
                    'weight' => 25,
                    'levels' => 25,
                ],
                [
                    'form' => "T",
                    'weight' => 20,
                    'levels' => 25,
                ],
                [
                    'form' => "F",
                    'weight' => 13,
                    'levels' => 25,
                ],
                [
                    'form' => "K",
                    'weight' => 2,
                    'levels' => 25,
                ],
            ],
        ],
    ],
    LocationId::TANOBY_RIXY_CHAMBER => [
        EncounterType::WALKING => [
            PokedexNo::UNOWN => [
                [
                    'form' => "V",
                    'weight' => 50,
                    'levels' => 25,
                ],
                [
                    'form' => "W",
                    'weight' => 30,
                    'levels' => 25,
                ],
                [
                    'form' => "X",
                    'weight' => 10,
                    'levels' => 25,
                ],
                [
                    'form' => "M",
                    'weight' => 8,
                    'levels' => 25,
                ],
                [
                    'form' => "B",
                    'weight' => 2,
                    'levels' => 25,
                ],
            ],
        ],
    ],
    LocationId::TANOBY_VIAPOIS_CHAMBER => [
        EncounterType::WALKING => [
            PokedexNo::UNOWN => [
                [
                    'form' => "Z",
                    'weight' => 99,
                    'levels' => 25,
                ],
                [
                    'form' => "!",
                    'weight' => 1,
                    'levels' => 25,
                ],
            ],
        ],
    ],
];
