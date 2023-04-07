<?php
declare(strict_types=1);

use ConorSmith\Pokemon\Direction;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\LocationType;

return [
    [
        'id' => LocationId::ROUTE_26,
        'name' => "Route 26",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::POKEMON_LEAGUE_FRONT_GATE,
        ],
    ],
];
