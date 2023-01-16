<?php
declare(strict_types=1);

use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;

return [
    [
        'id' => LocationId::PALLET_TOWN,
        'name' => "Pallet Town",
        'directions' => [
            LocationId::ROUTE_1,
            "e2d59a4a-52c0-4daf-98e6-d7714bbb1c6a",
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 1,
                'levels' => [1, 3],
            ],
            PokedexNo::RATTATA => [
                'weight' => 3,
                'levels' => [1, 3],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_1,
        'name' => "Route 1",
        'directions' => [
            LocationId::VIRIDIAN_CITY,
            LocationId::PALLET_TOWN,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 1,
                'levels' => [2, 5],
            ],
            PokedexNo::RATTATA => [
                'weight' => 1,
                'levels' => [2, 4],
            ],
        ],
    ],
    [
        'id' => LocationId::VIRIDIAN_CITY,
        'name' => "Viridian City",
        'directions' => [
            LocationId::ROUTE_2,
            LocationId::ROUTE_22,
            LocationId::VIRIDIAN_GYM,
            LocationId::ROUTE_1,
        ],
        'pokemon' => [
            PokedexNo::RATTATA => [
                'weight' => 5,
                'levels' => [2, 5],
            ],
            PokedexNo::SPEAROW => [
                'weight' => 3,
                'levels' => [2, 5],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 1,
                'levels' => [3, 5],
            ],
            PokedexNo::MANKEY => [
                'weight' => 1,
                'levels' => [2, 5],
            ],
        ],
    ],
    [
        'id' => LocationId::VIRIDIAN_GYM,
        'name' => "Viridian Gym",
        'directions' => [
            LocationId::VIRIDIAN_CITY,
        ],
        'pokemon' => [],
        'trainers' => [
            [
                'id' => "dd360fe7-c9bd-46d8-9c30-f8ce4e09566d",
                'name' => "Tamer Cole",
                'prize' => 1560,
                'team' => [
                    [
                        'id' => PokedexNo::ARBOK,
                        'level' => 39,
                    ],
                    [
                        'id' => PokedexNo::TAUROS,
                        'level' => 39,
                    ],
                ],
            ],
            [
                'id' => "80255111-47e4-40fd-a49f-6ffbdfed2dc8",
                'name' => "Black Belt Kiyo",
                'prize' => 1032,
                'team' => [
                    [
                        'id' => PokedexNo::MACHOKE,
                        'level' => 43,
                    ],
                ],
            ],
            [
                'id' => "d8b3ba34-ec2f-46b8-b298-baf721535799",
                'name' => "Cooltrainer Samuel",
                'prize' => 1404,
                'team' => [
                    [
                        'id' => PokedexNo::SANDSLASH,
                        'level' => 37,
                    ],
                    [
                        'id' => PokedexNo::SANDSLASH,
                        'level' => 37,
                    ],
                    [
                        'id' => PokedexNo::RHYHORN,
                        'level' => 38,
                    ],
                    [
                        'id' => PokedexNo::NIDORINO,
                        'level' => 39,
                    ],
                    [
                        'id' => PokedexNo::NIDOKING,
                        'level' => 39,
                    ],
                ],
            ],
            [
                'id' => "e783c473-f6fb-4791-a461-66c69c5a435f",
                'name' => "Cooltrainer Yuji",
                'prize' => 1368,
                'team' => [
                    [
                        'id' => PokedexNo::SANDSLASH,
                        'level' => 38,
                    ],
                    [
                        'id' => PokedexNo::GRAVELER,
                        'level' => 38,
                    ],
                    [
                        'id' => PokedexNo::ONIX,
                        'level' => 38,
                    ],
                    [
                        'id' => PokedexNo::GRAVELER,
                        'level' => 38,
                    ],
                    [
                        'id' => PokedexNo::MAROWAK,
                        'level' => 38,
                    ],
                ],
            ],
            [
                'id' => "f1569626-32b6-46a4-a16b-0e85b5c3685c",
                'name' => "Black Belt Atsushi",
                'prize' => 960,
                'team' => [
                    [
                        'id' => PokedexNo::MACHOP,
                        'level' => 40,
                    ],
                    [
                        'id' => PokedexNo::MACHOKE,
                        'level' => 40,
                    ],
                ],
            ],
            [
                'id' => "526d178c-62f1-4d5d-b2a1-29563c262627",
                'name' => "Tamer Jason",
                'prize' => 1720,
                'team' => [
                    [
                        'id' => PokedexNo::RHYHORN,
                        'level' => 43,
                    ],
                ],
            ],
            [
                'id' => "ec68491a-0468-4df0-bdfd-e687abd2c320",
                'name' => "Cooltrainer Warren",
                'prize' => 1404,
                'team' => [
                    [
                        'id' => PokedexNo::MAROWAK,
                        'level' => 37,
                    ],
                    [
                        'id' => PokedexNo::MAROWAK,
                        'level' => 37,
                    ],
                    [
                        'id' => PokedexNo::RHYHORN,
                        'level' => 38,
                    ],
                    [
                        'id' => PokedexNo::NIDORINA,
                        'level' => 39,
                    ],
                    [
                        'id' => PokedexNo::NIDOQUEEN,
                        'level' => 39,
                    ],
                ],
            ],
            [
                'id' => "13fc84dd-8ebf-4f45-a76f-bd1836045458",
                'name' => "Black Belt Takashi",
                'prize' => 912,
                'team' => [
                    [
                        'id' => PokedexNo::MACHOKE,
                        'level' => 38,
                    ],
                    [
                        'id' => PokedexNo::MACHOP,
                        'level' => 38,
                    ],
                    [
                        'id' => PokedexNo::MACHOKE,
                        'level' => 38,
                    ],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_2,
        'name' => "Route 2",
        'directions' => [
            LocationId::PEWTER_CITY,
            LocationId::VIRIDIAN_FOREST,
            LocationId::DIGLETTS_CAVE,
            LocationId::VIRIDIAN_CITY,
        ],
        'pokemon' => [
            PokedexNo::CATERPIE => [
                'weight' => 15,
                'levels' => [3, 5],
            ],
            PokedexNo::WEEDLE => [
                'weight' => 15,
                'levels' => [3, 5],
            ],
            PokedexNo::PIDGEY => [
                'weight' => 45,
                'levels' => [3, 5],
            ],
            PokedexNo::RATTATA => [
                'weight' => 40,
                'levels' => [2, 5],
            ],
            PokedexNo::NIDORAN_F => [
                'weight' => 15,
                'levels' => [4, 6],
            ],
            PokedexNo::NIDORAN_M => [
                'weight' => 15,
                'levels' => [4, 6],
            ],
        ],
    ],
    [
        'id' => LocationId::PEWTER_CITY,
        'name' => "Pewter City",
        'directions' => [
            LocationId::ROUTE_3,
            LocationId::PEWTER_GYM,
            LocationId::ROUTE_2,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 45,
                'levels' => [5, 7],
            ],
            PokedexNo::RATTATA => [
                'weight' => 15,
                'levels' => [5, 7],
            ],
            PokedexNo::SPEAROW => [
                'weight' => 45,
                'levels' => [5, 8],
            ],
            PokedexNo::SANDSHREW => [
                'weight' => 5,
                'levels' => [5, 8],
            ],
        ],
    ],
    [
        'id' => LocationId::PEWTER_GYM,
        'name' => "Pewter Gym",
        'directions' => [
            LocationId::PEWTER_CITY,
        ],
        'pokemon' => [],
        'trainers' => [
            [
                'id' => "50b4e614-c12d-4fd5-971b-c50fa9d7e7ef",
                'name' => "Camper Liam",
                'prize' => 220,
                'team' => [
                    [
                        'id' => PokedexNo::GEODUDE,
                        'level' => 10,
                    ],
                    [
                        'id' => PokedexNo::SANDSHREW,
                        'level' => 11,
                    ],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::VIRIDIAN_FOREST,
        'name' => "Viridian Forest",
        'directions' => [
            LocationId::ROUTE_2,
        ],
        'pokemon' => [
            PokedexNo::CATERPIE => [
                'weight' => 45,
                'levels' => [3, 5],
            ],
            PokedexNo::METAPOD => [
                'weight' => 5,
                'levels' => [4, 6],
            ],
            PokedexNo::WEEDLE => [
                'weight' => 45,
                'levels' => [3, 5],
            ],
            PokedexNo::KAKUNA => [
                'weight' => 5,
                'levels' => [4, 6],
            ],
            PokedexNo::PIDGEY => [
                'weight' => 5,
                'levels' => [4, 6],
            ],
            PokedexNo::PIDGEOTTO => [
                'weight' => 1,
                'levels' => [6, 7],
            ],
            PokedexNo::PIKACHU => [
                'weight' => 5,
                'levels' => [3, 5],
            ],
        ],
        'trainers' => [
            [
                'id' => "00416693-3615-4116-b964-f4960d9387e3",
                'name' => "Bug Catcher Rick",
                'prize' => 72,
                'team' => [
                    [
                        'id' => PokedexNo::WEEDLE,
                        'level' => 6,
                    ],
                    [
                        'id' => PokedexNo::CATERPIE,
                        'level' => 6,
                    ],
                ],
            ],
            [
                'id' => "1baa9345-2f66-4f32-9be1-bab484b6cb67",
                'name' => "Bug Catcher Doug",
                'prize' => 84,
                'team' => [
                    [
                        'id' => PokedexNo::WEEDLE,
                        'level' => 7,
                    ],
                    [
                        'id' => PokedexNo::KAKUNA,
                        'level' => 7,
                    ],
                    [
                        'id' => PokedexNo::WEEDLE,
                        'level' => 7,
                    ],
                ],
            ],
            [
                'id' => "6104398b-3034-425b-8b47-63bb63e43966",
                'name' => "Bug Catcher Anthony",
                'prize' => 96,
                'team' => [
                    [
                        'id' => PokedexNo::CATERPIE,
                        'level' => 7,
                    ],
                    [
                        'id' => PokedexNo::CATERPIE,
                        'level' => 8,
                    ],
                ],
            ],
        ],
    ],
    [
        'id' => LocationId::DIGLETTS_CAVE,
        'name' => "Diglett's Cave",
        'directions' => [
            LocationId::ROUTE_2,
            "8e24cb82-3708-4530-aa1a-09a8465a5d2e",
        ],
        'pokemon' => [
            PokedexNo::DIGLETT => [
                'weight' => 95,
                'levels' => [15, 22],
            ],
            PokedexNo::DUGTRIO => [
                'weight' => 5,
                'levels' => [29, 31],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_3,
        'name' => "Route 3",
        'directions' => [
            LocationId::PEWTER_CITY,
            LocationId::MT_MOON_F1,
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 30,
                'levels' => [6, 7],
            ],
            PokedexNo::SPEAROW => [
                'weight' => 35,
                'levels' => [6, 8],
            ],
            PokedexNo::NIDORAN_M => [
                'weight' => 15,
                'levels' => [6, 7],
            ],
            PokedexNo::NIDORAN_F => [
                'weight' => 15,
                'levels' => [6, 7],
            ],
            PokedexNo::JIGGLYPUFF => [
                'weight' => 10,
                'levels' => [3, 7],
            ],
            PokedexNo::MANKEY => [
                'weight' => 10,
                'levels' => 7,
            ],
        ],
    ],
    [
        'id' => LocationId::MT_MOON_F1,
        'name' => "Mt. Moon (1st Floor)",
        'directions' => [
            LocationId::ROUTE_3,
            LocationId::MT_MOON_BF1,
        ],
        'pokemon' => [
            PokedexNo::ZUBAT => [
                'weight' => 69,
                'levels' => [7, 10],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 25,
                'levels' => [7, 9],
            ],
            PokedexNo::PARAS => [
                'weight' => 5,
                'levels' => 8,
            ],
            PokedexNo::CLEFAIRY => [
                'weight' => 1,
                'levels' => 8,
            ],
        ],
    ],
    [
        'id' => LocationId::MT_MOON_BF1,
        'name' => "Mt. Moon (1st Basement Floor)",
        'directions' => [
            LocationId::MT_MOON_F1,
            LocationId::MT_MOON_BF2,
        ],
        'pokemon' => [
            PokedexNo::PARAS => [
                'weight' => 100,
                'levels' => [5, 10],
            ],
        ],
    ],
    [
        'id' => LocationId::MT_MOON_BF2,
        'name' => "Mt. Moon (2nd Basement Floor)",
        'directions' => [
            LocationId::MT_MOON_BF1,
            LocationId::ROUTE_4,
        ],
        'pokemon' => [
            PokedexNo::ZUBAT => [
                'weight' => 49,
                'levels' => [8, 11],
            ],
            PokedexNo::GEODUDE => [
                'weight' => 30,
                'levels' => [9, 10],
            ],
            PokedexNo::PARAS => [
                'weight' => 15,
                'levels' => [10, 12],
            ],
            PokedexNo::CLEFAIRY => [
                'weight' => 6,
                'levels' => [10, 12],
            ],
            PokedexNo::CHARMANDER => [
                'weight' => 5,
                'levels' => [7, 10],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_4,
        'name' => "Route 4",
        'directions' => [
            LocationId::MT_MOON_BF2,
            "cf6dff48-2972-4fe9-8853-9ccba685c38e",
        ],
        'pokemon' => [
            PokedexNo::RATTATA => [
                'weight' => 35,
                'levels' => [8, 12],
            ],
            PokedexNo::SPEAROW => [
                'weight' => 35,
                'levels' => [8, 12],
            ],
            PokedexNo::EKANS => [
                'weight' => 25,
                'levels' => [6, 12],
            ],
            PokedexNo::SANDSHREW => [
                'weight' => 25,
                'levels' => [6, 12],
            ],
            PokedexNo::MANKEY => [
                'weight' => 5,
                'levels' => [10, 12],
            ],
        ],
    ],
    [
        'id' => "cf6dff48-2972-4fe9-8853-9ccba685c38e",
        'name' => "Cerulean City",
        'directions' => [
            LocationId::ROUTE_24,
            LocationId::ROUTE_4,
            "57968d07-cea1-4a9b-ac21-53609a25ea36",
            "2ae61913-311d-4b24-87dd-934586badb5c",
        ],
        'pokemon' => [
            PokedexNo::PIDGEY => [
                'weight' => 55,
                'levels' => [5, 15],
            ],
            PokedexNo::RATTATA => [
                'weight' => 40,
                'levels' => [5, 15],
            ],
            PokedexNo::PSYDUCK => [
                'weight' => 5,
                'levels' => [5, 15],
            ],
        ],
    ],
    [
        'id' => "2ae61913-311d-4b24-87dd-934586badb5c",
        'name' => "Route 5",
        'directions' => [
            "cf6dff48-2972-4fe9-8853-9ccba685c38e",
            "96ab9b1c-dcd5-47f8-97b0-13dd864ae369",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "96ab9b1c-dcd5-47f8-97b0-13dd864ae369",
        'name' => "Saffron City",
        'directions' => [
            "2ae61913-311d-4b24-87dd-934586badb5c",
            "85776d72-ece8-451f-a8b8-5b1f9c2b349b",
            "a006849d-3c22-4b57-b6d9-3ab23f6f42cf",
            "8ceee5a8-54dd-4c63-9629-40bff24f3b2d",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "8ceee5a8-54dd-4c63-9629-40bff24f3b2d",
        'name' => "Route 6",
        'directions' => [
            "96ab9b1c-dcd5-47f8-97b0-13dd864ae369",
            "41b38040-2b0b-4a4e-9333-67fc7a5bb003",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "41b38040-2b0b-4a4e-9333-67fc7a5bb003",
        'name' => "Vermillion City",
        'directions' => [
            "8ceee5a8-54dd-4c63-9629-40bff24f3b2d",
            "8e24cb82-3708-4530-aa1a-09a8465a5d2e",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "85776d72-ece8-451f-a8b8-5b1f9c2b349b",
        'name' => "Route 7",
        'directions' => [
            "57564cf4-9ac8-4b24-af13-eb158d969bb4",
            "96ab9b1c-dcd5-47f8-97b0-13dd864ae369",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "57564cf4-9ac8-4b24-af13-eb158d969bb4",
        'name' => "Celadon City",
        'directions' => [
            "2f0bc600-51c8-4621-9c72-124b5349beb2",
            "85776d72-ece8-451f-a8b8-5b1f9c2b349b",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "a006849d-3c22-4b57-b6d9-3ab23f6f42cf",
        'name' => "Route 8",
        'directions' => [
            "96ab9b1c-dcd5-47f8-97b0-13dd864ae369",
            "80bc57a9-d0b9-4d19-9232-5f5cdc1070ed",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "80bc57a9-d0b9-4d19-9232-5f5cdc1070ed",
        'name' => "Lavender Town",
        'directions' => [
            "3d732b49-da46-4985-bd04-a59cce17ee44",
            "a006849d-3c22-4b57-b6d9-3ab23f6f42cf",
            "3387518a-aece-49e0-9563-ca645f881a00",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "57968d07-cea1-4a9b-ac21-53609a25ea36",
        'name' => "Route 9",
        'directions' => [
            "cf6dff48-2972-4fe9-8853-9ccba685c38e",
            "dca3ae52-de54-413b-a838-b4ddf6da97d5",
            "01f3a7cb-ca9e-47bc-9976-7e8dbc5c79ad",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "01f3a7cb-ca9e-47bc-9976-7e8dbc5c79ad",
        'name' => "Power Plant",
        'directions' => [
            "57968d07-cea1-4a9b-ac21-53609a25ea36",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "dca3ae52-de54-413b-a838-b4ddf6da97d5",
        'name' => "Rock Tunnel",
        'directions' => [
            "57968d07-cea1-4a9b-ac21-53609a25ea36",
            "3d732b49-da46-4985-bd04-a59cce17ee44",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "3d732b49-da46-4985-bd04-a59cce17ee44",
        'name' => "Route 10",
        'directions' => [
            "dca3ae52-de54-413b-a838-b4ddf6da97d5",
            "80bc57a9-d0b9-4d19-9232-5f5cdc1070ed",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "8e24cb82-3708-4530-aa1a-09a8465a5d2e",
        'name' => "Route 11",
        'directions' => [
            LocationId::DIGLETTS_CAVE,
            "41b38040-2b0b-4a4e-9333-67fc7a5bb003",
            "3387518a-aece-49e0-9563-ca645f881a00",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "3387518a-aece-49e0-9563-ca645f881a00",
        'name' => "Route 12",
        'directions' => [
            "80bc57a9-d0b9-4d19-9232-5f5cdc1070ed",
            "8e24cb82-3708-4530-aa1a-09a8465a5d2e",
            "22f4d2be-a20a-4c13-9d8e-1085b59e49f4",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "22f4d2be-a20a-4c13-9d8e-1085b59e49f4",
        'name' => "Route 13",
        'directions' => [
            "cf81b643-7eb8-407d-8975-44c26b09533a",
            "3387518a-aece-49e0-9563-ca645f881a00",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "cf81b643-7eb8-407d-8975-44c26b09533a",
        'name' => "Route 14",
        'directions' => [
            "22f4d2be-a20a-4c13-9d8e-1085b59e49f4",
            "4bc982c5-1303-42cd-b55b-6cdfc3402d15",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "4bc982c5-1303-42cd-b55b-6cdfc3402d15",
        'name' => "Route 15",
        'directions' => [
            "e4f336d0-78a0-49bb-87a8-beceb810c097",
            "cf81b643-7eb8-407d-8975-44c26b09533a",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "e4f336d0-78a0-49bb-87a8-beceb810c097",
        'name' => "Fuchsia City",
        'directions' => [
            "0383556c-0b2e-4a33-a178-1b078fc60352",
            "ed95c624-3b6e-410e-b527-62f56d17f5f6",
            "4bc982c5-1303-42cd-b55b-6cdfc3402d15",
            "27940ef2-9539-4cdf-b16b-1551cf5259e3",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "0383556c-0b2e-4a33-a178-1b078fc60352",
        'name' => "Safari Zone (South)",
        'directions' => [
            "a44f53b0-5bb8-4fab-944b-07a1d027981e",
            "8dbd8491-1e94-4a2b-8bfe-b3e019d92c6f",
            "e0958c26-8d73-48a9-9e13-c4f73d6ae1e8",
            "e4f336d0-78a0-49bb-87a8-beceb810c097",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "a44f53b0-5bb8-4fab-944b-07a1d027981e",
        'name' => "Safari Zone (North)",
        'directions' => [
            "8dbd8491-1e94-4a2b-8bfe-b3e019d92c6f",
            "e0958c26-8d73-48a9-9e13-c4f73d6ae1e8",
            "0383556c-0b2e-4a33-a178-1b078fc60352",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "e0958c26-8d73-48a9-9e13-c4f73d6ae1e8",
        'name' => "Safari Zone (East)",
        'directions' => [
            "a44f53b0-5bb8-4fab-944b-07a1d027981e",
            "0383556c-0b2e-4a33-a178-1b078fc60352",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "8dbd8491-1e94-4a2b-8bfe-b3e019d92c6f",
        'name' => "Safari Zone (West)",
        'directions' => [
            "a44f53b0-5bb8-4fab-944b-07a1d027981e",
            "0383556c-0b2e-4a33-a178-1b078fc60352",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "2f0bc600-51c8-4621-9c72-124b5349beb2",
        'name' => "Route 16",
        'directions' => [
            "57564cf4-9ac8-4b24-af13-eb158d969bb4",
            "14ff0830-f6b9-413c-8b62-cca8d9943755",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "14ff0830-f6b9-413c-8b62-cca8d9943755",
        'name' => "Route 17",
        'directions' => [
            "2f0bc600-51c8-4621-9c72-124b5349beb2",
            "ed95c624-3b6e-410e-b527-62f56d17f5f6",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "ed95c624-3b6e-410e-b527-62f56d17f5f6",
        'name' => "Route 18",
        'directions' => [
            "14ff0830-f6b9-413c-8b62-cca8d9943755",
            "e4f336d0-78a0-49bb-87a8-beceb810c097",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "27940ef2-9539-4cdf-b16b-1551cf5259e3",
        'name' => "Route 19",
        'directions' => [
            "ed95c624-3b6e-410e-b527-62f56d17f5f6",
            "4311bda4-3e6a-46be-944d-4df4301c696d",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "4311bda4-3e6a-46be-944d-4df4301c696d",
        'name' => "Route 20",
        'directions' => [
            "a5520b4e-314b-4893-b56d-63b102295956",
            "3d36df91-cc9b-474a-9ae9-c53b5d15470b",
            "27940ef2-9539-4cdf-b16b-1551cf5259e3",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "3d36df91-cc9b-474a-9ae9-c53b5d15470b",
        'name' => "Seafoam Islands",
        'directions' => [
            "4311bda4-3e6a-46be-944d-4df4301c696d",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "a5520b4e-314b-4893-b56d-63b102295956",
        'name' => "Cinnabar Island",
        'directions' => [
            "e2d59a4a-52c0-4daf-98e6-d7714bbb1c6a",
            "4311bda4-3e6a-46be-944d-4df4301c696d",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "e2d59a4a-52c0-4daf-98e6-d7714bbb1c6a",
        'name' => "Route 21",
        'directions' => [
            LocationId::PALLET_TOWN,
            "a5520b4e-314b-4893-b56d-63b102295956",
        ],
        'pokemon' => [
            "16" => [
                'weight' => 4,
                'levels' => [21, 23],
            ],
            "19" => [
                'weight' => 5,
                'levels' => [21, 23],
            ],
            "114" => [
                'weight' => 1,
                'levels' => [28, 32],
            ],
        ],
    ],
    [
        'id' => LocationId::ROUTE_22,
        'name' => "Route 22",
        'directions' => [
            "2335aa04-4bde-421c-b27e-a680cb3e36b0",
            LocationId::VIRIDIAN_CITY,
        ],
        'pokemon' => [
            PokedexNo::RATTATA => [
                'weight' => 45,
                'levels' => [2, 4],
            ],
            PokedexNo::SPEAROW => [
                'weight' => 10,
                'levels' => [3, 5],
            ],
            PokedexNo::NIDORAN_M => [
                'weight' => 5,
                'levels' => [3, 4],
            ],
            PokedexNo::NIDORAN_F => [
                'weight' => 5,
                'levels' => [3, 4],
            ],
            PokedexNo::MANKEY => [
                'weight' => 20,
                'levels' => [3, 5],
            ],
        ],
    ],
    [
        'id' => "2335aa04-4bde-421c-b27e-a680cb3e36b0",
        'name' => "Victory Road",
        'directions' => [
            "d0c0bf10-689c-4d49-bc6f-044fa5f343f6",
            LocationId::ROUTE_22,
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "d0c0bf10-689c-4d49-bc6f-044fa5f343f6",
        'name' => "Route 23",
        'directions' => [
            "36c7585c-c0df-4bd5-8e50-5c92487d44d8",
            "2335aa04-4bde-421c-b27e-a680cb3e36b0",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => "36c7585c-c0df-4bd5-8e50-5c92487d44d8",
        'name' => "Indigo Plateau",
        'directions' => [
            "d0c0bf10-689c-4d49-bc6f-044fa5f343f6",
        ],
        'pokemon' => [
        ],
    ],
    [
        'id' => LocationId::ROUTE_24,
        'name' => "Route 24",
        'directions' => [
            "bb9a23b0-c473-46ae-b663-fdabc187a7f0",
            "feeeeeca-6304-4072-b2c5-3f7babcfa171",
            "cf6dff48-2972-4fe9-8853-9ccba685c38e",
        ],
        'pokemon' => [
            PokedexNo::CATERPIE => [
                'weight' => 20,
                'levels' => 7,
            ],
            PokedexNo::METAPOD => [
                'weight' => 5,
                'levels' => 8,
            ],
            PokedexNo::WEEDLE => [
                'weight' => 20,
                'levels' => 7,
            ],
            PokedexNo::KAKUNA => [
                'weight' => 5,
                'levels' => 8,
            ],
            PokedexNo::PIDGEY => [
                'weight' => 15,
                'levels' => [11, 13],
            ],
            PokedexNo::ODDISH => [
                'weight' => 25,
                'levels' => [12, 14],
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 25,
                'levels' => [12, 14],
            ],
            PokedexNo::ABRA => [
                'weight' => 15,
                'levels' => [8, 12],
            ],
            PokedexNo::BULBASAUR => [
                'weight' => 5,
                'levels' => [7, 11],
            ],
        ],
    ],
    [
        'id' => "bb9a23b0-c473-46ae-b663-fdabc187a7f0",
        'name' => "Route 25",
        'directions' => [
            LocationId::ROUTE_24,
        ],
        'pokemon' => [
            PokedexNo::CATERPIE => [
                'weight' => 20,
                'levels' => 8,
            ],
            PokedexNo::METAPOD => [
                'weight' => 5,
                'levels' => 9,
            ],
            PokedexNo::WEEDLE => [
                'weight' => 20,
                'levels' => 8,
            ],
            PokedexNo::KAKUNA => [
                'weight' => 5,
                'levels' => 9,
            ],
            PokedexNo::PIDGEY => [
                'weight' => 15,
                'levels' => [11, 13],
            ],
            PokedexNo::ODDISH => [
                'weight' => 25,
                'levels' => [12, 14],
            ],
            PokedexNo::BELLSPROUT => [
                'weight' => 25,
                'levels' => [12, 14],
            ],
            PokedexNo::ABRA => [
                'weight' => 15,
                'levels' => [9, 13],
            ],
            PokedexNo::BULBASAUR => [
                'weight' => 5,
                'levels' => [7, 11],
            ],
        ],
    ],
    [
        'id' => "feeeeeca-6304-4072-b2c5-3f7babcfa171",
        'name' => "Cerulean Cave",
        'directions' => [
            LocationId::ROUTE_24,
        ],
        'pokemon' => [
        ],
    ],
];
