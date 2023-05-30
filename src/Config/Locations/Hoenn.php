<?php
declare(strict_types=1);

use ConorSmith\Pokemon\Direction;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\LocationType;

return [
    [
        'id' => LocationId::LITTLEROOT_TOWN,
        'name' => "Littleroot Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_101,
        ],
    ],
    [
        'id' => LocationId::ROUTE_101,
        'name' => "Route 101",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::OLDALE_TOWN,
            Direction::S => LocationId::LITTLEROOT_TOWN,
        ],
    ],
    [
        'id' => LocationId::OLDALE_TOWN,
        'name' => "Oldale Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_103,
            Direction::W => LocationId::ROUTE_102,
            Direction::S => LocationId::ROUTE_101,
        ],
    ],
    [
        'id' => LocationId::ROUTE_102,
        'name' => "Route 102",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::OLDALE_TOWN,
            Direction::W => LocationId::PETALBURG_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_103,
        'name' => "Route 103",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_110,
            Direction::S => LocationId::OLDALE_TOWN,
        ],
    ],
    [
        'id' => LocationId::PETALBURG_CITY,
        'name' => "Petalburg City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_102,
            Direction::W => LocationId::ROUTE_104,
            LocationId::PETALBURG_GYM,
        ],
    ],
    [
        'id' => LocationId::PETALBURG_GYM,
        'name' => "Petalburg Gym",
        'type' => LocationType::GYM,
        'directions' => [
            LocationId::PETALBURG_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_104,
        'name' => "Route 104",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::RUSTBORO_CITY,
            Direction::E => LocationId::PETALBURG_CITY,
            Direction::S => LocationId::ROUTE_105,
        ],
    ],
    [
        'id' => LocationId::RUSTBORO_CITY,
        'name' => "Rustboro City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_116,
            Direction::S => LocationId::ROUTE_104,
        ],
    ],
    [
        'id' => LocationId::ROUTE_116,
        'name' => "Route 116",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::RUSTBORO_CITY,
            Direction::E => LocationId::RUSTURF_TUNNEL,
        ],
    ],
    [
        'id' => LocationId::RUSTURF_TUNNEL,
        'name' => "Rusturf Tunnel",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::W => LocationId::ROUTE_116,
            Direction::S => LocationId::VERDANTURF_TOWN,
        ],
    ],
    [
        'id' => LocationId::ROUTE_105,
        'name' => "Route 105",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_104,
            Direction::W => LocationId::ISLAND_CAVE,
            Direction::S => LocationId::ROUTE_106,
        ],
    ],
    [
        'id' => LocationId::ISLAND_CAVE,
        'name' => "Island Cave",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::E => LocationId::ROUTE_105,
        ],
    ],
    [
        'id' => LocationId::ROUTE_106,
        'name' => "Route 106",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_105,
            Direction::W => LocationId::GRANITE_CAVE,
            Direction::S => LocationId::DEWFORD_TOWN,
        ],
    ],
    [
        'id' => LocationId::GRANITE_CAVE,
        'name' => "Granite Cave",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::E => LocationId::ROUTE_106,
        ],
    ],
    [
        'id' => LocationId::DEWFORD_TOWN,
        'name' => "Dewford Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_106,
            Direction::E => LocationId::ROUTE_107,
        ],
    ],
    [
        'id' => LocationId::ROUTE_107,
        'name' => "Route 107",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_108,
            Direction::W => LocationId::DEWFORD_TOWN,
        ],
    ],
    [
        'id' => LocationId::ROUTE_108,
        'name' => "Route 108",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ABANDONED_SHIP,
            Direction::E => LocationId::ROUTE_109,
            Direction::W => LocationId::ROUTE_107,
        ],
    ],
    [
        'id' => LocationId::ABANDONED_SHIP,
        'name' => "Abandoned Ship",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::S => LocationId::ROUTE_108,
        ],
    ],
    [
        'id' => LocationId::ROUTE_109,
        'name' => "Route 109",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::SLATEPORT_CITY,
            Direction::W => LocationId::ROUTE_108,
        ],
    ],
    [
        'id' => LocationId::SLATEPORT_CITY,
        'name' => "Slateport City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_110,
            Direction::E => LocationId::ROUTE_134,
            Direction::S => LocationId::ROUTE_109,
            LocationId::SS_TIDAL,
        ],
    ],
    [
        'id' => LocationId::SS_TIDAL,
        'name' => "SS Tidal",
        'directions' => [
            LocationId::SLATEPORT_CITY,
            LocationId::OLIVINE_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_110,
        'name' => "Route 110",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::MAUVILLE_CITY,
            Direction::W => LocationId::ROUTE_103,
            Direction::S => LocationId::SLATEPORT_CITY,
        ],
    ],
    [
        'id' => LocationId::MAUVILLE_CITY,
        'name' => "Mauville City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_111,
            Direction::E => LocationId::ROUTE_118,
            Direction::W => LocationId::ROUTE_117,
            Direction::S => LocationId::ROUTE_110,
        ],
    ],
    [
        'id' => LocationId::ROUTE_111,
        'name' => "Route 111",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_113,
            Direction::W => LocationId::ROUTE_112,
            Direction::S => LocationId::MAUVILLE_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_112,
        'name' => "Route 112",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::JAGGED_PASS,
            Direction::E => LocationId::ROUTE_111,
            Direction::W => LocationId::LAVARIDGE_TOWN,
        ],
    ],
    [
        'id' => LocationId::JAGGED_PASS,
        'name' => "Jagged Pass",
        'directions' => [
            Direction::N => LocationId::MT_CHIMNEY,
            Direction::S => LocationId::ROUTE_112,
        ],
    ],
    [
        'id' => LocationId::MT_CHIMNEY,
        'name' => "Mt. Chimney",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::S => LocationId::JAGGED_PASS,
        ],
    ],
    [
        'id' => LocationId::LAVARIDGE_TOWN,
        'name' => "Lavaridge Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_112,
        ],
    ],
    [
        'id' => LocationId::ROUTE_113,
        'name' => "Route 113",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::FALLARBOR_TOWN,
            Direction::S => LocationId::ROUTE_111,
        ],
    ],
    [
        'id' => LocationId::FALLARBOR_TOWN,
        'name' => "Fallarbor Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_113,
            Direction::W => LocationId::ROUTE_114,
        ],
    ],
    [
        'id' => LocationId::ROUTE_114,
        'name' => "Route 114",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::FALLARBOR_TOWN,
            Direction::W => LocationId::METEOR_FALLS,
        ],
    ],
    [
        'id' => LocationId::METEOR_FALLS,
        'name' => "Meteor Falls",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::E => LocationId::ROUTE_114,
            Direction::S => LocationId::ROUTE_115,
        ],
    ],
    [
        'id' => LocationId::ROUTE_115,
        'name' => "Route 115",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::METEOR_FALLS,
            Direction::S => LocationId::RUSTBORO_CITY,
        ],
    ],
    [
        'id' => LocationId::VERDANTURF_TOWN,
        'name' => "Verdanturf Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::RUSTURF_TUNNEL,
            Direction::E => LocationId::ROUTE_117,
        ],
    ],
    [
        'id' => LocationId::ROUTE_117,
        'name' => "Route 117",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::VERDANTURF_TOWN,
            Direction::E => LocationId::MAUVILLE_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_118,
        'name' => "Route 118",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_119,
            Direction::W => LocationId::MAUVILLE_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_119,
        'name' => "Route 119",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::FORTREE_CITY,
            Direction::S => LocationId::ROUTE_118,
        ],
    ],
    [
        'id' => LocationId::FORTREE_CITY,
        'name' => "Fortree City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_120,
            Direction::W => LocationId::ROUTE_119,
        ],
    ],
    [
        'id' => LocationId::ROUTE_120,
        'name' => "Route 120",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_121,
            Direction::W => LocationId::FORTREE_CITY,
        ],
    ],
    [
        'id' => LocationId::ROUTE_121,
        'name' => "Route 121",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::HOENN_SAFARI_ZONE,
            Direction::E => LocationId::LILYCOVE_CITY,
            Direction::W => LocationId::ROUTE_120,
            Direction::S => LocationId::ROUTE_122,
        ],
    ],
    [
        'id' => LocationId::HOENN_SAFARI_ZONE,
        'name' => "Safari Zone",
        'directions' => [
            Direction::S => LocationId::ROUTE_121,
        ],
    ],
    [
        'id' => LocationId::ROUTE_122,
        'name' => "Route 122",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_121,
            Direction::S => LocationId::ROUTE_123,
        ],
    ],
    [
        'id' => LocationId::ROUTE_123,
        'name' => "Route 123",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_122,
            Direction::W => LocationId::ROUTE_118,
        ],
    ],
    [
        'id' => LocationId::LILYCOVE_CITY,
        'name' => "Lilycove City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_124,
            Direction::W => LocationId::ROUTE_121,
        ],
    ],
    [
        'id' => LocationId::ROUTE_124,
        'name' => "Route 124",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::MOSSDEEP_CITY,
            Direction::W => LocationId::LILYCOVE_CITY,
            Direction::S => LocationId::ROUTE_126,
        ],
    ],
    [
        'id' => LocationId::MOSSDEEP_CITY,
        'name' => "Mossdeep City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::N => LocationId::ROUTE_125,
            Direction::W => LocationId::ROUTE_124,
        ],
    ],
    [
        'id' => LocationId::ROUTE_125,
        'name' => "Route 125",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::SHOAL_CAVE,
            Direction::S => LocationId::MOSSDEEP_CITY,
        ],
    ],
    [
        'id' => LocationId::SHOAL_CAVE,
        'name' => "Shoal Cave",
        'type' => LocationType::CAVE,
        'directions' => [
            Direction::S => LocationId::ROUTE_125,
        ],
    ],
    [
        'id' => LocationId::ROUTE_126,
        'name' => "Route 126",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_124,
            Direction::E => LocationId::ROUTE_127,
        ],
    ],
    [
        'id' => LocationId::ROUTE_127,
        'name' => "Route 127",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::W => LocationId::ROUTE_126,
            Direction::S => LocationId::ROUTE_128,
        ],
    ],
    [
        'id' => LocationId::ROUTE_128,
        'name' => "Route 128",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_127,
            Direction::E => LocationId::EVER_GRANDE_CITY,
            Direction::S => LocationId::ROUTE_129,
        ],
    ],
    [
        'id' => LocationId::ROUTE_129,
        'name' => "Route 129",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::ROUTE_128,
            Direction::W => LocationId::ROUTE_130,
        ],
    ],
    [
        'id' => LocationId::ROUTE_130,
        'name' => "Route 130",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_129,
            Direction::W => LocationId::ROUTE_131,
        ],
    ],
    [
        'id' => LocationId::ROUTE_131,
        'name' => "Route 131",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::N => LocationId::SKY_PILLAR,
            Direction::E => LocationId::ROUTE_130,
            Direction::W => LocationId::PACIFIDLOG_TOWN,
        ],
    ],
    [
        'id' => LocationId::SKY_PILLAR,
        'name' => "Sky Pillar",
        'type' => LocationType::TOWER,
        'directions' => [
            Direction::S => LocationId::ROUTE_131,
        ],
    ],
    [
        'id' => LocationId::PACIFIDLOG_TOWN,
        'name' => "Pacifidlog Town",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::E => LocationId::ROUTE_131,
            Direction::W => LocationId::ROUTE_132,
        ],
    ],
    [
        'id' => LocationId::ROUTE_132,
        'name' => "Route 132",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::PACIFIDLOG_TOWN,
            Direction::W => LocationId::ROUTE_133,
        ],
    ],
    [
        'id' => LocationId::ROUTE_133,
        'name' => "Route 133",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_132,
            Direction::W => LocationId::ROUTE_134,
        ],
    ],
    [
        'id' => LocationId::ROUTE_134,
        'name' => "Route 134",
        'type' => LocationType::ROUTE,
        'directions' => [
            Direction::E => LocationId::ROUTE_133,
            Direction::W => LocationId::SLATEPORT_CITY,
        ],
    ],
    [
        'id' => LocationId::EVER_GRANDE_CITY,
        'name' => "Ever Grande City",
        'type' => LocationType::CITY,
        'directions' => [
            Direction::W => LocationId::ROUTE_128,
        ],
    ],
];
