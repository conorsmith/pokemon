<?php
declare(strict_types=1);

use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;

return [
    LocationId::ROUTE_101 => [
        EncounterType::WALKING => [
            PokedexNo::POOCHYENA => [
                'weight' => 55,
                'levels' => [2, 3],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 55,
                'levels' => [2, 3],
            ],
            PokedexNo::WURMPLE => [
                'weight' => 45,
                'levels' => [2, 3],
            ],
        ],
    ],
    LocationId::ROUTE_102 => [
        EncounterType::WALKING => [
            PokedexNo::POOCHYENA => [
                'weight' => 45,
                'levels' => [3, 4],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 45,
                'levels' => [3, 4],
            ],
            PokedexNo::WURMPLE => [
                'weight' => 30,
                'levels' => [3, 4],
            ],
            PokedexNo::LOTAD => [
                'weight' => 20,
                'levels' => [3, 4],
            ],
            PokedexNo::SEEDOT => [
                'weight' => 21,
                'levels' => [3, 4],
            ],
            PokedexNo::RALTS => [
                'weight' => 4,
                'levels' => 4,
            ],
            PokedexNo::SURSKIT => [
                'weight' => 1,
                'levels' => 3,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::GOLDEEN => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
            PokedexNo::MARILL => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::SURSKIT => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::CORPHISH => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::PETALBURG_CITY => [
        EncounterType::SURFING => [
            PokedexNo::MARILL => [
                'weight' => 100,
                'levels' => [5, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::CORPHISH => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_103 => [
        EncounterType::WALKING => [
            PokedexNo::POOCHYENA => [
                'weight' => 90,
                'levels' => [2, 4],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 80,
                'levels' => [2, 4],
            ],
            PokedexNo::WINGULL => [
                'weight' => 30,
                'levels' => [2, 4],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_104 => [
        EncounterType::WALKING => [
            PokedexNo::MARILL => [
                'weight' => 20,
                'levels' => [4, 5],
            ],
            PokedexNo::POOCHYENA => [
                'weight' => 40,
                'levels' => [4, 5],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 50,
                'levels' => [4, 5],
            ],
            PokedexNo::WURMPLE => [
                'weight' => 50,
                'levels' => [4, 5],
            ],
            PokedexNo::TAILLOW => [
                'weight' => 10,
                'levels' => [4, 5],
            ],
            PokedexNo::WINGULL => [
                'weight' => 10,
                'levels' => [3, 5],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::WINGULL => [
                'weight' => 95,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::MAGIKARP => [
                'weight' => 300,
                'levels' => [5, 45],
            ],
        ],
    ],
    LocationId::ROUTE_116 => [
        EncounterType::WALKING => [
            PokedexNo::ABRA => [
                'weight' => 10,
                'levels' => 7,
            ],
            PokedexNo::POOCHYENA => [
                'weight' => 28,
                'levels' => [6, 8],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 28,
                'levels' => [6, 8],
            ],
            PokedexNo::TAILLOW => [
                'weight' => 20,
                'levels' => [6, 8],
            ],
            PokedexNo::NINCADA => [
                'weight' => 20,
                'levels' => [6, 7],
            ],
            PokedexNo::WHISMUR => [
                'weight' => 50,
                'levels' => [6, 7],
            ],
            PokedexNo::SKITTY => [
                'weight' => 2,
                'levels' => [7, 8],
            ],
        ],
    ],
    LocationId::RUSTURF_TUNNEL => [
        EncounterType::WALKING => [
            PokedexNo::WHISMUR => [
                'weight' => 100,
                'levels' => [5, 8],
            ],
        ],
    ],
    LocationId::ROUTE_105 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_106 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::GRANITE_CAVE_1F => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT => [
                'weight' => 30,
                'levels' => [7, 8],
            ],
            PokedexNo::ABRA => [
                'weight' => 10,
                'levels' => 8,
            ],
            PokedexNo::GEODUDE => [
                'weight' => 10,
                'levels' => [6, 9],
            ],
            PokedexNo::MAKUHITA => [
                'weight' => 50,
                'levels' => [6, 10],
            ],
        ],
    ],
    LocationId::GRANITE_CAVE_B1F => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT => [
                'weight' => 30,
                'levels' => [9, 10],
            ],
            PokedexNo::ABRA => [
                'weight' => 10,
                'levels' => 9,
            ],
            PokedexNo::MAKUHITA => [
                'weight' => 10,
                'levels' => [10, 11],
            ],
            PokedexNo::SABLEYE => [
                'weight' => 10,
                'levels' => [9, 11],
            ],
            PokedexNo::MAWILE => [
                'weight' => 10,
                'levels' => [9, 11],
            ],
            PokedexNo::ARON => [
                'weight' => 40,
                'levels' => [9, 11],
            ],
        ],
    ],
    LocationId::GRANITE_CAVE_B2F => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT => [
                'weight' => 30,
                'levels' => [10, 11],
            ],
            PokedexNo::ABRA => [
                'weight' => 10,
                'levels' => 10,
            ],
            PokedexNo::SABLEYE => [
                'weight' => 20,
                'levels' => [10, 12],
            ],
            PokedexNo::MAWILE => [
                'weight' => 20,
                'levels' => [10, 12],
            ],
            PokedexNo::ARON => [
                'weight' => 40,
                'levels' => [10, 12],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 70,
                'levels' => [5, 20],
            ],
            PokedexNo::NOSEPASS => [
                'weight' => 30,
                'levels' => [10, 20],
            ],
        ],
    ],
    LocationId::GRANITE_CAVE_STEVENS_ROOM => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT => [
                'weight' => 30,
                'levels' => [7, 8],
            ],
            PokedexNo::ABRA => [
                'weight' => 10,
                'levels' => 8,
            ],
            PokedexNo::MAKUHITA => [
                'weight' => 50,
                'levels' => [6, 10],
            ],
            PokedexNo::ARON => [
                'weight' => 10,
                'levels' => [7, 8],
            ],
        ],
    ],
    LocationId::DEWFORD_TOWN => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_107 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_108 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ABANDONED_SHIP_1F => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 1,
                'levels' => [30, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 150,
                'levels' => [5, 35],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 20,
                'levels' => [20, 35],
            ],
        ],
    ],
    LocationId::ABANDONED_SHIP_B1F => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 1,
                'levels' => [30, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 150,
                'levels' => [5, 35],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 20,
                'levels' => [20, 35],
            ],
        ],
    ],
    LocationId::ROUTE_109 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::SLATEPORT_CITY => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_110 => [
        EncounterType::WALKING => [
            PokedexNo::ODDISH => [
                'weight' => 10,
                'levels' => 13,
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 20,
                'levels' => 12,
            ],
            PokedexNo::POOCHYENA => [
                'weight' => 20,
                'levels' => 12,
            ],
            PokedexNo::WINGULL => [
                'weight' => 8,
                'levels' => 12,
            ],
            PokedexNo::ELECTRIKE => [
                'weight' => 30,
                'levels' => [12, 13],
            ],
            PokedexNo::PLUSLE => [
                'weight' => 17,
                'levels' => [12, 13],
            ],
            PokedexNo::MINUN => [
                'weight' => 17,
                'levels' => [12, 13],
            ],
            PokedexNo::GULPIN => [
                'weight' => 15,
                'levels' => [12, 13],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_111 => [
        EncounterType::WALKING => [
            PokedexNo::SANDSHREW => [
                'weight' => 35,
                'levels' => [19, 21],
            ],
            PokedexNo::TRAPINCH => [
                'weight' => 35,
                'levels' => [19, 21],
            ],
            PokedexNo::CACNEA => [
                'weight' => 26,
                'levels' => [19, 22],
            ],
            PokedexNo::BALTOY => [
                'weight' => 34,
                'levels' => [19, 22],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 100,
                'levels' => [5, 20],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::GOLDEEN => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
            PokedexNo::MARILL => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::SURSKIT => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::BARBOACH => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::MIRAGE_TOWER => [
        EncounterType::WALKING => [
            PokedexNo::SANDSHREW => [
                'weight' => 50,
                'levels' => [20, 24],
            ],
            PokedexNo::TRAPINCH => [
                'weight' => 50,
                'levels' => [20, 24],
            ],
        ],
    ],
    LocationId::ROUTE_112 => [
        EncounterType::WALKING => [
            PokedexNo::MACHOP => [
                'weight' => 25,
                'levels' => [14, 16],
            ],
            PokedexNo::MARILL => [
                'weight' => 25,
                'levels' => [14, 16],
            ],
            PokedexNo::NUMEL => [
                'weight' => 75,
                'levels' => [14, 16],
            ],
        ],
    ],
    LocationId::FIERY_PATH => [
        EncounterType::WALKING => [
            PokedexNo::MACHOP => [
                'weight' => 15,
                'levels' => [15, 16],
            ],
            PokedexNo::GRIMER => [
                'weight' => 27,
                'levels' => [14, 16],
            ],
            PokedexNo::KOFFING => [
                'weight' => 27,
                'levels' => [14, 16],
            ],
            PokedexNo::SLUGMA => [
                'weight' => 10,
                'levels' => 15,
            ],
            PokedexNo::NUMEL => [
                'weight' => 30,
                'levels' => [15, 16],
            ],
            PokedexNo::TORKOAL => [
                'weight' => 18,
                'levels' => [14, 16],
            ],
        ],
    ],
    LocationId::JAGGED_PASS => [
        EncounterType::WALKING => [
            PokedexNo::MACHOP => [
                'weight' => 50,
                'levels' => [18, 22],
            ],
            PokedexNo::NUMEL => [
                'weight' => 110,
                'levels' => [18, 22],
            ],
            PokedexNo::SPOINK => [
                'weight' => 40,
                'levels' => [18, 22],
            ],
        ],
    ],
];
