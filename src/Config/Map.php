<?php
declare(strict_types=1);

use ConorSmith\Pokemon\Direction;
use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\LocationType;
use ConorSmith\Pokemon\PokedexNo;

return [
    [
        'id' => LocationId::PALLET_TOWN,
        'name' => "Pallet Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_1,
            Direction::S => LocationId::ROUTE_21,
        ],
    ],
    [
        'id' => LocationId::ROUTE_1,
        'name' => "Route 1",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::VIRIDIAN_CITY,
            Direction::S => LocationId::PALLET_TOWN,
        ],
    ],
    [
        'id' => LocationId::VIRIDIAN_CITY,
        'name' => "Viridian City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_2,
            Direction::W => LocationId::ROUTE_22,
            LocationId::VIRIDIAN_GYM,
            Direction::S => LocationId::ROUTE_1,
        ],
    ],
    [
        'id' => LocationId::VIRIDIAN_GYM,
        'name' => "Viridian Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::VIRIDIAN_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_2,
        'name' => "Route 2",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::PEWTER_CITY,
            LocationId::VIRIDIAN_FOREST,
            LocationId::DIGLETTS_CAVE,
            Direction::S => LocationId::VIRIDIAN_CITY,
        ],
    ],
    [
        'id' => LocationId::PEWTER_CITY,
        'name' => "Pewter City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_3,
            LocationId::PEWTER_GYM,
            Direction::S => LocationId::ROUTE_2,
        ],
    ],
    [
        'id' => LocationId::PEWTER_GYM,
        'name' => "Pewter Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::PEWTER_CITY,
        ],
    ],
    [
        'id' => LocationId::VIRIDIAN_FOREST,
        'name' => "Viridian Forest",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_2,
        ],
    ],
    [
        'id' => LocationId::DIGLETTS_CAVE,
        'name' => "Diglett's Cave",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_2,
            LocationId::ROUTE_11,
        ],
    ],
    [
        'id' => LocationId::ROUTE_3,
        'name' => "Route 3",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::PEWTER_CITY,
            Direction::E => LocationId::MT_MOON_F1,
        ],
    ],
    [
        'id' => LocationId::MT_MOON_F1,
        'name' => "Mt. Moon",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_MOON,
        'directions' => [
            LocationId::ROUTE_3,
            Direction::D => LocationId::MT_MOON_BF1,
        ],
    ],
    [
        'id' => LocationId::MT_MOON_BF1,
        'name' => "Mt. Moon",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_MOON,
        'directions' => [
            Direction::U => LocationId::MT_MOON_F1,
            Direction::D => LocationId::MT_MOON_BF2,
        ],
    ],
    [
        'id' => LocationId::MT_MOON_BF2,
        'name' => "Mt. Moon",
        'section' => "2nd Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_MOON,
        'directions' => [
            Direction::U => LocationId::MT_MOON_BF1,
            LocationId::ROUTE_4,
        ],
    ],
    [
        'id' => LocationId::ROUTE_4,
        'name' => "Route 4",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::MT_MOON_BF2,
            Direction::E => LocationId::CERULEAN_CITY,
        ],
    ],
    [
        'id' => LocationId::CERULEAN_CITY,
        'name' => "Cerulean City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_24,
            Direction::W => LocationId::ROUTE_4,
            Direction::E => LocationId::ROUTE_9,
            Direction::S => LocationId::ROUTE_5,
            LocationId::CERULEAN_GYM,
        ],
    ],
    [
        'id' => LocationId::CERULEAN_GYM,
        'name' => "Cerulean Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::CERULEAN_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_5,
        'name' => "Route 5",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::CERULEAN_CITY,
            Direction::S => LocationId::SAFFRON_CITY,
        ],
    ],
    [
        'id' => LocationId::SAFFRON_CITY,
        'name' => "Saffron City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_5,
            Direction::W => LocationId::ROUTE_7,
            Direction::E => LocationId::ROUTE_8,
            Direction::S => LocationId::ROUTE_6,
            LocationId::SAFFRON_GYM,
            LocationId::SILPH_CO_1F,
        ],
    ],
    [
        'id' => LocationId::SAFFRON_GYM,
        'name' => "Saffron Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::SAFFRON_CITY,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_1F,
        'name' => "Silph Co",
        'section' => "1st Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_2F,
            LocationId::SAFFRON_CITY,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_2F,
        'name' => "Silph Co",
        'section' => "2nd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_3F,
            Direction::D => LocationId::SILPH_CO_1F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_3F,
        'name' => "Silph Co",
        'section' => "3rd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_4F,
            Direction::D => LocationId::SILPH_CO_2F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_4F,
        'name' => "Silph Co",
        'section' => "4th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_5F,
            Direction::D => LocationId::SILPH_CO_3F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_5F,
        'name' => "Silph Co",
        'section' => "5th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_6F,
            Direction::D => LocationId::SILPH_CO_4F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_6F,
        'name' => "Silph Co",
        'section' => "6th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_7F,
            Direction::D => LocationId::SILPH_CO_5F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_7F,
        'name' => "Silph Co",
        'section' => "7th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_8F,
            Direction::D => LocationId::SILPH_CO_6F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_8F,
        'name' => "Silph Co",
        'section' => "8th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_9F,
            Direction::D => LocationId::SILPH_CO_7F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_9F,
        'name' => "Silph Co",
        'section' => "9th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_10F,
            Direction::D => LocationId::SILPH_CO_8F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_10F,
        'name' => "Silph Co",
        'section' => "10th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::U => LocationId::SILPH_CO_11F,
            Direction::D => LocationId::SILPH_CO_9F,
        ],
    ],
    [
        'id' => LocationId::SILPH_CO_11F,
        'name' => "Silph Co",
        'section' => "11th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::SILPH_CO,
        'directions' => [
            Direction::D => LocationId::SILPH_CO_10F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_6,
        'name' => "Route 6",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::SAFFRON_CITY,
            Direction::S => LocationId::VERMILLION_CITY,
        ],
    ],
    [
        'id' => LocationId::VERMILLION_CITY,
        'name' => "Vermillion City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_6,
            Direction::E => LocationId::ROUTE_11,
            LocationId::VERMILLION_GYM,
            LocationId::VERMILLION_HARBOUR,
        ],
    ],
    [
        'id' => LocationId::VERMILLION_GYM,
        'name' => "Vermillion Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::VERMILLION_CITY,
        ],
    ],
    [
        'id' => LocationId::VERMILLION_HARBOUR,
        'name' => "Vermillion Harbour",
        'directions' => [
            LocationId::VERMILLION_CITY,
            LocationId::SS_ANNE_1F,
            LocationId::SEAGALLOP_FERRY,
        ],
    ],
    [
        'id' => LocationId::SS_ANNE_1F,
        'name' => "S.S. Anne",
        'section' => "1st Floor",
        'area' => LocationId::SS_ANNE,
        'directions' => [
            LocationId::VERMILLION_HARBOUR,
            Direction::D => LocationId::SS_ANNE_B1F,
            Direction::U => LocationId::SS_ANNE_2F,
        ],
    ],
    [
        'id' => LocationId::SS_ANNE_B1F,
        'name' => "S.S. Anne",
        'section' => "Basement 1st Floor",
        'area' => LocationId::SS_ANNE,
        'directions' => [
            Direction::U => LocationId::SS_ANNE_1F,
        ],
    ],
    [
        'id' => LocationId::SS_ANNE_2F,
        'name' => "S.S. Anne",
        'section' => "2nd Floor",
        'area' => LocationId::SS_ANNE,
        'directions' => [
            Direction::D => LocationId::SS_ANNE_1F,
            Direction::U => LocationId::SS_ANNE_DECK,
        ],
    ],
    [
        'id' => LocationId::SS_ANNE_DECK,
        'name' => "S.S. Anne",
        'section' => "Deck",
        'area' => LocationId::SS_ANNE,
        'directions' => [
            Direction::D => LocationId::SS_ANNE_2F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_7,
        'name' => "Route 7",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::CELADON_CITY,
            Direction::E => LocationId::SAFFRON_CITY,
        ],
    ],
    [
        'id' => LocationId::CELADON_CITY,
        'name' => "Celadon City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::W => LocationId::ROUTE_16,
            Direction::E => LocationId::ROUTE_7,
            LocationId::CELADON_GYM,
            LocationId::ROCKET_GAME_CORNER,
        ],
    ],
    [
        'id' => LocationId::CELADON_GYM,
        'name' => "Celadon Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::CELADON_CITY,
        ],
    ],
    [
        'id' => LocationId::ROCKET_GAME_CORNER,
        'name' => "Rocket Game Corner",
        'type' => LocationType::TOWER,
        'directions' => [
            LocationId::CELADON_CITY,
            Direction::D => LocationId::TEAM_ROCKET_HIDEOUT_B1F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HIDEOUT_B1F,
        'name' => "Team Rocket Hideout",
        'section' => "1st Basement Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::TEAM_ROCKET_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::ROCKET_GAME_CORNER,
            Direction::D => LocationId::TEAM_ROCKET_HIDEOUT_B2F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HIDEOUT_B2F,
        'name' => "Team Rocket Hideout",
        'section' => "2nd Basement Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::TEAM_ROCKET_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::TEAM_ROCKET_HIDEOUT_B1F,
            Direction::D => LocationId::TEAM_ROCKET_HIDEOUT_B3F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HIDEOUT_B3F,
        'name' => "Team Rocket Hideout",
        'section' => "3rd Basement Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::TEAM_ROCKET_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::TEAM_ROCKET_HIDEOUT_B2F,
            Direction::D => LocationId::TEAM_ROCKET_HIDEOUT_B4F,
        ],
    ],
    [
        'id' => LocationId::TEAM_ROCKET_HIDEOUT_B4F,
        'name' => "Team Rocket Hideout",
        'section' => "4th Basement Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::TEAM_ROCKET_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::TEAM_ROCKET_HIDEOUT_B3F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_8,
        'name' => "Route 8",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::SAFFRON_CITY,
            Direction::E => LocationId::LAVENDER_TOWN,
        ],
    ],
    [
        'id' => LocationId::LAVENDER_TOWN,
        'name' => "Lavender Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_10,
            Direction::W => LocationId::ROUTE_8,
            Direction::S => LocationId::ROUTE_12,
            LocationId::POKEMON_TOWER_1F,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_1F,
        'name' => "Pokémon Tower",
        'section' => "1st Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::POKEMON_TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_2F,
            LocationId::LAVENDER_TOWN,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_2F,
        'name' => "Pokémon Tower",
        'section' => "2nd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::POKEMON_TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_3F,
            Direction::D => LocationId::POKEMON_TOWER_1F,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_3F,
        'name' => "Pokémon Tower",
        'section' => "3rd Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::POKEMON_TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_4F,
            Direction::D => LocationId::POKEMON_TOWER_2F,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_4F,
        'name' => "Pokémon Tower",
        'section' => "4th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::POKEMON_TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_5F,
            Direction::D => LocationId::POKEMON_TOWER_3F,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_5F,
        'name' => "Pokémon Tower",
        'section' => "5th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::POKEMON_TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_6F,
            Direction::D => LocationId::POKEMON_TOWER_4F,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_6F,
        'name' => "Pokémon Tower",
        'section' => "6th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::POKEMON_TOWER,
        'directions' => [
            Direction::U => LocationId::POKEMON_TOWER_7F,
            Direction::D => LocationId::POKEMON_TOWER_5F,
        ],
    ],
    [
        'id' => LocationId::POKEMON_TOWER_7F,
        'name' => "Pokémon Tower",
        'section' => "7th Floor",
        'type' => LocationType::TOWER,
        'area' => LocationId::POKEMON_TOWER,
        'directions' => [
            Direction::D => LocationId::POKEMON_TOWER_6F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_9,
        'name' => "Route 9",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::CERULEAN_CITY,
            Direction::S => LocationId::ROCK_TUNNEL_1F,
            LocationId::POWER_PLANT,
        ],
    ],
    [
        'id' => LocationId::POWER_PLANT,
        'name' => "Power Plant",
        'type' => LocationType::TOWER,
        'directions' => [
            LocationId::ROUTE_9,
        ],
    ],
    [
        'id' => LocationId::ROCK_TUNNEL_1F,
        'name' => "Rock Tunnel",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::ROCK_TUNNEL,
        'directions' => [
            LocationId::ROUTE_9,
            Direction::D => LocationId::ROCK_TUNNEL_B1F,
            LocationId::ROUTE_10,
        ],
    ],
    [
        'id' => LocationId::ROCK_TUNNEL_B1F,
        'name' => "Rock Tunnel",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::ROCK_TUNNEL,
        'directions' => [
            Direction::U => LocationId::ROCK_TUNNEL_1F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_10,
        'name' => "Route 10",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROCK_TUNNEL_1F,
            Direction::S => LocationId::LAVENDER_TOWN,
        ],
    ],
    [
        'id' => LocationId::ROUTE_11,
        'name' => "Route 11",
        'type' => LocationType::ROUTE,
        'directions' => [
            LocationId::DIGLETTS_CAVE,
            Direction::W => LocationId::VERMILLION_CITY,
            Direction::E => LocationId::ROUTE_12,
        ],
    ],
    [
        'id' => LocationId::ROUTE_12,
        'name' => "Route 12",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::LAVENDER_TOWN,
            Direction::W => LocationId::ROUTE_11,
            Direction::S => LocationId::ROUTE_13,
        ],
    ],
    [
        'id' => LocationId::ROUTE_13,
        'name' => "Route 13",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::ROUTE_14,
            Direction::N => LocationId::ROUTE_12,
        ],
    ],
    [
        'id' => LocationId::ROUTE_14,
        'name' => "Route 14",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_13,
            Direction::S => LocationId::ROUTE_15,
        ],
    ],
    [
        'id' => LocationId::ROUTE_15,
        'name' => "Route 15",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::FUCHSIA_CITY,
            Direction::N => LocationId::ROUTE_14,
        ],
    ],
    [
        'id' => LocationId::FUCHSIA_CITY,
        'name' => "Fuchsia City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::SAFARI_ZONE_S,
            Direction::W => LocationId::ROUTE_18,
            Direction::E => LocationId::ROUTE_15,
            Direction::S => LocationId::ROUTE_19,
            LocationId::FUCHSIA_GYM,
        ],
    ],
    [
        'id' => LocationId::FUCHSIA_GYM,
        'name' => "Fuchsia Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::FUCHSIA_CITY,
        ],
    ],
    [
        'id' => LocationId::SAFARI_ZONE_S,
        'name' => "Safari Zone",
        'section' => "South",
        'directions' => [
            Direction::N => LocationId::SAFARI_ZONE_N,
            Direction::W => LocationId::SAFARI_ZONE_W,
            Direction::E => LocationId::SAFARI_ZONE_E,
            Direction::S => LocationId::FUCHSIA_CITY,
        ],
    ],
    [
        'id' => LocationId::SAFARI_ZONE_N,
        'name' => "Safari Zone",
        'section' => "North",
        'directions' => [
            Direction::W => LocationId::SAFARI_ZONE_W,
            Direction::E => LocationId::SAFARI_ZONE_E,
            Direction::S => LocationId::SAFARI_ZONE_S,
        ],
    ],
    [
        'id' => LocationId::SAFARI_ZONE_E,
        'name' => "Safari Zone",
        'section' => "East",
        'directions' => [
            Direction::N => LocationId::SAFARI_ZONE_N,
            Direction::S => LocationId::SAFARI_ZONE_S,
        ],
    ],
    [
        'id' => LocationId::SAFARI_ZONE_W,
        'name' => "Safari Zone",
        'section' => "West",
        'directions' => [
            Direction::N => LocationId::SAFARI_ZONE_N,
            Direction::S => LocationId::SAFARI_ZONE_S,
        ],
    ],
    [
        'id' => LocationId::ROUTE_16,
        'name' => "Route 16",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::CELADON_CITY,
            Direction::S => LocationId::ROUTE_17,
        ],
    ],
    [
        'id' => LocationId::ROUTE_17,
        'name' => "Route 17",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_16,
            Direction::S => LocationId::ROUTE_18,
        ],
    ],
    [
        'id' => LocationId::ROUTE_18,
        'name' => "Route 18",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_17,
            Direction::E => LocationId::FUCHSIA_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_19,
        'name' => "Route 19",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::FUCHSIA_CITY,
            Direction::W => LocationId::ROUTE_20,
        ],
    ],
    [
        'id' => LocationId::ROUTE_20,
        'name' => "Route 20",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::CINNABAR_ISLAND,
            LocationId::SEAFOAM_ISLANDS_1F,
            Direction::E => LocationId::ROUTE_19,
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_1F,
        'name' => "Seafoam Islands",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_20,
            Direction::D => LocationId::SEAFOAM_ISLANDS_B1F,
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_B1F,
        'name' => "Seafoam Islands",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::SEAFOAM_ISLANDS_1F,
            Direction::D => LocationId::SEAFOAM_ISLANDS_B2F,
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_B2F,
        'name' => "Seafoam Islands",
        'section' => "2nd Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::SEAFOAM_ISLANDS_B1F,
            Direction::D => LocationId::SEAFOAM_ISLANDS_B3F,
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_B3F,
        'name' => "Seafoam Islands",
        'section' => "3rd Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::SEAFOAM_ISLANDS_B2F,
            Direction::D => LocationId::SEAFOAM_ISLANDS_B4F,
        ],
    ],
    [
        'id' => LocationId::SEAFOAM_ISLANDS_B4F,
        'name' => "Seafoam Islands",
        'section' => "4th Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::SEAFOAM_ISLANDS_B3F,
        ],
    ],
    [
        'id' => LocationId::CINNABAR_ISLAND,
        'name' => "Cinnabar Island",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_21,
            LocationId::POKEMON_MANSION,
            LocationId::CINNABAR_GYM,
            Direction::E => LocationId::ROUTE_20,
        ],
    ],
    [
        'id' => LocationId::CINNABAR_GYM,
        'name' => "Cinnabar Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::CINNABAR_ISLAND,
        ],
    ],
    [
        'id' => LocationId::POKEMON_MANSION,
        'name' => "Pokémon Mansion",
        'type' => LocationType::TOWER,
        'directions' => [
            LocationId::CINNABAR_ISLAND,
        ],
    ],
    [
        'id' => LocationId::ROUTE_21,
        'name' => "Route 21",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::PALLET_TOWN,
            Direction::S => LocationId::CINNABAR_ISLAND,
        ],
    ],
    [
        'id' => LocationId::ROUTE_22,
        'name' => "Route 22",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::VICTORY_ROAD_1F,
            Direction::E => LocationId::VIRIDIAN_CITY,
        ],
    ],
    [
        'id' => LocationId::VICTORY_ROAD_1F,
        'name' => "Victory Road",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::VICTORY_ROAD,
        'directions' => [
            Direction::U => LocationId::VICTORY_ROAD_2F,
            LocationId::ROUTE_22,
        ],
    ],
    [
        'id' => LocationId::VICTORY_ROAD_2F,
        'name' => "Victory Road",
        'section' => "2nd Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::VICTORY_ROAD,
        'directions' => [
            Direction::D => LocationId::VICTORY_ROAD_1F,
            Direction::U => LocationId::VICTORY_ROAD_3F,
        ],
    ],
    [
        'id' => LocationId::VICTORY_ROAD_3F,
        'name' => "Victory Road",
        'section' => "3rd Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::VICTORY_ROAD,
        'directions' => [
            LocationId::ROUTE_23,
            Direction::D => LocationId::VICTORY_ROAD_2F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_23,
        'name' => "Route 23",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::INDIGO_PLATEAU,
            Direction::S => LocationId::VICTORY_ROAD_3F,
        ],
    ],
    [
        'id' => LocationId::INDIGO_PLATEAU,
        'name' => "Indigo Plateau",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::ROUTE_23,
        ],
    ],
    [
        'id' => LocationId::ROUTE_24,
        'name' => "Route 24",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_25,
            Direction::S => LocationId::CERULEAN_CITY,
            LocationId::CERULEAN_CAVE_1F,
        ],
    ],
    [
        'id' => LocationId::ROUTE_25,
        'name' => "Route 25",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::ROUTE_24,
        ],
    ],
    [
        'id' => LocationId::CERULEAN_CAVE_1F,
        'name' => "Cerulean Cave",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_24,
            Direction::U => LocationId::CERULEAN_CAVE_2F,
            Direction::D => LocationId::CERULEAN_CAVE_B1F,
        ],
    ],
    [
        'id' => LocationId::CERULEAN_CAVE_2F,
        'name' => "Cerulean Cave",
        'section' => "2nd Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::D => LocationId::CERULEAN_CAVE_1F,
        ],
    ],
    [
        'id' => LocationId::CERULEAN_CAVE_B1F,
        'name' => "Cerulean Cave",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::U => LocationId::CERULEAN_CAVE_1F,
        ],
    ],
    [
        'id' => LocationId::SEAGALLOP_FERRY,
        'name' => "Seagallop Ferry",
        'directions' => [
            LocationId::VERMILLION_HARBOUR,
            LocationId::KNOT_ISLAND,
            LocationId::BOON_ISLAND,
        ],
    ],
    [
        'id' => LocationId::KNOT_ISLAND,
        'name' => "Knot Island",
        'directions' => [
            Direction::E => LocationId::KINDLE_ROAD,
            Direction::S => LocationId::TREASURE_BEACH,
            LocationId::SEAGALLOP_FERRY,
        ],
    ],
    [
        'id' => LocationId::TREASURE_BEACH,
        'name' => "Treasure Beach",
        'directions' => [
            Direction::N => LocationId::KNOT_ISLAND,
        ],
    ],
    [
        'id' => LocationId::KINDLE_ROAD,
        'name' => "Kindle Road",
        'directions' => [
            Direction::N => LocationId::MT_EMBER_BASE,
            Direction::W => LocationId::KNOT_ISLAND,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_BASE,
        'name' => "Mt. Ember",
        'section' => "Base",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            LocationId::MT_EMBER_SUMMIT_PATH_1,
            LocationId::MT_EMBER_1F,
            LocationId::KINDLE_ROAD,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_SUMMIT_PATH_1,
        'name' => "Mt. Ember",
        'section' => "Trail Lv 1",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::U => LocationId::MT_EMBER_SUMMIT_PATH_2,
            Direction::D => LocationId::MT_EMBER_BASE,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_SUMMIT_PATH_2,
        'name' => "Mt. Ember",
        'section' => "Trail Lv 2",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::U => LocationId::MT_EMBER_SUMMIT_PATH_3,
            Direction::D => LocationId::MT_EMBER_SUMMIT_PATH_1,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_SUMMIT_PATH_3,
        'name' => "Mt. Ember",
        'section' => "Trail Lv 3",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::U => LocationId::MT_EMBER_SUMMIT,
            Direction::D => LocationId::MT_EMBER_SUMMIT_PATH_2,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_SUMMIT,
        'name' => "Mt. Ember",
        'section' => "Summit",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::D => LocationId::MT_EMBER_SUMMIT_PATH_3,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_1F,
        'name' => "Mt. Ember",
        'section' => "1st Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::D => LocationId::MT_EMBER_B1F,
            LocationId::MT_EMBER_BASE,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_B1F,
        'name' => "Mt. Ember",
        'section' => "1st Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::U => LocationId::MT_EMBER_1F,
            Direction::D => LocationId::MT_EMBER_B2F,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_B2F,
        'name' => "Mt. Ember",
        'section' => "2nd Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::U => LocationId::MT_EMBER_B1F,
            Direction::D => LocationId::MT_EMBER_B3F,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_B3F,
        'name' => "Mt. Ember",
        'section' => "3rd Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::U => LocationId::MT_EMBER_B2F,
            Direction::D => LocationId::MT_EMBER_B4F,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_B4F,
        'name' => "Mt. Ember",
        'section' => "4th Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::U => LocationId::MT_EMBER_B3F,
            Direction::D => LocationId::MT_EMBER_B5F,
        ],
    ],
    [
        'id' => LocationId::MT_EMBER_B5F,
        'name' => "Mt. Ember",
        'section' => "5th Basement Floor",
        'type' => LocationType::CAVE,
        'area' => LocationId::MT_EMBER,
        'directions' => [
            Direction::U => LocationId::MT_EMBER_B4F,
        ],
    ],
    [
        'id' => LocationId::BOON_ISLAND,
        'name' => "Boon Island",
        'directions' => [
            Direction::N => LocationId::CAPE_BRINK,
            LocationId::SEAGALLOP_FERRY,
        ],
    ],
    [
        'id' => LocationId::CAPE_BRINK,
        'name' => "Cape Brink",
        'directions' => [
            Direction::S => LocationId::BOON_ISLAND,
        ],
    ],
];
