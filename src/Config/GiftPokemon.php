<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;

return [
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
];
