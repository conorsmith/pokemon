<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;

return [
    LocationId::ROUTE_101                 => [
        EncounterType::WALKING => [
            PokedexNo::POOCHYENA => [
                'weight' => 55,
                'levels' => [2, 3],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 55,
                'levels' => [2, 3],
            ],
            PokedexNo::WURMPLE   => [
                'weight' => 45,
                'levels' => [2, 3],
            ],
        ],
    ],
    LocationId::ROUTE_102                 => [
        EncounterType::WALKING => [
            PokedexNo::POOCHYENA => [
                'weight' => 45,
                'levels' => [3, 4],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 45,
                'levels' => [3, 4],
            ],
            PokedexNo::WURMPLE   => [
                'weight' => 30,
                'levels' => [3, 4],
            ],
            PokedexNo::LOTAD     => [
                'weight' => 20,
                'levels' => [3, 4],
            ],
            PokedexNo::SEEDOT    => [
                'weight' => 21,
                'levels' => [3, 4],
            ],
            PokedexNo::RALTS     => [
                'weight' => 4,
                'levels' => 4,
            ],
            PokedexNo::SURSKIT   => [
                'weight' => 1,
                'levels' => 3,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::GOLDEEN => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
            PokedexNo::MARILL  => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::SURSKIT => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
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
    LocationId::PETALBURG_CITY            => [
        EncounterType::SURFING => [
            PokedexNo::MARILL => [
                'weight' => 100,
                'levels' => [5, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
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
    LocationId::ROUTE_103                 => [
        EncounterType::WALKING => [
            PokedexNo::POOCHYENA => [
                'weight' => 90,
                'levels' => [2, 4],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 80,
                'levels' => [2, 4],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 30,
                'levels' => [2, 4],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_104                 => [
        EncounterType::WALKING => [
            PokedexNo::MARILL    => [
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
            PokedexNo::WURMPLE   => [
                'weight' => 50,
                'levels' => [4, 5],
            ],
            PokedexNo::TAILLOW   => [
                'weight' => 10,
                'levels' => [4, 5],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 10,
                'levels' => [3, 5],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::WINGULL  => [
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
    LocationId::PETALBURG_WOODS           => [
        EncounterType::WALKING => [
            PokedexNo::POOCHYENA => [
                'weight' => 30,
                'levels' => [5, 6],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 30,
                'levels' => [5, 6],
            ],
            PokedexNo::WURMPLE   => [
                'weight' => 25,
                'levels' => [5, 6],
            ],
            PokedexNo::SILCOON   => [
                'weight' => 10,
                'levels' => 5,
            ],
            PokedexNo::CASCOON   => [
                'weight' => 10,
                'levels' => 5,
            ],
            PokedexNo::TAILLOW   => [
                'weight' => 5,
                'levels' => [5, 6],
            ],
            PokedexNo::SHROOMISH => [
                'weight' => 15,
                'levels' => [5, 6],
            ],
            PokedexNo::SLAKOTH   => [
                'weight' => 5,
                'levels' => [5, 6],
            ],
        ],
    ],
    LocationId::ROUTE_116                 => [
        EncounterType::WALKING => [
            PokedexNo::ABRA      => [
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
            PokedexNo::TAILLOW   => [
                'weight' => 20,
                'levels' => [6, 8],
            ],
            PokedexNo::NINCADA   => [
                'weight' => 20,
                'levels' => [6, 7],
            ],
            PokedexNo::WHISMUR   => [
                'weight' => 50,
                'levels' => [6, 7],
            ],
            PokedexNo::SKITTY    => [
                'weight' => 2,
                'levels' => [7, 8],
            ],
        ],
    ],
    LocationId::RUSTURF_TUNNEL            => [
        EncounterType::WALKING => [
            PokedexNo::WHISMUR => [
                'weight' => 100,
                'levels' => [5, 8],
            ],
        ],
    ],
    LocationId::ROUTE_105                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_106                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::GRANITE_CAVE_1F           => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT    => [
                'weight' => 30,
                'levels' => [7, 8],
            ],
            PokedexNo::ABRA     => [
                'weight' => 10,
                'levels' => 8,
            ],
            PokedexNo::GEODUDE  => [
                'weight' => 10,
                'levels' => [6, 9],
            ],
            PokedexNo::MAKUHITA => [
                'weight' => 50,
                'levels' => [6, 10],
            ],
        ],
    ],
    LocationId::GRANITE_CAVE_B1F          => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT    => [
                'weight' => 30,
                'levels' => [9, 10],
            ],
            PokedexNo::ABRA     => [
                'weight' => 10,
                'levels' => 9,
            ],
            PokedexNo::MAKUHITA => [
                'weight' => 10,
                'levels' => [10, 11],
            ],
            PokedexNo::SABLEYE  => [
                'weight' => 10,
                'levels' => [9, 11],
            ],
            PokedexNo::MAWILE   => [
                'weight' => 10,
                'levels' => [9, 11],
            ],
            PokedexNo::ARON     => [
                'weight' => 40,
                'levels' => [9, 11],
            ],
        ],
    ],
    LocationId::GRANITE_CAVE_B2F          => [
        EncounterType::WALKING    => [
            PokedexNo::ZUBAT   => [
                'weight' => 30,
                'levels' => [10, 11],
            ],
            PokedexNo::ABRA    => [
                'weight' => 10,
                'levels' => 10,
            ],
            PokedexNo::SABLEYE => [
                'weight' => 20,
                'levels' => [10, 12],
            ],
            PokedexNo::MAWILE  => [
                'weight' => 20,
                'levels' => [10, 12],
            ],
            PokedexNo::ARON    => [
                'weight' => 40,
                'levels' => [10, 12],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE  => [
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
            PokedexNo::ZUBAT    => [
                'weight' => 30,
                'levels' => [7, 8],
            ],
            PokedexNo::ABRA     => [
                'weight' => 10,
                'levels' => 8,
            ],
            PokedexNo::MAKUHITA => [
                'weight' => 50,
                'levels' => [6, 10],
            ],
            PokedexNo::ARON     => [
                'weight' => 10,
                'levels' => [7, 8],
            ],
        ],
    ],
    LocationId::DEWFORD_TOWN              => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_107                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_108                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ABANDONED_SHIP_1F         => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL  => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 1,
                'levels' => [30, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL  => [
                'weight' => 150,
                'levels' => [5, 35],
            ],
            PokedexNo::MAGIKARP   => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 20,
                'levels' => [20, 35],
            ],
        ],
    ],
    LocationId::ABANDONED_SHIP_B1F        => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL  => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 1,
                'levels' => [30, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL  => [
                'weight' => 150,
                'levels' => [5, 35],
            ],
            PokedexNo::MAGIKARP   => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 20,
                'levels' => [20, 35],
            ],
        ],
    ],
    LocationId::ROUTE_109                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::SLATEPORT_CITY            => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_110                 => [
        EncounterType::WALKING => [
            PokedexNo::ODDISH    => [
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
            PokedexNo::WINGULL   => [
                'weight' => 8,
                'levels' => 12,
            ],
            PokedexNo::ELECTRIKE => [
                'weight' => 30,
                'levels' => [12, 13],
            ],
            PokedexNo::PLUSLE    => [
                'weight' => 17,
                'levels' => [12, 13],
            ],
            PokedexNo::MINUN     => [
                'weight' => 17,
                'levels' => [12, 13],
            ],
            PokedexNo::GULPIN    => [
                'weight' => 15,
                'levels' => [12, 13],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_111                 => [
        EncounterType::WALKING    => [
            PokedexNo::SANDSHREW => [
                'weight' => 35,
                'levels' => [19, 21],
            ],
            PokedexNo::TRAPINCH  => [
                'weight' => 35,
                'levels' => [19, 21],
            ],
            PokedexNo::CACNEA    => [
                'weight' => 26,
                'levels' => [19, 22],
            ],
            PokedexNo::BALTOY    => [
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
        EncounterType::SURFING    => [
            PokedexNo::GOLDEEN => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
            PokedexNo::MARILL  => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::SURSKIT => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
        ],
        EncounterType::FISHING    => [
            PokedexNo::GOLDEEN  => [
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
    LocationId::MIRAGE_TOWER              => [
        EncounterType::WALKING => [
            PokedexNo::SANDSHREW => [
                'weight' => 50,
                'levels' => [20, 24],
            ],
            PokedexNo::TRAPINCH  => [
                'weight' => 50,
                'levels' => [20, 24],
            ],
        ],
    ],
    LocationId::ROUTE_112                 => [
        EncounterType::WALKING => [
            PokedexNo::MACHOP => [
                'weight' => 25,
                'levels' => [14, 16],
            ],
            PokedexNo::MARILL => [
                'weight' => 25,
                'levels' => [14, 16],
            ],
            PokedexNo::NUMEL  => [
                'weight' => 75,
                'levels' => [14, 16],
            ],
        ],
    ],
    LocationId::FIERY_PATH                => [
        EncounterType::WALKING => [
            PokedexNo::MACHOP  => [
                'weight' => 15,
                'levels' => [15, 16],
            ],
            PokedexNo::GRIMER  => [
                'weight' => 27,
                'levels' => [14, 16],
            ],
            PokedexNo::KOFFING => [
                'weight' => 27,
                'levels' => [14, 16],
            ],
            PokedexNo::SLUGMA  => [
                'weight' => 10,
                'levels' => 15,
            ],
            PokedexNo::NUMEL   => [
                'weight' => 30,
                'levels' => [15, 16],
            ],
            PokedexNo::TORKOAL => [
                'weight' => 18,
                'levels' => [14, 16],
            ],
        ],
    ],
    LocationId::JAGGED_PASS               => [
        EncounterType::WALKING => [
            PokedexNo::MACHOP  => [
                'weight' => 50,
                'levels' => [18, 22],
            ],
            PokedexNo::NUMEL   => [
                'weight' => 110,
                'levels' => [18, 22],
            ],
            PokedexNo::SPOINK  => [
                'weight' => 40,
                'levels' => [18, 22],
            ],
        ],
    ],
    LocationId::ROUTE_113                 => [
        EncounterType::WALKING => [
            PokedexNo::SANDSHREW => [
                'weight' => 25,
                'levels' => [14, 16],
            ],
            PokedexNo::SLUGMA    => [
                'weight' => 25,
                'levels' => [14, 16],
            ],
            PokedexNo::SKARMORY  => [
                'weight' => 5,
                'levels' => 16,
            ],
            PokedexNo::SPINDA    => [
                'weight' => 70,
                'levels' => [14, 16],
            ],
        ],
    ],
    LocationId::ROUTE_114                 => [
        EncounterType::WALKING    => [
            PokedexNo::LOTAD    => [
                'weight' => 30,
                'levels' => [15, 16],
            ],
            PokedexNo::LOMBRE   => [
                'weight' => 30,
                'levels' => [16, 18],
            ],
            PokedexNo::SEEDOT   => [
                'weight' => 30,
                'levels' => [15, 16],
            ],
            PokedexNo::NUZLEAF  => [
                'weight' => 11,
                'levels' => [15, 18],
            ],
            PokedexNo::SURSKIT  => [
                'weight' => 1,
                'levels' => 15,
            ],
            PokedexNo::SWABLU   => [
                'weight' => 40,
                'levels' => [15, 17],
            ],
            PokedexNo::ZANGOOSE => [
                'weight' => 19,
                'levels' => [15, 17],
            ],
            PokedexNo::SEVIPER  => [
                'weight' => 28,
                'levels' => [15, 17],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 100,
                'levels' => [5, 20],
            ],
        ],
        EncounterType::SURFING    => [
            PokedexNo::GOLDEEN => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
            PokedexNo::MARILL  => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::SURSKIT => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
        ],
        EncounterType::FISHING    => [
            PokedexNo::GOLDEEN  => [
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
    LocationId::DESERT_UNDERPASS          => [
        EncounterType::WALKING => [
            PokedexNo::DITTO   => [
                'weight' => 50,
                'levels' => [38, 45],
            ],
            PokedexNo::WHISMUR => [
                'weight' => 34,
                'levels' => [35, 38],
            ],
            PokedexNo::LOUDRED => [
                'weight' => 16,
                'levels' => [38, 44],
            ],
        ],
    ],
    LocationId::METEOR_FALLS_1F           => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT    => [
                'weight' => 80,
                'levels' => [14, 20],
            ],
            PokedexNo::LUNATONE => [
                'weight' => 20,
                'levels' => [14, 18],
            ],
            PokedexNo::SOLROCK  => [
                'weight' => 20,
                'levels' => [14, 18],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::ZUBAT    => [
                'weight' => 90,
                'levels' => [5, 35],
            ],
            PokedexNo::SOLROCK  => [
                'weight' => 10,
                'levels' => [5, 35],
            ],
            PokedexNo::LUNATONE => [
                'weight' => 10,
                'levels' => [5, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
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
    LocationId::METEOR_FALLS_B1F          => [
        EncounterType::WALKING => [
            PokedexNo::LUNATONE => [
                'weight' => 35,
                'levels' => [33, 39],
            ],
            PokedexNo::SOLROCK  => [
                'weight' => 35,
                'levels' => [33, 39],
            ],
            PokedexNo::GOLBAT   => [
                'weight' => 65,
                'levels' => [33, 40],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::SOLROCK  => [
                'weight' => 10,
                'levels' => [5, 35],
            ],
            PokedexNo::LUNATONE => [
                'weight' => 10,
                'levels' => [5, 35],
            ],
            PokedexNo::GOLBAT   => [
                'weight' => 90,
                'levels' => [30, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::BARBOACH => [
                'weight' => 100,
                'levels' => [10, 35],
            ],
            PokedexNo::WHISCASH => [
                'weight' => 20,
                'levels' => [30, 45],
            ],
        ],
    ],
    LocationId::METEOR_FALLS_B2F          => [
        EncounterType::WALKING => [
            PokedexNo::LUNATONE => [
                'weight' => 25,
                'levels' => [35, 39],
            ],
            PokedexNo::SOLROCK  => [
                'weight' => 25,
                'levels' => [35, 39],
            ],
            PokedexNo::GOLBAT   => [
                'weight' => 50,
                'levels' => [33, 40],
            ],
            PokedexNo::BAGON    => [
                'weight' => 25,
                'levels' => [25, 35],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::SOLROCK  => [
                'weight' => 10,
                'levels' => [5, 35],
            ],
            PokedexNo::LUNATONE => [
                'weight' => 10,
                'levels' => [5, 35],
            ],
            PokedexNo::GOLBAT   => [
                'weight' => 90,
                'levels' => [30, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::BARBOACH => [
                'weight' => 100,
                'levels' => [10, 35],
            ],
            PokedexNo::WHISCASH => [
                'weight' => 20,
                'levels' => [30, 45],
            ],
        ],
    ],
    LocationId::METEOR_FALLS_STEVENS_CAVE => [
        EncounterType::WALKING => [
            PokedexNo::SOLROCK => [
                'weight' => 35,
                'levels' => [33, 39],
            ],
            PokedexNo::GOLBAT  => [
                'weight' => 65,
                'levels' => [33, 40],
            ],
        ],
    ],
    LocationId::ROUTE_115                 => [
        EncounterType::WALKING => [
            PokedexNo::JIGGLYPUFF => [
                'weight' => 10,
                'levels' => [24, 25],
            ],
            PokedexNo::TAILLOW    => [
                'weight' => 40,
                'levels' => [23, 25],
            ],
            PokedexNo::SWELLOW    => [
                'weight' => 10,
                'levels' => 25,
            ],
            PokedexNo::WINGULL    => [
                'weight' => 10,
                'levels' => [24, 26],
            ],
            PokedexNo::SWABLU     => [
                'weight' => 30,
                'levels' => [23, 25],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_117                 => [
        EncounterType::WALKING => [
            PokedexNo::ODDISH    => [
                'weight' => 50,
                'levels' => [13, 14],
            ],
            PokedexNo::MARILL    => [
                'weight' => 10,
                'levels' => 13,
            ],
            PokedexNo::POOCHYENA => [
                'weight' => 30,
                'levels' => [13, 14],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 30,
                'levels' => [13, 14],
            ],
            PokedexNo::SEEDOT    => [
                'weight' => 1,
                'levels' => 13,
            ],
            PokedexNo::SURSKIT   => [
                'weight' => 1,
                'levels' => 13,
            ],
            PokedexNo::VOLBEAT   => [
                'weight' => 19,
                'levels' => [13, 14],
            ],
            PokedexNo::ILLUMISE  => [
                'weight' => 19,
                'levels' => [13, 14],
            ],
            PokedexNo::ROSELIA   => [
                'weight' => 30,
                'levels' => [13, 14],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::GOLDEEN => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
            PokedexNo::MARILL  => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::SURSKIT => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
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
    LocationId::ROUTE_118                 => [
        EncounterType::WALKING => [
            PokedexNo::ZIGZAGOON => [
                'weight' => 30,
                'levels' => [24, 26],
            ],
            PokedexNo::LINOONE   => [
                'weight' => 10,
                'levels' => 26,
            ],
            PokedexNo::WINGULL   => [
                'weight' => 19,
                'levels' => [25, 27],
            ],
            PokedexNo::ELECTRIKE => [
                'weight' => 30,
                'levels' => [24, 26],
            ],
            PokedexNo::MANECTRIC => [
                'weight' => 10,
                'levels' => 26,
            ],
            PokedexNo::KECLEON   => [
                'weight' => 1,
                'levels' => 25,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::CARVANHA  => [
                'weight' => 80,
                'levels' => [10, 30],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_119                 => [
        EncounterType::WALKING => [
            PokedexNo::ODDISH    => [
                'weight' => 30,
                'levels' => [24, 27],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 30,
                'levels' => [25, 27],
            ],
            PokedexNo::LINOONE   => [
                'weight' => 30,
                'levels' => [25, 27],
            ],
            PokedexNo::KECLEON   => [
                'weight' => 1,
                'levels' => 25,
            ],
            PokedexNo::TROPIUS   => [
                'weight' => 9,
                'levels' => [25, 27],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::CARVANHA  => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
            PokedexNo::FEEBAS    => [
                'weight' => 15,
                'levels' => [20, 25],
            ],
        ],
    ],
    LocationId::ROUTE_120                 => [
        EncounterType::WALKING => [
            PokedexNo::ODDISH    => [
                'weight' => 25,
                'levels' => [25, 27],
            ],
            PokedexNo::MARILL    => [
                'weight' => 15,
                'levels' => [25, 27],
            ],
            PokedexNo::POOCHYENA => [
                'weight' => 20,
                'levels' => 25,
            ],
            PokedexNo::MIGHTYENA => [
                'weight' => 30,
                'levels' => [25, 27],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 20,
                'levels' => 25,
            ],
            PokedexNo::LINOONE   => [
                'weight' => 30,
                'levels' => [25, 27],
            ],
            PokedexNo::SEEDOT    => [
                'weight' => 1,
                'levels' => 25,
            ],
            PokedexNo::SURSKIT   => [
                'weight' => 1,
                'levels' => 25,
            ],
            PokedexNo::KECLEON   => [
                'weight' => 1,
                'levels' => 25,
            ],
            PokedexNo::ABSOL     => [
                'weight' => 8,
                'levels' => [25, 27],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::GOLDEEN => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
            PokedexNo::MARILL  => [
                'weight' => 99,
                'levels' => [5, 35],
            ],
            PokedexNo::SURSKIT => [
                'weight' => 1,
                'levels' => [20, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
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
    LocationId::ROUTE_121                 => [
        EncounterType::WALKING => [
            PokedexNo::ODDISH    => [
                'weight' => 15,
                'levels' => [26, 28],
            ],
            PokedexNo::GLOOM     => [
                'weight' => 5,
                'levels' => 28,
            ],
            PokedexNo::POOCHYENA => [
                'weight' => 20,
                'levels' => 26,
            ],
            PokedexNo::MIGHTYENA => [
                'weight' => 20,
                'levels' => [26, 28],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 20,
                'levels' => 26,
            ],
            PokedexNo::LINOONE   => [
                'weight' => 20,
                'levels' => [26, 28],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 9,
                'levels' => [26, 28],
            ],
            PokedexNo::KECLEON   => [
                'weight' => 1,
                'levels' => 25,
            ],
            PokedexNo::SHUPPET   => [
                'weight' => 30,
                'levels' => [26, 28],
            ],
            PokedexNo::DUSKULL   => [
                'weight' => 30,
                'levels' => [26, 28],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::HOENN_SAFARI_ZONE_AREA_1  => [
        EncounterType::WALKING => [
            PokedexNo::PIKACHU   => [
                'weight' => 5,
                'levels' => [25, 27],
            ],
            PokedexNo::ODDISH    => [
                'weight' => 40,
                'levels' => [25, 27],
            ],
            PokedexNo::GLOOM     => [
                'weight' => 5,
                'levels' => 25,
            ],
            PokedexNo::DODUO     => [
                'weight' => 10,
                'levels' => 25,
            ],
            PokedexNo::NATU      => [
                'weight' => 10,
                'levels' => 25,
            ],
            PokedexNo::GIRAFARIG => [
                'weight' => 20,
                'levels' => [25, 27],
            ],
            PokedexNo::WOBBUFFET => [
                'weight' => 10,
                'levels' => [27, 29],
            ],
        ],
    ],
    LocationId::HOENN_SAFARI_ZONE_AREA_2  => [
        EncounterType::WALKING => [
            PokedexNo::PIKACHU   => [
                'weight' => 5,
                'levels' => [25, 27],
            ],
            PokedexNo::ODDISH    => [
                'weight' => 40,
                'levels' => [25, 27],
            ],
            PokedexNo::GLOOM     => [
                'weight' => 5,
                'levels' => 25,
            ],
            PokedexNo::DODUO     => [
                'weight' => 10,
                'levels' => 27,
            ],
            PokedexNo::NATU      => [
                'weight' => 10,
                'levels' => 25,
            ],
            PokedexNo::GIRAFARIG => [
                'weight' => 20,
                'levels' => [25, 27],
            ],
            PokedexNo::WOBBUFFET => [
                'weight' => 10,
                'levels' => [27, 29],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::PSYDUCK => [
                'weight' => 100,
                'levels' => [20, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
                'weight' => 150,
                'levels' => [5, 35],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::SEAKING  => [
                'weight' => 20,
                'levels' => [25, 40],
            ],
        ],
    ],
    LocationId::HOENN_SAFARI_ZONE_AREA_3  => [
        EncounterType::WALKING => [
            PokedexNo::ODDISH  => [
                'weight' => 30,
                'levels' => [27, 29],
            ],
            PokedexNo::GLOOM   => [
                'weight' => 15,
                'levels' => [29, 31],
            ],
            PokedexNo::DODUO   => [
                'weight' => 15,
                'levels' => [27, 29],
            ],
            PokedexNo::DODRIO  => [
                'weight' => 5,
                'levels' => [29, 31],
            ],
            PokedexNo::RHYHORN => [
                'weight' => 30,
                'levels' => [27, 29],
            ],
            PokedexNo::PINSIR  => [
                'weight' => 5,
                'levels' => [27, 29],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::PSYDUCK => [
                'weight' => 95,
                'levels' => [20, 35],
            ],
            PokedexNo::GOLDUCK => [
                'weight' => 5,
                'levels' => [25, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
                'weight' => 150,
                'levels' => [5, 35],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::SEAKING  => [
                'weight' => 20,
                'levels' => [25, 40],
            ],
        ],
    ],
    LocationId::HOENN_SAFARI_ZONE_AREA_4  => [
        EncounterType::WALKING    => [
            PokedexNo::ODDISH    => [
                'weight' => 30,
                'levels' => [27, 29],
            ],
            PokedexNo::GLOOM     => [
                'weight' => 15,
                'levels' => [29, 31],
            ],
            PokedexNo::NATU      => [
                'weight' => 15,
                'levels' => [27, 29],
            ],
            PokedexNo::XATU      => [
                'weight' => 5,
                'levels' => [29, 31],
            ],
            PokedexNo::HERACROSS => [
                'weight' => 5,
                'levels' => [27, 29],
            ],
            PokedexNo::PHANPY    => [
                'weight' => 30,
                'levels' => [27, 29],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE => [
                'weight' => 100,
                'levels' => [5, 30],
            ],
        ],
    ],
    LocationId::HOENN_SAFARI_ZONE_AREA_5  => [
        EncounterType::WALKING => [
            PokedexNo::HOOTHOOT => [
                'weight' => 5,
                'levels' => 35,
            ],
            PokedexNo::SPINARAK => [
                'weight' => 10,
                'levels' => 33,
            ],
            PokedexNo::MAREEP   => [
                'weight' => 30,
                'levels' => [34, 36],
            ],
            PokedexNo::AIPOM    => [
                'weight' => 10,
                'levels' => 34,
            ],
            PokedexNo::SUNKERN  => [
                'weight' => 30,
                'levels' => [33, 35],
            ],
            PokedexNo::GLIGAR   => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
            PokedexNo::SNUBBULL => [
                'weight' => 5,
                'levels' => 34,
            ],
            PokedexNo::STANTLER => [
                'weight' => 5,
                'levels' => [36, 39],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::MARILL   => [
                'weight' => 39,
                'levels' => [25, 35],
            ],
            PokedexNo::WOOPER   => [
                'weight' => 60,
                'levels' => [25, 30],
            ],
            PokedexNo::QUAGSIRE => [
                'weight' => 1,
                'levels' => [35, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN   => [
                'weight' => 90,
                'levels' => [25, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [25, 30],
            ],
            PokedexNo::REMORAID  => [
                'weight' => 79,
                'levels' => [25, 35],
            ],
            PokedexNo::OCTILLERY => [
                'weight' => 1,
                'levels' => [35, 40],
            ],
        ],
    ],
    LocationId::HOENN_SAFARI_ZONE_AREA_6  => [
        EncounterType::WALKING    => [
            PokedexNo::HOOTHOOT  => [
                'weight' => 5,
                'levels' => 35,
            ],
            PokedexNo::LEDYBA    => [
                'weight' => 10,
                'levels' => 33,
            ],
            PokedexNo::AIPOM     => [
                'weight' => 30,
                'levels' => [33, 35],
            ],
            PokedexNo::SUNKERN   => [
                'weight' => 10,
                'levels' => 34,
            ],
            PokedexNo::PINECO    => [
                'weight' => 5,
                'levels' => 34,
            ],
            PokedexNo::TEDDIURSA => [
                'weight' => 30,
                'levels' => [34, 36],
            ],
            PokedexNo::HOUNDOUR  => [
                'weight' => 5,
                'levels' => [36, 39],
            ],
            PokedexNo::MILTANK   => [
                'weight' => 5,
                'levels' => [37, 40],
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::SHUCKLE => [
                'weight' => 100,
                'levels' => [20, 40],
            ],
        ],
    ],
    LocationId::ROUTE_122                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::MT_PYRE_EXTERIOR          => [
        EncounterType::WALKING => [
            PokedexNo::VULPIX   => [
                'weight' => 50,
                'levels' => [25, 29],
            ],
            PokedexNo::WINGULL  => [
                'weight' => 10,
                'levels' => [26, 28],
            ],
            PokedexNo::MEDITITE => [
                'weight' => 30,
                'levels' => [27, 29],
            ],
            PokedexNo::DUSKULL  => [
                'weight' => 40,
                'levels' => [27, 29],
            ],
            PokedexNo::SHUPPET  => [
                'weight' => 100,
                'levels' => [27, 29],
            ],
        ],
    ],
    LocationId::MT_PYRE_1F                => [
        EncounterType::WALKING => [
            PokedexNo::SHUPPET => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
            PokedexNo::DUSKULL => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
        ],
    ],
    LocationId::MT_PYRE_2F                => [
        EncounterType::WALKING => [
            PokedexNo::SHUPPET => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
            PokedexNo::DUSKULL => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
        ],
    ],
    LocationId::MT_PYRE_3F                => [
        EncounterType::WALKING => [
            PokedexNo::SHUPPET => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
            PokedexNo::DUSKULL => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
        ],
    ],
    LocationId::MT_PYRE_4F                => [
        EncounterType::WALKING => [
            PokedexNo::SHUPPET => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
            PokedexNo::DUSKULL => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
        ],
    ],
    LocationId::MT_PYRE_5F                => [
        EncounterType::WALKING => [
            PokedexNo::SHUPPET => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
            PokedexNo::DUSKULL => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
        ],
    ],
    LocationId::MT_PYRE_6F                => [
        EncounterType::WALKING => [
            PokedexNo::SHUPPET => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
            PokedexNo::DUSKULL => [
                'weight' => 100,
                'levels' => [22, 29],
            ],
        ],
    ],
    LocationId::MT_PYRE_SUMMIT            => [
        EncounterType::WALKING => [
            PokedexNo::SHUPPET  => [
                'weight' => 98,
                'levels' => [24, 30],
            ],
            PokedexNo::DUSKULL  => [
                'weight' => 98,
                'levels' => [24, 30],
            ],
            PokedexNo::CHIMECHO => [
                'weight' => 2,
                'levels' => 28,
            ],
        ],
    ],
    LocationId::ROUTE_123                 => [
        EncounterType::WALKING => [
            PokedexNo::ODDISH    => [
                'weight' => 15,
                'levels' => [26, 28],
            ],
            PokedexNo::GLOOM     => [
                'weight' => 5,
                'levels' => 28,
            ],
            PokedexNo::POOCHYENA => [
                'weight' => 20,
                'levels' => 26,
            ],
            PokedexNo::MIGHTYENA => [
                'weight' => 20,
                'levels' => [26, 28],
            ],
            PokedexNo::ZIGZAGOON => [
                'weight' => 20,
                'levels' => 26,
            ],
            PokedexNo::LINOONE   => [
                'weight' => 20,
                'levels' => [26, 28],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 9,
                'levels' => [26, 28],
            ],
            PokedexNo::KECLEON   => [
                'weight' => 1,
                'levels' => 25,
            ],
            PokedexNo::SHUPPET   => [
                'weight' => 30,
                'levels' => [26, 28],
            ],
            PokedexNo::DUSKULL   => [
                'weight' => 30,
                'levels' => [26, 28],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::LILYCOVE_CITY             => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 105,
                'levels' => [10, 45],
            ],
            PokedexNo::STARYU    => [
                'weight' => 15,
                'levels' => [25, 30],
            ],
        ],
    ],
    LocationId::ROUTE_124                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
            PokedexNo::CHINCHOU  => [
                'weight' => 30,
                'levels' => [20, 30],
            ],
            PokedexNo::CLAMPERL  => [
                'weight' => 65,
                'levels' => [20, 35],
            ],
            PokedexNo::RELICANTH => [
                'weight' => 5,
                'levels' => [30, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::MOSSDEEP_CITY             => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_125                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::SHOAL_CAVE_MAIN_CAVE      => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT  => [
                'weight' => 45,
                'levels' => [26, 32],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 5,
                'levels' => 32,
            ],
            PokedexNo::SPHEAL => [
                'weight' => 50,
                'levels' => [26, 32],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::ZUBAT     => [
                'weight' => 30,
                'levels' => [5, 35],
            ],
            PokedexNo::SPHEAL    => [
                'weight' => 10,
                'levels' => [25, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::SHOAL_CAVE_ICE_ROOM       => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT   => [
                'weight' => 40,
                'levels' => [26, 30],
            ],
            PokedexNo::GOLBAT  => [
                'weight' => 5,
                'levels' => [30, 32],
            ],
            PokedexNo::SNORUNT => [
                'weight' => 10,
                'levels' => [26, 30],
            ],
            PokedexNo::SPHEAL  => [
                'weight' => 45,
                'levels' => [26, 32],
            ],
        ],
    ],
    LocationId::ROUTE_126                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
            PokedexNo::CHINCHOU  => [
                'weight' => 30,
                'levels' => [20, 30],
            ],
            PokedexNo::CLAMPERL  => [
                'weight' => 65,
                'levels' => [20, 35],
            ],
            PokedexNo::RELICANTH => [
                'weight' => 5,
                'levels' => [30, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::SOOTOPOLIS_CITY           => [
        EncounterType::SURFING => [
            PokedexNo::MAGIKARP => [
                'weight' => 100,
                'levels' => [5, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 30,
                'levels' => [5, 10],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 250,
                'levels' => [5, 35],
            ],
            PokedexNo::GYARADOS  => [
                'weight' => 20,
                'levels' => [5, 45],
            ],
        ],
    ],
    LocationId::CAVE_OF_ORIGIN            => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT   => [
                'weight' => 150,
                'levels' => [28, 35],
            ],
            PokedexNo::GOLBAT  => [
                'weight' => 20,
                'levels' => [33, 36],
            ],
            PokedexNo::SABLEYE => [
                'weight' => 30,
                'levels' => [30, 34],
            ],
            PokedexNo::MAWILE  => [
                'weight' => 30,
                'levels' => [30, 34],
            ],
        ],
    ],
    LocationId::ROUTE_127                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_128                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 30,
                'levels' => [5, 10],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 65,
                'levels' => [10, 45],
            ],
            PokedexNo::LUVDISC   => [
                'weight' => 60,
                'levels' => [10, 35],
            ],
            PokedexNo::CORSOLA   => [
                'weight' => 15,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::SEAFLOOR_CAVERN           => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT  => [
                'weight' => 90,
                'levels' => [28, 35],
            ],
            PokedexNo::GOLBAT => [
                'weight' => 10,
                'levels' => [33, 36],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::ZUBAT     => [
                'weight' => 35,
                'levels' => [5, 35],
            ],
            PokedexNo::GOLBAT    => [
                'weight' => 5,
                'levels' => [30, 35],
            ],
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 120,
                'levels' => [10, 45],
            ],
        ],
    ],
    LocationId::ROUTE_129                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 4,
                'levels' => [25, 30],
            ],
            PokedexNo::WAILORD   => [
                'weight' => 2,
                'levels' => [25, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_130                 => [
        EncounterType::WALKING => [
            PokedexNo::WYNAUT => [
                'weight' => 100,
                'levels' => [5, 50],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_131                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::SKY_PILLAR_1F             => [
        EncounterType::WALKING => [
            PokedexNo::GOLBAT   => [
                'weight' => 60,
                'levels' => [34, 50],
            ],
            PokedexNo::SABLEYE  => [
                'weight' => 60,
                'levels' => [33, 50],
            ],
            PokedexNo::MAWILE   => [
                'weight' => 30,
                'levels' => [48, 50],
            ],
            PokedexNo::CLAYDOL  => [
                'weight' => 50,
                'levels' => [36, 50],
            ],
            PokedexNo::BANETTE  => [
                'weight' => 30,
                'levels' => [37, 50],
            ],
            PokedexNo::DUSCLOPS => [
                'weight' => 15,
                'levels' => [48, 50],
            ],
        ],
    ],
    LocationId::SKY_PILLAR_3F             => [
        EncounterType::WALKING => [
            PokedexNo::GOLBAT   => [
                'weight' => 60,
                'levels' => [34, 53],
            ],
            PokedexNo::SABLEYE  => [
                'weight' => 60,
                'levels' => [33, 53],
            ],
            PokedexNo::MAWILE   => [
                'weight' => 30,
                'levels' => [51, 53],
            ],
            PokedexNo::CLAYDOL  => [
                'weight' => 50,
                'levels' => [36, 53],
            ],
            PokedexNo::BANETTE  => [
                'weight' => 30,
                'levels' => [37, 53],
            ],
            PokedexNo::DUSCLOPS => [
                'weight' => 15,
                'levels' => [51, 53],
            ],
        ],
    ],
    LocationId::SKY_PILLAR_5F             => [
        EncounterType::WALKING => [
            PokedexNo::GOLBAT   => [
                'weight' => 60,
                'levels' => [34, 56],
            ],
            PokedexNo::SABLEYE  => [
                'weight' => 60,
                'levels' => [33, 56],
            ],
            PokedexNo::MAWILE   => [
                'weight' => 30,
                'levels' => [54, 56],
            ],
            PokedexNo::CLAYDOL  => [
                'weight' => 38,
                'levels' => [36, 56],
            ],
            PokedexNo::BANETTE  => [
                'weight' => 30,
                'levels' => [37, 56],
            ],
            PokedexNo::DUSCLOPS => [
                'weight' => 15,
                'levels' => [54, 56],
            ],
            PokedexNo::ALTARIA  => [
                'weight' => 12,
                'levels' => [38, 60],
            ],
        ],
    ],
    LocationId::PACIFIDLOG_TOWN           => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 80,
                'levels' => [10, 45],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_132                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 65,
                'levels' => [10, 45],
            ],
            PokedexNo::HORSEA    => [
                'weight' => 15,
                'levels' => [25, 30],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_133                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 65,
                'levels' => [10, 45],
            ],
            PokedexNo::HORSEA    => [
                'weight' => 15,
                'levels' => [25, 30],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::ROUTE_134                 => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 65,
                'levels' => [10, 45],
            ],
            PokedexNo::HORSEA    => [
                'weight' => 15,
                'levels' => [25, 30],
            ],
            PokedexNo::SHARPEDO  => [
                'weight' => 40,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::EVER_GRANDE_CITY          => [
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 60,
                'levels' => [5, 35],
            ],
            PokedexNo::WINGULL   => [
                'weight' => 35,
                'levels' => [10, 30],
            ],
            PokedexNo::PELIPPER  => [
                'weight' => 5,
                'levels' => [25, 30],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 30,
                'levels' => [5, 10],
            ],
            PokedexNo::MAGIKARP  => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::WAILMER   => [
                'weight' => 65,
                'levels' => [10, 45],
            ],
            PokedexNo::LUVDISC   => [
                'weight' => 60,
                'levels' => [10, 35],
            ],
            PokedexNo::CORSOLA   => [
                'weight' => 15,
                'levels' => [30, 35],
            ],
        ],
    ],
    LocationId::HOENN_VICTORY_ROAD_1F     => [
        EncounterType::WALKING => [
            PokedexNo::ZUBAT    => [
                'weight' => 10,
                'levels' => 36,
            ],
            PokedexNo::GOLBAT   => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::WHISMUR  => [
                'weight' => 5,
                'levels' => 36,
            ],
            PokedexNo::LOUDRED  => [
                'weight' => 10,
                'levels' => 40,
            ],
            PokedexNo::MAKUHITA => [
                'weight' => 10,
                'levels' => 36,
            ],
            PokedexNo::HARIYAMA => [
                'weight' => 25,
                'levels' => [38, 40],
            ],
            PokedexNo::ARON     => [
                'weight' => 5,
                'levels' => 36,
            ],
            PokedexNo::LAIRON   => [
                'weight' => 10,
                'levels' => 40,
            ],
        ],
    ],
    LocationId::HOENN_VICTORY_ROAD_B1F    => [
        EncounterType::WALKING    => [
            PokedexNo::GOLBAT   => [
                'weight' => 35,
                'levels' => [38, 42],
            ],
            PokedexNo::HARIYAMA => [
                'weight' => 35,
                'levels' => [38, 42],
            ],
            PokedexNo::MAWILE   => [
                'weight' => 5,
                'levels' => 38,
            ],
            PokedexNo::LAIRON   => [
                'weight' => 40,
                'levels' => [40, 42],
            ],
            PokedexNo::MEDITITE => [
                'weight' => 5,
                'levels' => 38,
            ],
            PokedexNo::MEDICHAM => [
                'weight' => 10,
                'levels' => 40,
            ],
        ],
        EncounterType::ROCK_SMASH => [
            PokedexNo::GEODUDE  => [
                'weight' => 30,
                'levels' => [30, 40],
            ],
            PokedexNo::GRAVELER => [
                'weight' => 70,
                'levels' => [30, 40],
            ],
        ],
    ],
    LocationId::HOENN_VICTORY_ROAD_B2F    => [
        EncounterType::WALKING => [
            PokedexNo::GOLBAT   => [
                'weight' => 35,
                'levels' => [40, 44],
            ],
            PokedexNo::SABLEYE  => [
                'weight' => 35,
                'levels' => [40, 44],
            ],
            PokedexNo::MAWILE   => [
                'weight' => 40,
                'levels' => [40, 44],
            ],
            PokedexNo::LAIRON   => [
                'weight' => 40,
                'levels' => [40, 44],
            ],
            PokedexNo::MEDICHAM => [
                'weight' => 15,
                'levels' => [40, 44],
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::GOLBAT => [
                'weight' => 100,
                'levels' => [25, 40],
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::GOLDEEN  => [
                'weight' => 50,
                'levels' => [5, 30],
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 130,
                'levels' => [5, 30],
            ],
            PokedexNo::BARBOACH => [
                'weight' => 100,
                'levels' => [10, 35],
            ],
            PokedexNo::WHISCASH => [
                'weight' => 20,
                'levels' => [30, 45],
            ],
        ],
    ],
];
