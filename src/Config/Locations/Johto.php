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
            Direction::W => LocationId::ROUTE_27,
        ],
    ],
    [
        'id' => LocationId::ROUTE_27,
        'name' => "Route 27",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_26,
            Direction::W => LocationId::NEW_BARK_TOWN,
            LocationId::TOHJO_FALLS,
        ],
    ],
    [
        'id' => LocationId::TOHJO_FALLS,
        'name' => "Tohjo Falls",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_27,
        ],
    ],
    [
        'id' => LocationId::ROUTE_28,
        'name' => "Route 28",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::POKEMON_LEAGUE_FRONT_GATE,
            LocationId::MT_SILVER_EXTERIOR,
        ],
    ],
    [
        'id' => LocationId::MT_SILVER_EXTERIOR,
        'name' => "Mt. Silver",
        'section' => "Exterior",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_SILVER,
        'directions' => [
            Direction::U => LocationId::MT_SILVER_1F,
            LocationId::ROUTE_28,
        ],
    ],
    [
        'id' => LocationId::MT_SILVER_1F,
        'name' => "Mt. Silver",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_SILVER,
        'directions' => [
            Direction::U => LocationId::MT_SILVER_2F,
            Direction::D => LocationId::MT_SILVER_EXTERIOR,
        ],
    ],
    [
        'id' => LocationId::MT_SILVER_2F,
        'name' => "Mt. Silver",
        'section' => "2nd Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_SILVER,
        'directions' => [
            Direction::U => LocationId::MT_SILVER_3F,
            Direction::D => LocationId::MT_SILVER_1F,
        ],
    ],
    [
        'id' => LocationId::MT_SILVER_3F,
        'name' => "Mt. Silver",
        'section' => "3rd Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_SILVER,
        'directions' => [
            Direction::U => LocationId::MT_SILVER_LOWER_MOUNTAINSIDE,
            Direction::D => LocationId::MT_SILVER_2F,
        ],
    ],
    [
        'id' => LocationId::MT_SILVER_LOWER_MOUNTAINSIDE,
        'name' => "Mt. Silver",
        'section' => "Lower Mountainside",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_SILVER,
        'directions' => [
            Direction::U => LocationId::MT_SILVER_UPPER_MOUNTAINSIDE,
            Direction::D => LocationId::MT_SILVER_3F,
        ],
    ],
    [
        'id' => LocationId::MT_SILVER_UPPER_MOUNTAINSIDE,
        'name' => "Mt. Silver",
        'section' => "Upper Mountainside",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_SILVER,
        'directions' => [
            Direction::U => LocationId::MT_SILVER_SUMMIT,
            Direction::D => LocationId::MT_SILVER_LOWER_MOUNTAINSIDE,
        ],
    ],
    [
        'id' => LocationId::MT_SILVER_SUMMIT,
        'name' => "Mt. Silver",
        'section' => "Summit",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_SILVER,
        'directions' => [
            Direction::D => LocationId::MT_SILVER_UPPER_MOUNTAINSIDE,
        ],
    ],
    [
        'id' => LocationId::NEW_BARK_TOWN,
        'name' => "New Bark Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_27,
            Direction::W => LocationId::ROUTE_29,
        ],
    ],
    [
        'id' => LocationId::ROUTE_29,
        'name' => "Route 29",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::NEW_BARK_TOWN,
            Direction::W => LocationId::CHERRYGROVE_CITY,
        ],
    ],
    [
        'id' => LocationId::CHERRYGROVE_CITY,
        'name' => "Cherrygrove City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_30,
            Direction::E => LocationId::ROUTE_29,
        ],
    ],
    [
        'id' => LocationId::ROUTE_30,
        'name' => "Route 30",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::S => LocationId::CHERRYGROVE_CITY,
        ],
    ],
];
