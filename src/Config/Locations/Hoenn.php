<?php

declare(strict_types=1);

use ConorSmith\Pokemon\Location\Domain\Direction;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationType;

return [
    [
        'id'         => LocationId::LITTLEROOT_TOWN,
        'name'       => "Littleroot Town",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_101,
            LocationId::PROFESSOR_BIRCHS_LAB,
        ],
    ],
    [
        'id'         => LocationId::PROFESSOR_BIRCHS_LAB,
        'name'       => "Professor Birch's Lab",
        'directions' => [
            LocationId::LITTLEROOT_TOWN,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_101,
        'name'       => "Route 101",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::OLDALE_TOWN,
            Direction::S => LocationId::LITTLEROOT_TOWN,
        ],
    ],
    [
        'id'         => LocationId::OLDALE_TOWN,
        'name'       => "Oldale Town",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_103,
            Direction::W => LocationId::ROUTE_102,
            Direction::S => LocationId::ROUTE_101,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_102,
        'name'       => "Route 102",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::OLDALE_TOWN,
            Direction::W => LocationId::PETALBURG_CITY,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_103,
        'name'       => "Route 103",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_110,
            Direction::S => LocationId::OLDALE_TOWN,
        ],
    ],
    [
        'id'         => LocationId::PETALBURG_CITY,
        'name'       => "Petalburg City",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_102,
            Direction::W => LocationId::ROUTE_104,
            LocationId::PETALBURG_GYM,
        ],
    ],
    [
        'id'         => LocationId::PETALBURG_GYM,
        'name'       => "Petalburg Gym",
        'type'       => LocationType::GYM,
        'directions' => [
            LocationId::PETALBURG_CITY,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_104,
        'name'       => "Route 104",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::RUSTBORO_CITY,
            Direction::E => LocationId::PETALBURG_CITY,
            Direction::S => LocationId::ROUTE_105,
            LocationId::PETALBURG_WOODS,
        ],
    ],
    [
        'id'         => LocationId::PETALBURG_WOODS,
        'name'       => "Petalburg Woods",
        'directions' => [
            LocationId::ROUTE_104,
        ],
    ],
    [
        'id'         => LocationId::RUSTBORO_CITY,
        'name'       => "Rustboro City",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_115,
            Direction::E => LocationId::ROUTE_116,
            Direction::S => LocationId::ROUTE_104,
            LocationId::RUSTBORO_GYM,
        ],
    ],
    [
        'id'         => LocationId::RUSTBORO_GYM,
        'name'       => "Rustboro Gym",
        'type'       => LocationType::GYM,
        'directions' => [
            LocationId::RUSTBORO_CITY,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_116,
        'name'       => "Route 116",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::RUSTBORO_CITY,
            Direction::E => LocationId::RUSTURF_TUNNEL,
        ],
    ],
    [
        'id'         => LocationId::RUSTURF_TUNNEL,
        'name'       => "Rusturf Tunnel",
        'type'       => LocationType::CAVE,
        'directions' => [
            Direction::W => LocationId::ROUTE_116,
            Direction::S => LocationId::VERDANTURF_TOWN,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_105,
        'name'       => "Route 105",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_104,
            Direction::S => LocationId::ROUTE_106,
            LocationId::ISLAND_CAVE,
        ],
    ],
    [
        'id'         => LocationId::ISLAND_CAVE,
        'name'       => "Island Cave",
        'type'       => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_105,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_106,
        'name'       => "Route 106",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_105,
            Direction::S => LocationId::DEWFORD_TOWN,
            LocationId::GRANITE_CAVE_1F,
        ],
    ],
    [
        'id'         => LocationId::GRANITE_CAVE_1F,
        'name'       => "Granite Cave",
        'section'    => "1st Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::GRANITE_CAVE,
        'directions' => [
            Direction::U => LocationId::ROUTE_106,
            Direction::D => LocationId::GRANITE_CAVE_B1F,
        ],
    ],
    [
        'id'         => LocationId::GRANITE_CAVE_B1F,
        'name'       => "Granite Cave",
        'section'    => "1st Basement Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::GRANITE_CAVE,
        'directions' => [
            Direction::U => LocationId::GRANITE_CAVE_1F,
            Direction::D => LocationId::GRANITE_CAVE_B2F,
        ],
    ],
    [
        'id'         => LocationId::GRANITE_CAVE_B2F,
        'name'       => "Granite Cave",
        'section'    => "2nd Basement Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::GRANITE_CAVE,
        'directions' => [
            Direction::U => LocationId::GRANITE_CAVE_B1F,
            Direction::D => LocationId::GRANITE_CAVE_STEVENS_ROOM,
        ],
    ],
    [
        'id'         => LocationId::GRANITE_CAVE_STEVENS_ROOM,
        'name'       => "Granite Cave",
        'section'    => "Steven's Room",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::GRANITE_CAVE,
        'directions' => [
            Direction::U => LocationId::GRANITE_CAVE_B2F,
        ],
    ],
    [
        'id'         => LocationId::DEWFORD_TOWN,
        'name'       => "Dewford Town",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_106,
            Direction::E => LocationId::ROUTE_107,
            LocationId::DEWFORD_GYM,
        ],
    ],
    [
        'id'         => LocationId::DEWFORD_GYM,
        'name'       => "Dewford Gym",
        'type'       => LocationType::GYM,
        'directions' => [
            LocationId::DEWFORD_TOWN,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_107,
        'name'       => "Route 107",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_108,
            Direction::W => LocationId::DEWFORD_TOWN,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_108,
        'name'       => "Route 108",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_109,
            Direction::W => LocationId::ROUTE_107,
            LocationId::ABANDONED_SHIP_1F,
        ],
    ],
    [
        'id'         => LocationId::ABANDONED_SHIP_1F,
        'name'       => "Abandoned Ship",
        'section'    => "1st Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::ABANDONED_SHIP,
        'directions' => [
            Direction::U => LocationId::ROUTE_108,
            Direction::D => LocationId::ABANDONED_SHIP_B1F,
        ],
    ],
    [
        'id'         => LocationId::ABANDONED_SHIP_B1F,
        'name'       => "Abandoned Ship",
        'section'    => "1st Basement Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::ABANDONED_SHIP,
        'directions' => [
            Direction::U => LocationId::ABANDONED_SHIP_1F,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_109,
        'name'       => "Route 109",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::SLATEPORT_CITY,
            Direction::W => LocationId::ROUTE_108,
            LocationId::SEASHORE_HOUSE,
        ],
    ],
    [
        'id'         => LocationId::SEASHORE_HOUSE,
        'name'       => "Seashore House",
        'directions' => [
            LocationId::ROUTE_109,
        ],
    ],
    [
        'id'         => LocationId::SLATEPORT_CITY,
        'name'       => "Slateport City",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_110,
            Direction::E => LocationId::ROUTE_134,
            Direction::S => LocationId::ROUTE_109,
            LocationId::OCEANIC_MUSEUM,
            LocationId::SS_TIDAL,
        ],
    ],
    [
        'id'         => LocationId::SS_TIDAL,
        'name'       => "SS Tidal",
        'directions' => [
            LocationId::SLATEPORT_CITY,
            LocationId::OLIVINE_CITY,
        ],
    ],
    [
        'id'         => LocationId::OCEANIC_MUSEUM,
        'name'       => "Oceanic Museum",
        'directions' => [
            LocationId::SLATEPORT_CITY,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_110,
        'name'       => "Route 110",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::MAUVILLE_CITY,
            Direction::W => LocationId::ROUTE_103,
            Direction::S => LocationId::SLATEPORT_CITY,
        ],
    ],
    [
        'id'         => LocationId::MAUVILLE_CITY,
        'name'       => "Mauville City",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_111,
            Direction::E => LocationId::ROUTE_118,
            Direction::W => LocationId::ROUTE_117,
            Direction::S => LocationId::ROUTE_110,
            LocationId::MAUVILLE_GYM,
        ],
    ],
    [
        'id'         => LocationId::MAUVILLE_GYM,
        'name'       => "Mauville Gym",
        'type'       => LocationType::GYM,
        'directions' => [
            LocationId::MAUVILLE_CITY,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_111,
        'name'       => "Route 111",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_113,
            Direction::W => LocationId::ROUTE_112,
            Direction::S => LocationId::MAUVILLE_CITY,
            LocationId::WINSTRATE_FAMILY_HOME,
            LocationId::MIRAGE_TOWER,
            LocationId::DESERT_RUINS,
        ],
    ],
    [
        'id'         => LocationId::WINSTRATE_FAMILY_HOME,
        'name'       => "Winstrate Family Home",
        'directions' => [
            LocationId::ROUTE_111,
        ],
    ],
    [
        'id'         => LocationId::DESERT_RUINS,
        'name'       => "Desert Ruins",
        'directions' => [
            LocationId::ROUTE_111,
        ],
    ],
    [
        'id'         => LocationId::MIRAGE_TOWER,
        'name'       => "Mirage Tower",
        'directions' => [
            LocationId::ROUTE_111,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_112,
        'name'       => "Route 112",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::FIERY_PATH,
            Direction::E => LocationId::ROUTE_111,
            Direction::W => LocationId::LAVARIDGE_TOWN,
            LocationId::MT_CHIMNEY,
        ],
    ],
    [
        'id'         => LocationId::FIERY_PATH,
        'name'       => "Fiery Path",
        'type'       => LocationType::CAVE,
        'directions' => [
            Direction::N => LocationId::ROUTE_113,
            Direction::S => LocationId::ROUTE_112,
        ],
    ],
    [
        'id'         => LocationId::MT_CHIMNEY,
        'name'       => "Mt. Chimney",
        'type'       => LocationType::CAVE,
        'directions' => [
            Direction::S => LocationId::JAGGED_PASS,
            LocationId::ROUTE_112,
        ],
    ],
    [
        'id'         => LocationId::JAGGED_PASS,
        'name'       => "Jagged Pass",
        'directions' => [
            Direction::N => LocationId::MT_CHIMNEY,
            Direction::S => LocationId::LAVARIDGE_TOWN,
            LocationId::MAGMA_HIDEOUT_1F,
        ],
    ],
    [
        'id'         => LocationId::MAGMA_HIDEOUT_1F,
        'name'       => "Magma Hideout",
        'section'    => "1st Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MAGMA_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::MAGMA_HIDEOUT_2F,
            Direction::D => LocationId::JAGGED_PASS,
        ],
    ],
    [
        'id'         => LocationId::MAGMA_HIDEOUT_2F,
        'name'       => "Magma Hideout",
        'section'    => "2nd Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MAGMA_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::MAGMA_HIDEOUT_3F,
            Direction::D => LocationId::MAGMA_HIDEOUT_1F,
        ],
    ],
    [
        'id'         => LocationId::MAGMA_HIDEOUT_3F,
        'name'       => "Magma Hideout",
        'section'    => "3rd Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MAGMA_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::MAGMA_HIDEOUT_4F,
            Direction::D => LocationId::MAGMA_HIDEOUT_2F,
        ],
    ],
    [
        'id'         => LocationId::MAGMA_HIDEOUT_4F,
        'name'       => "Magma Hideout",
        'section'    => "4th Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MAGMA_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::MAGMA_HIDEOUT_5F,
            Direction::D => LocationId::MAGMA_HIDEOUT_3F,
        ],
    ],
    [
        'id'         => LocationId::MAGMA_HIDEOUT_5F,
        'name'       => "Magma Hideout",
        'section'    => "5th Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MAGMA_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::MAGMA_HIDEOUT_6F,
            Direction::D => LocationId::MAGMA_HIDEOUT_4F,
        ],
    ],
    [
        'id'         => LocationId::MAGMA_HIDEOUT_6F,
        'name'       => "Magma Hideout",
        'section'    => "6th Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MAGMA_HIDEOUT,
        'directions' => [
            Direction::D => LocationId::MAGMA_HIDEOUT_5F,
        ],
    ],
    [
        'id'         => LocationId::LAVARIDGE_TOWN,
        'name'       => "Lavaridge Town",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::JAGGED_PASS,
            Direction::E => LocationId::ROUTE_112,
            LocationId::LAVARIDGE_GYM,
            LocationId::HOT_SPRINGS,
        ],
    ],
    [
        'id'         => LocationId::LAVARIDGE_GYM,
        'name'       => "Lavaridge Gym",
        'type'       => LocationType::GYM,
        'directions' => [
            LocationId::LAVARIDGE_TOWN,
        ],
    ],
    [
        'id'         => LocationId::HOT_SPRINGS,
        'name'       => "Hot Springs",
        'directions' => [
            LocationId::LAVARIDGE_TOWN,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_113,
        'name'       => "Route 113",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::FALLARBOR_TOWN,
            Direction::S => LocationId::ROUTE_111,
            LocationId::FIERY_PATH,
        ],
    ],
    [
        'id'         => LocationId::FALLARBOR_TOWN,
        'name'       => "Fallarbor Town",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_113,
            Direction::W => LocationId::ROUTE_114,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_114,
        'name'       => "Route 114",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::FALLARBOR_TOWN,
            Direction::S => LocationId::METEOR_FALLS_1F,
            LocationId::DESERT_UNDERPASS,
        ],
    ],
    [
        'id'         => LocationId::DESERT_UNDERPASS,
        'name'       => "Desert Underpass",
        'type'       => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_114,
        ],
    ],
    [
        'id'         => LocationId::METEOR_FALLS_1F,
        'name'       => "Meteor Falls",
        'section'    => "1st Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::METEOR_FALLS,
        'directions' => [
            Direction::U => LocationId::ROUTE_114,
            Direction::D => LocationId::METEOR_FALLS_B1F,
            LocationId::METEOR_FALLS_STEVENS_CAVE,
        ],
    ],
    [
        'id'         => LocationId::METEOR_FALLS_B1F,
        'name'       => "Meteor Falls",
        'section'    => "1st Basement Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::METEOR_FALLS,
        'directions' => [
            Direction::U => LocationId::METEOR_FALLS_1F,
            Direction::D => LocationId::METEOR_FALLS_B2F,
        ],
    ],
    [
        'id'         => LocationId::METEOR_FALLS_B2F,
        'name'       => "Meteor Falls",
        'section'    => "2nd Basement Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::METEOR_FALLS,
        'directions' => [
            Direction::U => LocationId::METEOR_FALLS_B1F,
            Direction::D => LocationId::ROUTE_115,
        ],
    ],
    [
        'id'         => LocationId::METEOR_FALLS_STEVENS_CAVE,
        'name'       => "Meteor Falls",
        'section'    => "Steven's Cave",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::METEOR_FALLS,
        'directions' => [
            LocationId::METEOR_FALLS_1F,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_115,
        'name'       => "Route 115",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::METEOR_FALLS_B2F,
            Direction::S => LocationId::RUSTBORO_CITY,
        ],
    ],
    [
        'id'         => LocationId::VERDANTURF_TOWN,
        'name'       => "Verdanturf Town",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::RUSTURF_TUNNEL,
            Direction::E => LocationId::ROUTE_117,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_117,
        'name'       => "Route 117",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::VERDANTURF_TOWN,
            Direction::E => LocationId::MAUVILLE_CITY,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_118,
        'name'       => "Route 118",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_119,
            Direction::W => LocationId::MAUVILLE_CITY,
            Direction::E => LocationId::ROUTE_123,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_119,
        'name'       => "Route 119",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::FORTREE_CITY,
            Direction::S => LocationId::ROUTE_118,
            LocationId::WEATHER_INSTITUTE_1F,
        ],
    ],
    [
        'id'         => LocationId::WEATHER_INSTITUTE_1F,
        'name'       => "Weather Institute",
        'section'    => "1st Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::WEATHER_INSTITUTE,
        'directions' => [
            Direction::U => LocationId::WEATHER_INSTITUTE_2F,
            Direction::D => LocationId::ROUTE_119,
        ],
    ],
    [
        'id'         => LocationId::WEATHER_INSTITUTE_2F,
        'name'       => "Weather Institute",
        'section'    => "2nd Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::WEATHER_INSTITUTE,
        'directions' => [
            Direction::D => LocationId::WEATHER_INSTITUTE_1F,
        ],
    ],
    [
        'id'         => LocationId::FORTREE_CITY,
        'name'       => "Fortree City",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_120,
            Direction::W => LocationId::ROUTE_119,
            LocationId::FORTREE_GYM,
        ],
    ],
    [
        'id'         => LocationId::FORTREE_GYM,
        'name'       => "Fortree Gym",
        'type'       => LocationType::GYM,
        'directions' => [
            LocationId::FORTREE_CITY,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_120,
        'name'       => "Route 120",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_121,
            Direction::W => LocationId::FORTREE_CITY,
            LocationId::ANCIENT_TOMB,
        ],
    ],
    [
        'id'         => LocationId::ANCIENT_TOMB,
        'name'       => "Ancient Tomb",
        'type'       => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_120,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_121,
        'name'       => "Route 121",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::HOENN_SAFARI_ZONE_AREA_1,
            Direction::E => LocationId::LILYCOVE_CITY,
            Direction::W => LocationId::ROUTE_120,
            Direction::S => LocationId::ROUTE_122,
        ],
    ],
    [
        'id'         => LocationId::HOENN_SAFARI_ZONE_AREA_1,
        'name'       => "Safari Zone",
        'section'    => "Area 1",
        'area'       => LocationId::HOENN_SAFARI_ZONE,
        'directions' => [
            Direction::N => LocationId::HOENN_SAFARI_ZONE_AREA_4,
            Direction::E => LocationId::HOENN_SAFARI_ZONE_AREA_5,
            Direction::W => LocationId::HOENN_SAFARI_ZONE_AREA_2,
            Direction::S => LocationId::ROUTE_121,
        ],
    ],
    [
        'id'         => LocationId::HOENN_SAFARI_ZONE_AREA_2,
        'name'       => "Safari Zone",
        'section'    => "Area 2",
        'area'       => LocationId::HOENN_SAFARI_ZONE,
        'directions' => [
            Direction::N => LocationId::HOENN_SAFARI_ZONE_AREA_3,
            Direction::E => LocationId::HOENN_SAFARI_ZONE_AREA_1,
        ],
    ],
    [
        'id'         => LocationId::HOENN_SAFARI_ZONE_AREA_3,
        'name'       => "Safari Zone",
        'section'    => "Area 3",
        'area'       => LocationId::HOENN_SAFARI_ZONE,
        'directions' => [
            Direction::E => LocationId::HOENN_SAFARI_ZONE_AREA_4,
            Direction::S => LocationId::HOENN_SAFARI_ZONE_AREA_2,
        ],
    ],
    [
        'id'         => LocationId::HOENN_SAFARI_ZONE_AREA_4,
        'name'       => "Safari Zone",
        'section'    => "Area 4",
        'area'       => LocationId::HOENN_SAFARI_ZONE,
        'directions' => [
            Direction::E => LocationId::HOENN_SAFARI_ZONE_AREA_6,
            Direction::W => LocationId::HOENN_SAFARI_ZONE_AREA_3,
            Direction::S => LocationId::HOENN_SAFARI_ZONE_AREA_1,
        ],
    ],
    [
        'id'         => LocationId::HOENN_SAFARI_ZONE_AREA_5,
        'name'       => "Safari Zone",
        'section'    => "Area 5",
        'area'       => LocationId::HOENN_SAFARI_ZONE,
        'directions' => [
            Direction::N => LocationId::HOENN_SAFARI_ZONE_AREA_6,
            Direction::W => LocationId::HOENN_SAFARI_ZONE_AREA_1,
        ],
    ],
    [
        'id'         => LocationId::HOENN_SAFARI_ZONE_AREA_6,
        'name'       => "Safari Zone",
        'section'    => "Area 6",
        'area'       => LocationId::HOENN_SAFARI_ZONE,
        'directions' => [
            Direction::W => LocationId::HOENN_SAFARI_ZONE_AREA_4,
            Direction::S => LocationId::HOENN_SAFARI_ZONE_AREA_5,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_122,
        'name'       => "Route 122",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_121,
            Direction::S => LocationId::ROUTE_123,
            LocationId::MT_PYRE_EXTERIOR,
        ],
    ],
    [
        'id'         => LocationId::MT_PYRE_EXTERIOR,
        'name'       => "Mt. Pyre",
        'section'    => "Exterior",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MT_PYRE,
        'directions' => [
            Direction::U => LocationId::MT_PYRE_1F,
            Direction::D => LocationId::ROUTE_122,
        ],
    ],
    [
        'id'         => LocationId::MT_PYRE_1F,
        'name'       => "Mt. Pyre",
        'section'    => "1st Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MT_PYRE,
        'directions' => [
            Direction::U => LocationId::MT_PYRE_2F,
            Direction::D => LocationId::MT_PYRE_EXTERIOR,
        ],
    ],
    [
        'id'         => LocationId::MT_PYRE_2F,
        'name'       => "Mt. Pyre",
        'section'    => "2nd Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MT_PYRE,
        'directions' => [
            Direction::U => LocationId::MT_PYRE_3F,
            Direction::D => LocationId::MT_PYRE_1F,
        ],
    ],
    [
        'id'         => LocationId::MT_PYRE_3F,
        'name'       => "Mt. Pyre",
        'section'    => "3rd Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MT_PYRE,
        'directions' => [
            Direction::U => LocationId::MT_PYRE_4F,
            Direction::D => LocationId::MT_PYRE_2F,
        ],
    ],
    [
        'id'         => LocationId::MT_PYRE_4F,
        'name'       => "Mt. Pyre",
        'section'    => "4th Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MT_PYRE,
        'directions' => [
            Direction::U => LocationId::MT_PYRE_5F,
            Direction::D => LocationId::MT_PYRE_3F,
        ],
    ],
    [
        'id'         => LocationId::MT_PYRE_5F,
        'name'       => "Mt. Pyre",
        'section'    => "5th Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MT_PYRE,
        'directions' => [
            Direction::U => LocationId::MT_PYRE_6F,
            Direction::D => LocationId::MT_PYRE_4F,
        ],
    ],
    [
        'id'         => LocationId::MT_PYRE_6F,
        'name'       => "Mt. Pyre",
        'section'    => "6th Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MT_PYRE,
        'directions' => [
            Direction::U => LocationId::MT_PYRE_SUMMIT,
            Direction::D => LocationId::MT_PYRE_5F,
        ],
    ],
    [
        'id'         => LocationId::MT_PYRE_SUMMIT,
        'name'       => "Mt. Pyre",
        'section'    => "Summit",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::MT_PYRE,
        'directions' => [
            Direction::D => LocationId::MT_PYRE_6F,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_123,
        'name'       => "Route 123",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_122,
            Direction::W => LocationId::ROUTE_118,
        ],
    ],
    [
        'id'         => LocationId::LILYCOVE_CITY,
        'name'       => "Lilycove City",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_124,
            Direction::W => LocationId::ROUTE_121,
            LocationId::AQUA_HIDEOUT_1F,
        ],
    ],
    [
        'id'         => LocationId::AQUA_HIDEOUT_1F,
        'name'       => "Aqua Hideout",
        'section'    => "1st Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::AQUA_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::LILYCOVE_CITY,
            Direction::D => LocationId::AQUA_HIDEOUT_B1F,
        ],
    ],
    [
        'id'         => LocationId::AQUA_HIDEOUT_B1F,
        'name'       => "Aqua Hideout",
        'section'    => "1st Basement Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::AQUA_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::AQUA_HIDEOUT_1F,
            Direction::D => LocationId::AQUA_HIDEOUT_B2F,
        ],
    ],
    [
        'id'         => LocationId::AQUA_HIDEOUT_B2F,
        'name'       => "Aqua Hideout",
        'section'    => "2nd Basement Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::AQUA_HIDEOUT,
        'directions' => [
            Direction::U => LocationId::AQUA_HIDEOUT_B1F,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_124,
        'name'       => "Route 124",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::MOSSDEEP_CITY,
            Direction::W => LocationId::LILYCOVE_CITY,
            Direction::S => LocationId::ROUTE_126,
        ],
    ],
    [
        'id'         => LocationId::MOSSDEEP_CITY,
        'name'       => "Mossdeep City",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_125,
            Direction::W => LocationId::ROUTE_124,
            Direction::S => LocationId::ROUTE_127,
            LocationId::MOSSDEEP_SPACE_CENTER,
            LocationId::STEVENS_HOUSE,
            LocationId::MOSSDEEP_GYM,
        ],
    ],
    [
        'id'         => LocationId::MOSSDEEP_SPACE_CENTER,
        'name'       => "Mossdeep Space Center",
        'type'       => LocationType::TOWER,
        'directions' => [
            LocationId::MOSSDEEP_CITY,
        ],
    ],
    [
        'id'         => LocationId::STEVENS_HOUSE,
        'name'       => "Steven's House",
        'directions' => [
            LocationId::MOSSDEEP_CITY,
        ],
    ],
    [
        'id'         => LocationId::MOSSDEEP_GYM,
        'name'       => "Mossdeep Gym",
        'type'       => LocationType::GYM,
        'directions' => [
            LocationId::MOSSDEEP_CITY,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_125,
        'name'       => "Route 125",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::SHOAL_CAVE_MAIN_CAVE,
            Direction::S => LocationId::MOSSDEEP_CITY,
        ],
    ],
    [
        'id'         => LocationId::SHOAL_CAVE_MAIN_CAVE,
        'name'       => "Shoal Cave",
        'section'    => "Main Cave",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::SHOAL_CAVE,
        'directions' => [
            Direction::N => LocationId::SHOAL_CAVE_ICE_ROOM,
            Direction::S => LocationId::ROUTE_125,
        ],
    ],
    [
        'id'         => LocationId::SHOAL_CAVE_ICE_ROOM,
        'name'       => "Shoal Cave",
        'section'    => "Ice Room",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::SHOAL_CAVE,
        'directions' => [
            Direction::S => LocationId::SHOAL_CAVE_MAIN_CAVE,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_126,
        'name'       => "Route 126",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_124,
            Direction::E => LocationId::ROUTE_127,
            LocationId::SOOTOPOLIS_CITY,
        ],
    ],
    [
        'id'         => LocationId::SOOTOPOLIS_CITY,
        'name'       => "Sootopolis City",
        'type'       => LocationType::CITY,
        'directions' => [
            LocationId::CAVE_OF_ORIGIN,
            LocationId::SOOTOPOLIS_GYM,
            LocationId::ROUTE_126,
        ],
    ],
    [
        'id'         => LocationId::CAVE_OF_ORIGIN,
        'name'       => "Cave of Origin",
        'type'       => LocationType::CAVE,
        'directions' => [
            LocationId::SOOTOPOLIS_CITY,
        ],
    ],
    [
        'id'         => LocationId::SOOTOPOLIS_GYM,
        'name'       => "Sootopolis Gym",
        'type'       => LocationType::GYM,
        'directions' => [
            LocationId::SOOTOPOLIS_CITY,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_127,
        'name'       => "Route 127",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::MOSSDEEP_CITY,
            Direction::W => LocationId::ROUTE_126,
            Direction::S => LocationId::ROUTE_128,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_128,
        'name'       => "Route 128",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_127,
            Direction::E => LocationId::EVER_GRANDE_CITY,
            Direction::S => LocationId::ROUTE_129,
            LocationId::SEAFLOOR_CAVERN,
        ],
    ],
    [
        'id'         => LocationId::SEAFLOOR_CAVERN,
        'name'       => "Seafloor Cavern",
        'type'       => LocationType::CAVE,
        'directions' => [
            LocationId::ROUTE_128,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_129,
        'name'       => "Route 129",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_128,
            Direction::W => LocationId::ROUTE_130,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_130,
        'name'       => "Route 130",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_129,
            Direction::W => LocationId::ROUTE_131,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_131,
        'name'       => "Route 131",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::SKY_PILLAR_1F,
            Direction::E => LocationId::ROUTE_130,
            Direction::W => LocationId::PACIFIDLOG_TOWN,
        ],
    ],
    [
        'id'         => LocationId::SKY_PILLAR_1F,
        'name'       => "Sky Pillar",
        'section'    => "1st Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::SKY_PILLAR,
        'directions' => [
            Direction::U => LocationId::SKY_PILLAR_2F,
            Direction::D => LocationId::ROUTE_131,
        ],
    ],
    [
        'id'         => LocationId::SKY_PILLAR_2F,
        'name'       => "Sky Pillar",
        'section'    => "2nd Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::SKY_PILLAR,
        'directions' => [
            Direction::U => LocationId::SKY_PILLAR_3F,
            Direction::D => LocationId::SKY_PILLAR_1F,
        ],
    ],
    [
        'id'         => LocationId::SKY_PILLAR_3F,
        'name'       => "Sky Pillar",
        'section'    => "3rd Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::SKY_PILLAR,
        'directions' => [
            Direction::U => LocationId::SKY_PILLAR_4F,
            Direction::D => LocationId::SKY_PILLAR_2F,
        ],
    ],
    [
        'id'         => LocationId::SKY_PILLAR_4F,
        'name'       => "Sky Pillar",
        'section'    => "4th Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::SKY_PILLAR,
        'directions' => [
            Direction::U => LocationId::SKY_PILLAR_5F,
            Direction::D => LocationId::SKY_PILLAR_3F,
        ],
    ],
    [
        'id'         => LocationId::SKY_PILLAR_5F,
        'name'       => "Sky Pillar",
        'section'    => "5th Floor",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::SKY_PILLAR,
        'directions' => [
            Direction::U => LocationId::SKY_PILLAR_APEX,
            Direction::D => LocationId::SKY_PILLAR_4F,
        ],
    ],
    [
        'id'         => LocationId::SKY_PILLAR_APEX,
        'name'       => "Sky Pillar",
        'section'    => "Apex",
        'type'       => LocationType::TOWER,
        'area'       => LocationId::SKY_PILLAR,
        'directions' => [
            Direction::D => LocationId::SKY_PILLAR_5F,
        ],
    ],
    [
        'id'         => LocationId::PACIFIDLOG_TOWN,
        'name'       => "Pacifidlog Town",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_131,
            Direction::W => LocationId::ROUTE_132,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_132,
        'name'       => "Route 132",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::PACIFIDLOG_TOWN,
            Direction::W => LocationId::ROUTE_133,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_133,
        'name'       => "Route 133",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_132,
            Direction::W => LocationId::ROUTE_134,
        ],
    ],
    [
        'id'         => LocationId::ROUTE_134,
        'name'       => "Route 134",
        'type'       => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_133,
            Direction::W => LocationId::SLATEPORT_CITY,
        ],
    ],
    [
        'id'         => LocationId::EVER_GRANDE_CITY,
        'name'       => "Ever Grande City",
        'type'       => LocationType::CITY,
        'directions' => [
            Direction::W => LocationId::ROUTE_128,
            LocationId::HOENN_VICTORY_ROAD_1F,
        ],
    ],
    [
        'id'         => LocationId::HOENN_VICTORY_ROAD_1F,
        'name'       => "Victory Road",
        'section'    => "1st Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::HOENN_VICTORY_ROAD,
        'directions' => [
            Direction::U => LocationId::EVER_GRANDE_CITY,
            Direction::D => LocationId::HOENN_VICTORY_ROAD_B1F,
        ],
    ],
    [
        'id'         => LocationId::HOENN_VICTORY_ROAD_B1F,
        'name'       => "Victory Road",
        'section'    => "1st Basement Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::HOENN_VICTORY_ROAD,
        'directions' => [
            Direction::U => LocationId::HOENN_VICTORY_ROAD_1F,
            Direction::D => LocationId::HOENN_VICTORY_ROAD_B2F,
        ],
    ],
    [
        'id'         => LocationId::HOENN_VICTORY_ROAD_B2F,
        'name'       => "Victory Road",
        'section'    => "2nd Basement Floor",
        'type'       => LocationType::CAVE,
        'area'       => LocationId::HOENN_VICTORY_ROAD,
        'directions' => [
            Direction::U => LocationId::HOENN_VICTORY_ROAD_B1F,
            Direction::D => LocationId::HOENN_POKEMON_LEAGUE,
        ],
    ],
    [
        'id'         => LocationId::HOENN_POKEMON_LEAGUE,
        'name'       => "Pokémon League",
        'type'       => LocationType::GYM,
        'directions' => [
            LocationId::HOENN_VICTORY_ROAD_B2F,
        ],
    ],
];
