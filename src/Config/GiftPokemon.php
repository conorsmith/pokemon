<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

return [

    // KANTO
    [
        'pokemon'  => PokedexNo::BULBASAUR,
        'location' => LocationId::PROFESSOR_OAKS_LAB,
        'level'    => 5,
    ],
    [
        'pokemon'  => PokedexNo::CHARMANDER,
        'location' => LocationId::PROFESSOR_OAKS_LAB,
        'level'    => 5,
    ],
    [
        'pokemon'  => PokedexNo::SQUIRTLE,
        'location' => LocationId::PROFESSOR_OAKS_LAB,
        'level'    => 5,
    ],
    [
        'pokemon'      => PokedexNo::HITMONLEE,
        'location'     => LocationId::FIGHTING_DOJO,
        'level'        => 30,
        'requirements' => [
            'clear' => LocationId::FIGHTING_DOJO,
        ],
    ],
    [
        'pokemon'      => PokedexNo::HITMONCHAN,
        'location'     => LocationId::FIGHTING_DOJO,
        'level'        => 30,
        'requirements' => [
            'clear' => LocationId::FIGHTING_DOJO,
        ],
    ],
    [
        'pokemon'      => PokedexNo::LAPRAS,
        'location'     => LocationId::SILPH_CO_7F,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::SILPH_CO,
        ],
    ],
    [
        'pokemon'  => PokedexNo::EEVEE,
        'location' => LocationId::CELADON_CONDOMINIUMS,
        'level'    => 25,
    ],
    [
        'pokemon'      => PokedexNo::ABRA,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 9,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'pokemon'      => PokedexNo::CLEFAIRY,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 12,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'pokemon'      => PokedexNo::SCYTHER,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 25,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'pokemon'      => PokedexNo::PINSIR,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 18,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'pokemon'      => PokedexNo::DRATINI,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 24,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'pokemon'      => PokedexNo::PORYGON,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 26,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],

    // JOHTO
    [
        'pokemon'  => PokedexNo::CHIKORITA,
        'location' => LocationId::PROFESSOR_ELMS_LAB,
        'level'    => 5,
    ],
    [
        'pokemon'  => PokedexNo::CYNDAQUIL,
        'location' => LocationId::PROFESSOR_ELMS_LAB,
        'level'    => 5,
    ],
    [
        'pokemon'  => PokedexNo::TOTODILE,
        'location' => LocationId::PROFESSOR_ELMS_LAB,
        'level'    => 5,
    ],
    [
        'pokemon'  => PokedexNo::EEVEE,
        'location' => LocationId::GOLDENROD_BILLS_HOUSE,
        'level'    => 20,
    ],
    [
        'pokemon'  => PokedexNo::TOGEPI,
        'location' => LocationId::VIOLET_CITY,
        'isEgg'    => true,
    ],
    [
        'pokemon'  => PokedexNo::TYROGUE,
        'location' => LocationId::MT_MORTAR_B1F,
        'level'    => 10,
        'requirements' => [
            'defeat' => "64edd8b1-68ae-4c4c-8b85-7c349319749e",
        ],
    ],
    [
        'pokemon'      => PokedexNo::ABRA,
        'location'     => LocationId::GOLDENROD_GAME_CORNER,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::GOLDENROD_TUNNEL,
        ],
    ],
    [
        'pokemon'      => PokedexNo::EKANS,
        'location'     => LocationId::GOLDENROD_GAME_CORNER,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::GOLDENROD_TUNNEL,
        ],
    ],
    [
        'pokemon'      => PokedexNo::SANDSHREW,
        'location'     => LocationId::GOLDENROD_GAME_CORNER,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::GOLDENROD_TUNNEL,
        ],
    ],
    [
        'pokemon'      => PokedexNo::DRATINI,
        'location'     => LocationId::GOLDENROD_GAME_CORNER,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::GOLDENROD_TUNNEL,
        ],
    ],

    // HOENN
    [
        'pokemon'  => PokedexNo::TREECKO,
        'location' => LocationId::PROFESSOR_BIRCHS_LAB,
        'level'    => 5,
    ],
    [
        'pokemon'  => PokedexNo::TORCHIC,
        'location' => LocationId::PROFESSOR_BIRCHS_LAB,
        'level'    => 5,
    ],
    [
        'pokemon'  => PokedexNo::MUDKIP,
        'location' => LocationId::PROFESSOR_BIRCHS_LAB,
        'level'    => 5,
    ],
    [
        'pokemon'  => PokedexNo::WYNAUT,
        'location' => LocationId::HOT_SPRINGS,
        'isEgg'    => true,
    ],
    [
        'pokemon'  => PokedexNo::CASTFORM,
        'location' => LocationId::WEATHER_INSTITUTE_2F,
        'level'    => 25,
        'requirements' => [
            'clear' => LocationId::WEATHER_INSTITUTE,
        ],
    ],
    [
        'pokemon'  => PokedexNo::BELDUM,
        'location' => LocationId::STEVENS_HOUSE,
        'level'    => 5,
        'requirements' => [
            'victory' => RegionId::HOENN,
        ],
    ],
];
