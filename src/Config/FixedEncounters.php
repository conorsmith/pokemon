<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;

return [

    // KANTO
    [
        'pokemon'  => PokedexNo::SNORLAX,
        'location' => LocationId::ROUTE_12,
        'level'    => 30,
    ],
    [
        'pokemon'  => PokedexNo::SNORLAX,
        'location' => LocationId::ROUTE_16,
        'level'    => 30,
    ],

    // JOHTO
    [
        'pokemon'  => PokedexNo::SUDOWOODO,
        'location' => LocationId::ROUTE_36,
        'level'    => 20,
    ],

];
