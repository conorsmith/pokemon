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
            Direction::N => LocationId::ROUTE_31,
            Direction::S => LocationId::CHERRYGROVE_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_31,
        'name' => "Route 31",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::VIOLET_CITY,
            Direction::S => LocationId::ROUTE_30,
            LocationId::DARK_CAVE_WEST,
        ],
    ],
    [
        'id' => LocationId::DARK_CAVE_WEST,
        'name' => "Dark Cave",
        'section' => "West",
        'type' => LocationType::CAVE,
        'area' => LocationId::DARK_CAVE,
        'directions' => [
            Direction::E => LocationId::DARK_CAVE_EAST,
            LocationId::ROUTE_31,
        ],
    ],
    [
        'id' => LocationId::DARK_CAVE_EAST,
        'name' => "Dark Cave",
        'section' => "East",
        'type' => LocationType::CAVE,
        'area' => LocationId::DARK_CAVE,
        'directions' => [
            Direction::W => LocationId::DARK_CAVE_WEST,
        ],
    ],
    [
        'id' => LocationId::VIOLET_CITY,
        'name' => "Violet City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_31,
            Direction::S => LocationId::ROUTE_32,
            LocationId::VIOLET_GYM,
            LocationId::SPROUT_TOWER_1F,
        ],
    ],
    [
        'id' => LocationId::VIOLET_GYM,
        'name' => "Violet Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::VIOLET_CITY,
        ],
    ],
    [
        'id' => LocationId::SPROUT_TOWER_1F,
        'name' => "Sprout Tower",
        'section' => "1st Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SPROUT_TOWER,
        'directions' => [
            Direction::U => LocationId::SPROUT_TOWER_2F,
            LocationId::VIOLET_CITY,
        ],
    ],
    [
        'id' => LocationId::SPROUT_TOWER_2F,
        'name' => "Sprout Tower",
        'section' => "2nd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SPROUT_TOWER,
        'directions' => [
            Direction::U => LocationId::SPROUT_TOWER_3F,
            Direction::D => LocationId::SPROUT_TOWER_1F,
        ],
    ],
    [
        'id' => LocationId::SPROUT_TOWER_3F,
        'name' => "Sprout Tower",
        'section' => "3rd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SPROUT_TOWER,
        'directions' => [
            Direction::D => LocationId::SPROUT_TOWER_2F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_32,
        'name' => "Route 32",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::VIOLET_CITY,
            Direction::W => LocationId::RUINS_OF_ALPH_OUTSIDE,
            Direction::S => LocationId::UNION_CAVE_1F,
        ],
    ],
    [
        'id' => LocationId::RUINS_OF_ALPH_OUTSIDE,
        'name' => "Ruins of Alph",
        'section' => "Outside",
        'type' => LocationType::CAVE,
        'area' => LocationId::RUINS_OF_ALPH,
        'directions' => [
            Direction::E => LocationId::ROUTE_32,
            LocationId::RUINS_OF_ALPH_CHAMBER,
        ],
    ],
    [
        'id' => LocationId::RUINS_OF_ALPH_CHAMBER,
        'name' => "Ruins of Alph",
        'section' => "Chamber",
        'type' => LocationType::CAVE,
        'area' => LocationId::RUINS_OF_ALPH,
        'directions' => [
            LocationId::RUINS_OF_ALPH_OUTSIDE,
        ],
    ],
    [
        'id' => LocationId::UNION_CAVE_1F,
        'name' => "Union Cave",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::UNION_CAVE,
        'directions' => [
            Direction::D => LocationId::UNION_CAVE_B1F,
            LocationId::ROUTE_32,
        ],
    ],
    [
        'id' => LocationId::UNION_CAVE_B1F,
        'name' => "Union Cave",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::UNION_CAVE,
        'directions' => [
            Direction::U => LocationId::UNION_CAVE_1F,
            Direction::D => LocationId::UNION_CAVE_B2F,
        ],
    ],
    [
        'id' => LocationId::UNION_CAVE_B2F,
        'name' => "Union Cave",
        'section' => "2nd Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::UNION_CAVE,
        'directions' => [
            Direction::U => LocationId::UNION_CAVE_B1F,
            LocationId::ROUTE_33,
        ],
    ],
    [
        'id' => LocationId::ROUTE_33,
        'name' => "Route 33",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::UNION_CAVE_B2F,
            Direction::W => LocationId::AZALEA_TOWN,
        ],
    ],
    [
        'id' => LocationId::AZALEA_TOWN,
        'name' => "Azalea Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_33,
            Direction::W => LocationId::ILEX_FOREST,
            LocationId::AZALEA_GYM,
            LocationId::SLOWPOKE_WELL_ENTRANCE,
        ],
    ],
    [
        'id' => LocationId::AZALEA_GYM,
        'name' => "Azalea Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::AZALEA_TOWN,
        ],
    ],
    [
        'id' => LocationId::SLOWPOKE_WELL_ENTRANCE,
        'name' => "Slowpoke Well",
        'section' => "Entrance",
        'type' => LocationType::CAVE,
        'area' => LocationId::SLOWPOKE_WELL,
        'directions' => [
            Direction::D => LocationId::SLOWPOKE_WELL_B1F,
            LocationId::AZALEA_TOWN,
        ],
    ],
    [
        'id' => LocationId::SLOWPOKE_WELL_B1F,
        'name' => "Slowpoke Well",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::SLOWPOKE_WELL,
        'directions' => [
            Direction::U => LocationId::SLOWPOKE_WELL_ENTRANCE,
            Direction::D => LocationId::SLOWPOKE_WELL_B2F,
        ],
    ],
    [
        'id' => LocationId::SLOWPOKE_WELL_B2F,
        'name' => "Slowpoke Well",
        'section' => "2nd Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::SLOWPOKE_WELL,
        'directions' => [
            Direction::U => LocationId::SLOWPOKE_WELL_B1F,
        ],
    ],
    [
        'id' => LocationId::ILEX_FOREST,
        'name' => "Ilex Forest",
        'directions' => [
            Direction::N => LocationId::ROUTE_34,
            Direction::E => LocationId::AZALEA_TOWN,
        ],
    ],
    [
        'id' => LocationId::ROUTE_34,
        'name' => "Route 34",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::GOLDENROD_CITY,
            Direction::S => LocationId::ILEX_FOREST,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_CITY,
        'name' => "Goldenrod City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::S => LocationId::ROUTE_34,
            LocationId::GOLDENROD_RADIO_TOWER_1F,
            LocationId::GOLDENROD_TUNNEL_B1F,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_TUNNEL_B1F,
        'name' => "Goldenrod Tunnel",
        'section' => "1st Basement Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GOLDENROD_TUNNEL,
        'directions' => [
            Direction::U => LocationId::GOLDENROD_CITY,
            Direction::D => LocationId::GOLDENROD_TUNNEL_B2F,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_TUNNEL_B2F,
        'name' => "Goldenrod Tunnel",
        'section' => "2nd Basement Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GOLDENROD_TUNNEL,
        'directions' => [
            Direction::U => LocationId::GOLDENROD_TUNNEL_B1F,
            Direction::D => LocationId::GOLDENROD_TUNNEL_WAREHOUSE,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_TUNNEL_WAREHOUSE,
        'name' => "Goldenrod Tunnel",
        'section' => "Warehouse",
        'type' => LocationType::TOWER,
        'area' => LocationId::GOLDENROD_TUNNEL,
        'directions' => [
            Direction::U => LocationId::GOLDENROD_TUNNEL_B2F,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_RADIO_TOWER_1F,
        'name' => "Goldenrod Radio Tower",
        'section' => "1st Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GOLDENROD_RADIO_TOWER,
        'directions' => [
            Direction::U => LocationId::GOLDENROD_RADIO_TOWER_2F,
            Direction::D => LocationId::GOLDENROD_CITY,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_RADIO_TOWER_2F,
        'name' => "Goldenrod Radio Tower",
        'section' => "2nd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GOLDENROD_RADIO_TOWER,
        'directions' => [
            Direction::U => LocationId::GOLDENROD_RADIO_TOWER_3F,
            Direction::D => LocationId::GOLDENROD_RADIO_TOWER_1F,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_RADIO_TOWER_3F,
        'name' => "Goldenrod Radio Tower",
        'section' => "3rd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GOLDENROD_RADIO_TOWER,
        'directions' => [
            Direction::U => LocationId::GOLDENROD_RADIO_TOWER_4F,
            Direction::D => LocationId::GOLDENROD_RADIO_TOWER_2F,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_RADIO_TOWER_4F,
        'name' => "Goldenrod Radio Tower",
        'section' => "4th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GOLDENROD_RADIO_TOWER,
        'directions' => [
            Direction::U => LocationId::GOLDENROD_RADIO_TOWER_5F,
            Direction::D => LocationId::GOLDENROD_RADIO_TOWER_3F,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_RADIO_TOWER_5F,
        'name' => "Goldenrod Radio Tower",
        'section' => "5th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GOLDENROD_RADIO_TOWER,
        'directions' => [
            Direction::U => LocationId::GOLDENROD_RADIO_TOWER_OBSERVATION_DECK,
            Direction::D => LocationId::GOLDENROD_RADIO_TOWER_4F,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_RADIO_TOWER_OBSERVATION_DECK,
        'name' => "Goldenrod Radio Tower",
        'section' => "Observation Deck",
        'type' => LocationType::TOWER,
        'area' => LocationId::GOLDENROD_RADIO_TOWER,
        'directions' => [
            Direction::D => LocationId::GOLDENROD_RADIO_TOWER_5F,
        ],
    ],
];
