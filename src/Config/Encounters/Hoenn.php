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
];
