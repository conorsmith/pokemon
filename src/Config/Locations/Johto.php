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
            Direction::W => LocationId::ROUTE_36,
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
            Direction::N => LocationId::ROUTE_36,
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
            Direction::N => LocationId::ROUTE_35,
            Direction::S => LocationId::ROUTE_34,
            LocationId::GOLDENROD_RADIO_TOWER_1F,
            LocationId::GOLDENROD_TUNNEL_B1F,
            LocationId::GOLDENROD_MAGNET_TRAIN_STATION,
            LocationId::GOLDENROD_GYM,
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
    [
        'id' => LocationId::GOLDENROD_MAGNET_TRAIN_STATION,
        'name' => "Goldenrod Station",
        'directions' => [
            LocationId::MAGNET_TRAIN,
            LocationId::GOLDENROD_CITY,
        ],
    ],
    [
        'id' => LocationId::MAGNET_TRAIN,
        'name' => "Magnet Train",
        'directions' => [
            LocationId::GOLDENROD_MAGNET_TRAIN_STATION,
            LocationId::SAFFRON_MAGNET_TRAIN_STATION,
        ],
    ],
    [
        'id' => LocationId::GOLDENROD_GYM,
        'name' => "Goldenrod Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::GOLDENROD_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_35,
        'name' => "Route 35",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::NATIONAL_PARK,
            Direction::S => LocationId::GOLDENROD_CITY,
        ],
    ],
    [
        'id' => LocationId::NATIONAL_PARK,
        'name' => "National Park",
        'directions' => [
            Direction::E => LocationId::ROUTE_36,
            Direction::S => LocationId::ROUTE_35,
        ],
    ],
    [
        'id' => LocationId::ROUTE_36,
        'name' => "Route 36",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_37,
            Direction::E => LocationId::VIOLET_CITY,
            Direction::W => LocationId::NATIONAL_PARK,
            Direction::S => LocationId::RUINS_OF_ALPH_OUTSIDE,
        ],
    ],
    [
        'id' => LocationId::ROUTE_37,
        'name' => "Route 37",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ECRUTEAK_CITY,
            Direction::S => LocationId::ROUTE_36,
        ],
    ],
    [
        'id' => LocationId::ECRUTEAK_CITY,
        'name' => "Ecruteak City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_42,
            Direction::W => LocationId::ROUTE_38,
            Direction::S => LocationId::ROUTE_37,
            LocationId::ECRUTEAK_DANCE_THEATRE,
            LocationId::BURNED_TOWER_1F,
            LocationId::BELL_TOWER_1F,
            LocationId::ECRUTEAK_GYM,
        ],
    ],
    [
        'id' => LocationId::ECRUTEAK_GYM,
        'name' => "Ecruteak Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::ECRUTEAK_CITY,
        ],
    ],
    [
        'id' => LocationId::BURNED_TOWER_1F,
        'name' => "Burned Tower",
        'section' => "1st Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BURNED_TOWER,
        'directions' => [
            Direction::U => LocationId::ECRUTEAK_CITY,
            Direction::D => LocationId::BURNED_TOWER_B1F,
        ],
    ],
    [
        'id' => LocationId::BURNED_TOWER_B1F,
        'name' => "Burned Tower",
        'section' => "1st Basement Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BURNED_TOWER,
        'directions' => [
            Direction::U => LocationId::BURNED_TOWER_1F,
        ],
    ],
    [
        'id' => LocationId::ECRUTEAK_DANCE_THEATRE,
        'name' => "Ecruteak Dance Theatre",
        'directions' => [
            LocationId::ECRUTEAK_CITY,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_1F,
        'name' => "Bell Tower",
        'section' => "1st Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_2F,
            Direction::D => LocationId::ECRUTEAK_CITY,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_2F,
        'name' => "Bell Tower",
        'section' => "2nd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_3F,
            Direction::D => LocationId::BELL_TOWER_1F,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_3F,
        'name' => "Bell Tower",
        'section' => "3rd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_4F,
            Direction::D => LocationId::BELL_TOWER_2F,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_4F,
        'name' => "Bell Tower",
        'section' => "4th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_5F,
            Direction::D => LocationId::BELL_TOWER_3F,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_5F,
        'name' => "Bell Tower",
        'section' => "5th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_6F,
            Direction::D => LocationId::BELL_TOWER_4F,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_6F,
        'name' => "Bell Tower",
        'section' => "6th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_7F,
            Direction::D => LocationId::BELL_TOWER_5F,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_7F,
        'name' => "Bell Tower",
        'section' => "7th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_8F,
            Direction::D => LocationId::BELL_TOWER_6F,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_8F,
        'name' => "Bell Tower",
        'section' => "8th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_9F,
            Direction::D => LocationId::BELL_TOWER_7F,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_9F,
        'name' => "Bell Tower",
        'section' => "9th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_10F,
            Direction::D => LocationId::BELL_TOWER_8F,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_10F,
        'name' => "Bell Tower",
        'section' => "10th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::U => LocationId::BELL_TOWER_ROOF,
            Direction::D => LocationId::BELL_TOWER_9F,
        ],
    ],
    [
        'id' => LocationId::BELL_TOWER_ROOF,
        'name' => "Bell Tower",
        'section' => "Roof",
        'type' => LocationType::TOWER,
        'area' => LocationId::BELL_TOWER,
        'directions' => [
            Direction::D => LocationId::BELL_TOWER_10F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_38,
        'name' => "Route 38",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ECRUTEAK_CITY,
            Direction::W => LocationId::ROUTE_39,
        ],
    ],
    [
        'id' => LocationId::ROUTE_39,
        'name' => "Route 39",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_38,
            Direction::S => LocationId::OLIVINE_CITY,
        ],
    ],
    [
        'id' => LocationId::OLIVINE_CITY,
        'name' => "Olivine City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_39,
            Direction::W => LocationId::ROUTE_40,
            LocationId::GLITTER_LIGHTHOUSE_1F,
            LocationId::SS_AQUA_1F,
            LocationId::OLIVINE_GYM,
        ],
    ],
    [
        'id' => LocationId::OLIVINE_GYM,
        'name' => "Olivine Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::OLIVINE_CITY,
        ],
    ],
    [
        'id' => LocationId::GLITTER_LIGHTHOUSE_1F,
        'name' => "Glitter Lighthouse",
        'section' => "1st Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GLITTER_LIGHTHOUSE,
        'directions' => [
            Direction::U => LocationId::GLITTER_LIGHTHOUSE_2F,
            Direction::D => LocationId::OLIVINE_CITY,
        ],
    ],
    [
        'id' => LocationId::GLITTER_LIGHTHOUSE_2F,
        'name' => "Glitter Lighthouse",
        'section' => "2nd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GLITTER_LIGHTHOUSE,
        'directions' => [
            Direction::U => LocationId::GLITTER_LIGHTHOUSE_3F,
            Direction::D => LocationId::GLITTER_LIGHTHOUSE_1F,
        ],
    ],
    [
        'id' => LocationId::GLITTER_LIGHTHOUSE_3F,
        'name' => "Glitter Lighthouse",
        'section' => "3rd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GLITTER_LIGHTHOUSE,
        'directions' => [
            Direction::U => LocationId::GLITTER_LIGHTHOUSE_EXTERIOR,
            Direction::D => LocationId::GLITTER_LIGHTHOUSE_2F,
        ],
    ],
    [
        'id' => LocationId::GLITTER_LIGHTHOUSE_EXTERIOR,
        'name' => "Glitter Lighthouse",
        'section' => "Exterior",
        'type' => LocationType::TOWER,
        'area' => LocationId::GLITTER_LIGHTHOUSE,
        'directions' => [
            Direction::U => LocationId::GLITTER_LIGHTHOUSE_4F,
            Direction::D => LocationId::GLITTER_LIGHTHOUSE_3F,
        ],
    ],
    [
        'id' => LocationId::GLITTER_LIGHTHOUSE_4F,
        'name' => "Glitter Lighthouse",
        'section' => "4th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GLITTER_LIGHTHOUSE,
        'directions' => [
            Direction::U => LocationId::GLITTER_LIGHTHOUSE_5F,
            Direction::D => LocationId::GLITTER_LIGHTHOUSE_EXTERIOR,
        ],
    ],
    [
        'id' => LocationId::GLITTER_LIGHTHOUSE_5F,
        'name' => "Glitter Lighthouse",
        'section' => "5th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::GLITTER_LIGHTHOUSE,
        'directions' => [
            Direction::U => LocationId::GLITTER_LIGHTHOUSE_LIGHT_ROOM,
            Direction::D => LocationId::GLITTER_LIGHTHOUSE_4F,
        ],
    ],
    [
        'id' => LocationId::GLITTER_LIGHTHOUSE_LIGHT_ROOM,
        'name' => "Glitter Lighthouse",
        'section' => "Light Room",
        'type' => LocationType::TOWER,
        'area' => LocationId::GLITTER_LIGHTHOUSE,
        'directions' => [
            Direction::D => LocationId::GLITTER_LIGHTHOUSE_5F,
        ],
    ],
    [
        'id' => LocationId::SS_AQUA_1F,
        'name' => "SS Aqua",
        'section' => "Upper Deck",
        'area' => LocationId::SS_AQUA,
        'directions' => [
            Direction::D => LocationId::SS_AQUA_B1F,
            LocationId::OLIVINE_CITY,
            LocationId::VERMILLION_HARBOUR,
        ],
    ],
    [
        'id' => LocationId::SS_AQUA_B1F,
        'name' => "SS Aqua",
        'section' => "Lower Deck",
        'area' => LocationId::SS_AQUA,
        'directions' => [
            Direction::U => LocationId::SS_AQUA_1F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_40,
        'name' => "Route 40",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::OLIVINE_CITY,
            Direction::S => LocationId::ROUTE_41,
        ],
    ],
    [
        'id' => LocationId::ROUTE_41,
        'name' => "Route 41",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_40,
            Direction::W => LocationId::CIANWOOD_CITY,
            LocationId::WHIRL_ISLANDS_1F,
        ],
    ],
    [
        'id' => LocationId::WHIRL_ISLANDS_1F,
        'name' => "Whirl Islands",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::WHIRL_ISLANDS,
        'directions' => [
            Direction::U => LocationId::ROUTE_41,
            Direction::D => LocationId::WHIRL_ISLANDS_B1F,
        ],
    ],
    [
        'id' => LocationId::WHIRL_ISLANDS_B1F,
        'name' => "Whirl Islands",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::WHIRL_ISLANDS,
        'directions' => [
            Direction::U => LocationId::WHIRL_ISLANDS_1F,
            Direction::D => LocationId::WHIRL_ISLANDS_B2F,
        ],
    ],
    [
        'id' => LocationId::WHIRL_ISLANDS_B2F,
        'name' => "Whirl Islands",
        'section' => "2nd Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::WHIRL_ISLANDS,
        'directions' => [
            Direction::U => LocationId::WHIRL_ISLANDS_B1F,
            Direction::D => LocationId::WHIRL_ISLANDS_B3F,
        ],
    ],
    [
        'id' => LocationId::WHIRL_ISLANDS_B3F,
        'name' => "Whirl Islands",
        'section' => "3rd Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::WHIRL_ISLANDS,
        'directions' => [
            Direction::U => LocationId::WHIRL_ISLANDS_B2F,
        ],
    ],
    [
        'id' => LocationId::CIANWOOD_CITY,
        'name' => "Cianwood City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_41,
            Direction::W => LocationId::CLIFF_GATE_EDGE,
            LocationId::CIANWOOD_GYM,
        ],
    ],
    [
        'id' => LocationId::CIANWOOD_GYM,
        'name' => "Cianwood Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::CIANWOOD_CITY,
        ],
    ],
    [
        'id' => LocationId::CLIFF_GATE_EDGE,
        'name' => "Cliff Gate Edge",
        'directions' => [
            Direction::E => LocationId::CIANWOOD_CITY,
            Direction::W => LocationId::ROUTE_47,
        ],
    ],
    [
        'id' => LocationId::ROUTE_47,
        'name' => "Route 47",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_48,
            Direction::E => LocationId::CLIFF_GATE_EDGE,
            LocationId::CLIFF_CAVE,
        ],
    ],
    [
        'id' => LocationId::CLIFF_CAVE,
        'name' => "Cliff Cave",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_47,
        ],
    ],
    [
        'id' => LocationId::ROUTE_48,
        'name' => "Route 48",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::JOHTO_SAFARI_ZONE_GATE,
            Direction::S => LocationId::ROUTE_47,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_GATE,
        'name' => "Safari Zone",
        'section' => "Gate",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            Direction::S => LocationId::ROUTE_48,
            LocationId::JOHTO_SAFARI_ZONE_PEAK,
            LocationId::JOHTO_SAFARI_ZONE_DESERT,
            LocationId::JOHTO_SAFARI_ZONE_PLAINS,
            LocationId::JOHTO_SAFARI_ZONE_MEADOW,
            LocationId::JOHTO_SAFARI_ZONE_FOREST,
            LocationId::JOHTO_SAFARI_ZONE_SWAMP,
            LocationId::JOHTO_SAFARI_ZONE_MARSHLAND,
            LocationId::JOHTO_SAFARI_ZONE_MOUNTAIN,
            LocationId::JOHTO_SAFARI_ZONE_ROCKY_BEACH,
            LocationId::JOHTO_SAFARI_ZONE_WASTELAND,
            LocationId::JOHTO_SAFARI_ZONE_SAVANNAH,
            LocationId::JOHTO_SAFARI_ZONE_WETLAND,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_PEAK,
        'name' => "Safari Zone",
        'section' => "Peak",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_DESERT,
        'name' => "Safari Zone",
        'section' => "Desert",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_PLAINS,
        'name' => "Safari Zone",
        'section' => "Plains",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_MEADOW,
        'name' => "Safari Zone",
        'section' => "Meadow",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_FOREST,
        'name' => "Safari Zone",
        'section' => "Forest",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_SWAMP,
        'name' => "Safari Zone",
        'section' => "Swamp",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_MARSHLAND,
        'name' => "Safari Zone",
        'section' => "Marshland",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_MOUNTAIN,
        'name' => "Safari Zone",
        'section' => "Mountain",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_ROCKY_BEACH,
        'name' => "Safari Zone",
        'section' => "Rocky Beach",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_WASTELAND,
        'name' => "Safari Zone",
        'section' => "Wasteland",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_SAVANNAH,
        'name' => "Safari Zone",
        'section' => "Savannah",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::JOHTO_SAFARI_ZONE_WETLAND,
        'name' => "Safari Zone",
        'section' => "Wetland",
        'area' => LocationId::JOHTO_SAFARI_ZONE,
        'directions' => [
            LocationId::JOHTO_SAFARI_ZONE_GATE,
        ],
    ],
    [
        'id' => LocationId::ROUTE_42,
        'name' => "Route 42",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::MT_MORTAR_1F_ENTRANCE,
            Direction::E => LocationId::MAHOGANY_TOWN,
            Direction::W => LocationId::ECRUTEAK_CITY,
        ],
    ],
    [
        'id' => LocationId::MT_MORTAR_1F_ENTRANCE,
        'name' => "Mt Mortar",
        'section' => "1st Floor (Entrance)",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_MORTAR,
        'directions' => [
            Direction::U => LocationId::MT_MORTAR_2F,
            Direction::D => LocationId::MT_MORTAR_B1F,
            LocationId::MT_MORTAR_1F_BACK,
            LocationId::ROUTE_42,
        ],
    ],
    [
        'id' => LocationId::MT_MORTAR_1F_BACK,
        'name' => "Mt Mortar",
        'section' => "1st Floor (Back)",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_MORTAR,
        'directions' => [
            LocationId::MT_MORTAR_1F_ENTRANCE,
        ],
    ],
    [
        'id' => LocationId::MT_MORTAR_2F,
        'name' => "Mt Mortar",
        'section' => "2nd Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_MORTAR,
        'directions' => [
            Direction::D => LocationId::MT_MORTAR_1F_ENTRANCE,
        ],
    ],
    [
        'id' => LocationId::MT_MORTAR_B1F,
        'name' => "Mt Mortar",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_MORTAR,
        'directions' => [
            Direction::U => LocationId::MT_MORTAR_1F_ENTRANCE,
        ],
    ],
    [
        'id' => LocationId::MAHOGANY_TOWN,
        'name' => "Mahogany Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::W => LocationId::ROUTE_42,
            LocationId::MAHOGANY_SOUVENIR_SHOP,
            LocationId::MAHOGANY_GYM,
        ],
    ],
    [
        'id' => LocationId::MAHOGANY_GYM,
        'name' => "Mahogany Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::MAHOGANY_TOWN,
        ],
    ],
    [
        'id' => LocationId::MAHOGANY_SOUVENIR_SHOP,
        'name' => "Souvenir Shop",
        'area' => LocationId::TEAM_ROCKET_HQ,
        'directions' => [
            Direction::D => LocationId::TEAM_ROCKET_HQ_B1F,
            LocationId::MAHOGANY_TOWN,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HQ_B1F,
        'name' => "Team Rocket HQ",
        'section' => "1st Basement Floor",
        'area' => LocationId::TEAM_ROCKET_HQ,
        'directions' => [
            Direction::U => LocationId::MAHOGANY_SOUVENIR_SHOP,
            Direction::D => LocationId::TEAM_ROCKET_HQ_B2F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HQ_B2F,
        'name' => "Team Rocket HQ",
        'section' => "2nd Basement Floor",
        'area' => LocationId::TEAM_ROCKET_HQ,
        'directions' => [
            Direction::U => LocationId::TEAM_ROCKET_HQ_B1F,
            Direction::D => LocationId::TEAM_ROCKET_HQ_B3F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HQ_B3F,
        'name' => "Team Rocket HQ",
        'section' => "3rd Basement Floor",
        'area' => LocationId::TEAM_ROCKET_HQ,
        'directions' => [
            Direction::U => LocationId::TEAM_ROCKET_HQ_B2F,
        ],
    ],
];
