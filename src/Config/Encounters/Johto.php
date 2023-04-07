<?php
declare(strict_types=1);

use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;

return [
    LocationId::ROUTE_26 => [
        EncounterType::WALKING => [
            PokedexNo::RATICATE => [
                'weight' => 140,
                'levels' => [28, 30],
            ],
            PokedexNo::ARBOK => [
                'weight' => 5,
                'levels' => 30,
            ],
            PokedexNo::SANDSLASH => [
                'weight' => 30,
                'levels' => 28,
            ],
            PokedexNo::PONYTA => [
                'weight' => 20,
                'levels' => 32,
            ],
            PokedexNo::DODUO => [
                'weight' => 40,
                'levels' => [28, 30],
            ],
            PokedexNo::DODRIO => [
                'weight' => 5,
                'levels' => 30,
            ],
            PokedexNo::QUAGSIRE => [
                'weight' => 15,
                'levels' => 30,
            ],
        ],
        EncounterType::SURFING => [
            PokedexNo::TENTACOOL => [
                'weight' => 90,
                'levels' => [25, 30],
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 10,
                'levels' => 30,
            ],
        ],
        EncounterType::FISHING => [
            PokedexNo::TENTACOOL => [
                'weight' => 35,
                'levels' => 10,
            ],
            PokedexNo::MAGIKARP => [
                'weight' => 155,
                'levels' => 10,
            ],
            PokedexNo::SHELLDER => [
                'weight' => 33,
                'levels' => 20,
            ],
            PokedexNo::CHINCHOU => [
                'weight' => 67,
                'levels' => 20,
            ],
            PokedexNo::TENTACRUEL => [
                'weight' => 7,
                'levels' => 40,
            ],
            PokedexNo::LANTURN => [
                'weight' => 3,
                'levels' => 40,
            ],
        ],
    ],
];
