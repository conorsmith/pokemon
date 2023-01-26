<?php
declare(strict_types=1);

use ConorSmith\Pokemon\Gender;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\TrainerClass;

return [
    LocationId::VIRIDIAN_GYM => [
        [
            'id' => "dd360fe7-c9bd-46d8-9c30-f8ce4e09566d",
            'class' => TrainerClass::TAMER,
            'name' => "Cole",
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
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Kiyo",
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "d8b3ba34-ec2f-46b8-b298-baf721535799",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Samuel",
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
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Yuji",
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
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Atsushi",
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
            'class' => TrainerClass::TAMER,
            'name' => "Jason",
            'team' => [
                [
                    'id' => PokedexNo::RHYHORN,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "ec68491a-0468-4df0-bdfd-e687abd2c320",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Warren",
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
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Takashi",
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
        [
            'id' => "b43cbd0a-8ee2-4434-a9fb-17658419b397",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Giovanni",
            'leader' => [
                'badge' => GymBadge::EARTH,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/4/41/Spr_FRLG_Giovanni.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::RHYHORN,
                    'level' => 45,
                ],
                [
                    'id' => PokedexNo::DUGTRIO,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::NIDOQUEEN,
                    'level' => 44,
                ],
                [
                    'id' => PokedexNo::NIDOKING,
                    'level' => 45,
                ],
                [
                    'id' => PokedexNo::RHYHORN,
                    'level' => 50,
                ],
            ],
        ],
    ],
    LocationId::VIRIDIAN_FOREST => [
        [
            'id' => "00416693-3615-4116-b964-f4960d9387e3",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Rick",
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
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Doug",
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
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Anthony",
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
        [
            'id' => "61db743d-898f-4fd1-b008-cb5372c7aaac",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Charlie",
            'team' => [
                [
                    'id' => PokedexNo::METAPOD,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::METAPOD,
                    'level' => 7,
                ],
            ],
        ],
        [
            'id' => "e0062ee9-80a5-447d-b154-bc8ed18e66c5",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Sammy",
            'team' => [
                [
                    'id' => PokedexNo::WEEDLE,
                    'level' => 9,
                ],
            ],
        ],
    ],
    LocationId::PEWTER_GYM => [
        [
            'id' => "50b4e614-c12d-4fd5-971b-c50fa9d7e7ef",
            'class' => TrainerClass::CAMPER,
            'name' => "Liam",
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
        [
            'id' => "2479266d-ecf1-42b2-be4a-17df18812e39",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Brock",
            'leader' => [
                'badge' => GymBadge::BOULDER,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/7/7c/Spr_FRLG_Brock.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 14,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_3 => [
        [
            'id' => "3d410683-83c3-4468-941d-dd82e29ba463",
            'class' => TrainerClass::LASS,
            'name' => "Janice",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 9,
                ],
            ],
        ],
        [
            'id' => "ab99af27-166e-4484-871e-ce3c133ee574",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Colton",
            'team' => [
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::WEEDLE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "72a6fd36-f423-441a-a8d4-67c0c7c82bb9",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Ben",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "292e67aa-5816-498e-a651-a046c9c0f218",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Greg",
            'team' => [
                [
                    'id' => PokedexNo::WEEDLE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::KAKUNA,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::METAPOD,
                    'level' => 9,
                ],
            ],
        ],
        [
            'id' => "12c07ff5-db6c-4dff-9b52-cc410696bb3a",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Calvin",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "9801d94e-3fe3-4926-8236-fb54f2fc9f4a",
            'class' => TrainerClass::LASS,
            'name' => "Sally",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "142303ea-95d7-48d8-b04c-3bc14b62e843",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "James",
            'team' => [
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::METAPOD,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "5c8cb4a4-6b5d-4792-a64c-35b83b97fb48",
            'class' => TrainerClass::LASS,
            'name' => "Robin",
            'team' => [
                [
                    'id' => PokedexNo::JIGGLYPUFF,
                    'level' => 14,
                ],
            ],
        ],
    ],
    LocationId::MT_MOON_F1 => [
        [
            'id' => "e60ee806-2ee3-402b-bfe8-63c542415c9b",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Kent",
            'team' => [
                [
                    'id' => PokedexNo::WEEDLE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::KAKUNA,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "6d9d3f18-3f5f-4070-87d8-c27bf1cbfa1f",
            'class' => TrainerClass::LASS,
            'name' => "Iris",
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "43b51234-6a2c-4a12-b79a-986bb8573920",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Jovan",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "244d8e7a-270a-4c0b-a0b9-3a6c919b15cb",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Robby",
            'team' => [
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::METAPOD,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "ada0b9c5-1a6c-4edf-8f7d-872bb6fd0e86",
            'class' => TrainerClass::LASS,
            'name' => "Miriam",
            'team' => [
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "f17d2ee3-4953-469c-958a-98acc0328661",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Josh",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "f39b761f-6d10-479f-ae83-25167b642fbf",
            'class' => TrainerClass::HIKER,
            'name' => "Marcos",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 10,
                ],
            ],
        ],
    ],
    LocationId::MT_MOON_BF2 => [
        [
            'id' => "4f645f93-eed6-481b-8ae1-929b8a41a152",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'name' => null,
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "4992974a-7caf-47cd-9d43-2173dd27611f",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'name' => null,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "4ec62b20-e4fb-4f6d-9a77-0c094307d1de",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'name' => null,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 13,
                ],
            ],
        ],
        [
            'id' => "19d60f6e-1410-4969-b12a-e0a11be80487",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'name' => null,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 13,
                ],
            ],
        ],
        [
            'id' => "aeed00e6-f516-4abd-beb8-3880b5a13b4a",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Miguel",
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 12,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_4 => [
        [
            'id' => "ec541867-70af-4689-94a5-ad4d630a365d",
            'class' => TrainerClass::LASS,
            'name' => "Crissy",
            'team' => [
                [
                    'id' => PokedexNo::PARAS,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::PARAS,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::PARASECT,
                    'level' => 31,
                ],
            ],
        ],
    ],
    LocationId::CERULEAN_GYM => [
        [
            'id' => "5c6abc10-9905-4b24-b79e-7081fde8e2f1",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Luis",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "4d6193af-acf7-4ae4-81ca-35c2f6b52d73",
            'class' => TrainerClass::PICNICKER,
            'name' => "Diana",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "a7d055c0-8a2a-436e-ac27-302be6bf358d",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Misty",
            'leader' => [
                'badge' => GymBadge::CASCADE,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/2/2c/Spr_FRLG_Misty.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::STARMIE,
                    'level' => 21,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_24 => [
        [
            'id' => "99f5686a-854b-4bf1-a787-12fc2ea5f8f4",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Cale",
            'team' => [
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::WEEDLE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::METAPOD,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::KAKUNA,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "0e4dbb3e-f2f0-420e-9f06-40ef7869e66f",
            'class' => TrainerClass::LASS,
            'name' => "Ali",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "1d890a8d-2df8-40ca-878b-6c283beca8ea",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Timmy",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "e0a1ea55-36c9-47cd-9bef-c5b08154a89e",
            'class' => TrainerClass::LASS,
            'name' => "Reli",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "63be8cfd-cf92-48ed-9cd4-f7f8f90487b7",
            'class' => TrainerClass::CAMPER,
            'name' => "Ethan",
            'team' => [
                [
                    'id' => PokedexNo::MANKEY,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "d9c721c2-4124-42f3-945e-affcaf311906",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'team' => [
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "99e27892-564b-4681-a5eb-7d1450ff813f",
            'class' => TrainerClass::CAMPER,
            'name' => "Shane",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 14,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_25 => [
        [
            'id' => "30ae370a-a1bf-4671-858c-d8bf81578b38",
            'class' => TrainerClass::HIKER,
            'name' => "Franklin",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "95774a7b-4b8b-4b3a-8dfd-a086a55739b5",
            'class' => TrainerClass::HIKER,
            'name' => "Wayne",
            'team' => [
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "d7defca6-7d0f-425a-8528-6760d96eb492",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Joey",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "2e38b9d2-7d85-4591-951c-0e2e628830a0",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Dan",
            'team' => [
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "86bfbc74-61a1-4466-b005-2015abd90b0a",
            'class' => TrainerClass::PICNICKER,
            'name' => "Kelsey",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "0b88ad46-9e74-44aa-9adf-187a14cc3c45",
            'class' => TrainerClass::HIKER,
            'name' => "Nob",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 13,
                ],
            ],
        ],
        [
            'id' => "d5cb861b-4caa-4b8a-ae34-f21d08365fa8",
            'class' => TrainerClass::CAMPER,
            'name' => "Flint",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "22f99891-6e4e-44d5-8297-7852e3c56f09",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Chad",
            'team' => [
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "b069096f-d7b7-4bdb-9f2c-33985d1d8b3a",
            'class' => TrainerClass::LASS,
            'name' => "Haley",
            'team' => [
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 13,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_6 => [
        [
            'id' => "ba1f10f7-521d-4150-adeb-21e41641b282",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Keigo",
            'team' => [
                [
                    'id' => PokedexNo::WEEDLE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::WEEDLE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "0e108f6f-fa91-4bb9-aeda-92c8a028d853",
            'class' => TrainerClass::CAMPER,
            'name' => "Ricky",
            'team' => [
                [
                    'id' => PokedexNo::SQUIRTLE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "86e3dd53-9ac3-4eb2-af59-8507bba8a676",
            'class' => TrainerClass::PICNICKER,
            'name' => "Nancy",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "d3f23e41-9ae2-4cb3-803a-633411fdf9b8",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Elijah",
            'team' => [
                [
                    'id' => PokedexNo::BUTTERFREE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "1b91f2ad-f5d1-4dec-9fd1-1d7c98b87676",
            'class' => TrainerClass::PICNICKER,
            'name' => "Isabelle",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "dd966e79-aa89-4fe6-b7a0-bfd4fb0404ab",
            'class' => TrainerClass::CAMPER,
            'name' => "Jeff",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 16,
                ],
            ],
        ],
    ],
    LocationId::VERMILLION_GYM => [
        [
            'id' => "be9c814b-fb3b-4b21-b5b7-02f9c2149cab",
            'class' => TrainerClass::SAILOR,
            'name' => "Dwayne",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "a2ee4d45-a808-4ea1-85ed-64cf9d4f2fd3",
            'class' => TrainerClass::ENGINEER,
            'name' => "Baily",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "d9e8e5f0-7d3b-47d4-8974-c103156f039b",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Tucker",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "03f428a4-a0ca-441a-88a5-ccb391803201",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Lt. Surge",
            'leader' => [
                'badge' => GymBadge::THUNDER,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/5/5c/Spr_FRLG_Lt_Surge.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::RAICHU,
                    'level' => 24,
                ],
            ],
        ],
    ],
    LocationId::SS_ANNE_1F => [
        [
            'id' => "0f347800-0a11-4c96-9384-decaa142068c",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Thomas",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "378c2852-abb2-4027-916f-91822eff62f7",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Arthur",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "8ea59a3f-9fa8-4875-924c-8d3d42f7283b",
            'class' => TrainerClass::LASS,
            'name' => "Ann",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "4c859d72-b4d3-4a32-aa20-e389a0f024d9",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Tyler",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'level' => 21,
                ],
            ],
        ],
    ],
    LocationId::SS_ANNE_B1F => [
        [
            'id' => "3c4b53e0-abcf-4484-b20d-15434c4ec10f",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Barny",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "15acd9a4-a35b-479b-9b5d-e47a344ab15f",
            'class' => TrainerClass::SAILOR,
            'name' => "Phillip",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "c4ccc61b-80ce-482b-b012-bf8fce912676",
            'class' => TrainerClass::SAILOR,
            'name' => "Huey",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "a60859b8-ea33-4cbd-ae8e-816f9db7812e",
            'class' => TrainerClass::SAILOR,
            'name' => "Dylan",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "d523b590-0f43-4185-8186-b42c70af63ea",
            'class' => TrainerClass::SAILOR,
            'name' => "Duncan",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "7c65d343-2024-435a-9334-f75c571a2151",
            'class' => TrainerClass::SAILOR,
            'name' => "Leonard",
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 21,
                ],
            ],
        ],
    ],
    LocationId::SS_ANNE_2F => [
        [
            'id' => "32e2d20c-6a95-44df-8424-c57065af1d4b",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Dale",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "c75425b7-5e46-4cf2-bbe7-184d943f079d",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Brooks",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "6681780b-e616-4a1b-9039-d0007ea02aa5",
            'class' => TrainerClass::LASS,
            'name' => "Dawn",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "dc7cfe62-d7af-4866-9d84-361f44039c37",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Lamar",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::PONYTA,
                    'level' => 17,
                ],
            ],
        ],
    ],
    LocationId::SS_ANNE_DECK => [
        [
            'id' => "d3410b6d-699e-47de-b0b6-18fa399cb6f6",
            'class' => TrainerClass::SAILOR,
            'name' => "Trevor",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "32934365-f240-4554-8ee8-50cd259881eb",
            'class' => TrainerClass::SAILOR,
            'name' => "Edmond",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_11 => [
        [
            'id' => "65f70fa3-5107-4a80-8478-a2bacc6ab479",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Eddie",
            'team' => [
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "af603df6-a860-451a-990e-9b1a18c5e5a9",
            'class' => TrainerClass::GAMER,
            'name' => "Hugo",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "a72dc85f-840b-48d7-acea-47bf7ad30bd0",
            'class' => TrainerClass::ENGINEER,
            'name' => "Bernie",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::MAGNETON,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "f4f31bef-b053-4986-960f-13cff4f19ab3",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Dave",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "b3c9397d-0f2a-4f28-ac48-0aebb5377573",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Dillon",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "145fb209-d28b-4ef1-a169-0415e9c4cc7c",
            'class' => TrainerClass::GAMER,
            'name' => "Jasper",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "c4214bde-2148-43d7-8396-77ebf1ed0754",
            'class' => TrainerClass::ENGINEER,
            'name' => "Braxton",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "65f05e29-395f-4c88-a39f-5d31a39efccb",
            'class' => TrainerClass::GAMER,
            'name' => "Darian",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::VULPIX,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "a9758f94-6ffa-4ffd-a311-f456d6978b04",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Yasu",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "3c1beb0c-f4a9-44a6-aa42-484294da7b1a",
            'class' => TrainerClass::GAMER,
            'name' => "Dirk",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_9 => [
        [
            'id' => "b988971d-e736-45d5-bb96-f377f049764b",
            'class' => TrainerClass::PICNICKER,
            'name' => "Alicia",
            'team' => [
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "48bd84eb-4cd7-4ec9-8e22-796230eda7b3",
            'class' => TrainerClass::HIKER,
            'name' => "Jeremy",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "8099df0b-f9aa-4a75-ae1f-8109fd62f6f5",
            'class' => TrainerClass::CAMPER,
            'name' => "Chris",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::CHARMANDER,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "0365173c-541d-4922-bd7d-b3feefad9383",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Brent",
            'team' => [
                [
                    'id' => PokedexNo::BEEDRILL,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::BEEDRILL,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "1f67bb10-ed0d-43fd-89b1-f31e25c5f1b7",
            'class' => TrainerClass::HIKER,
            'name' => "Alan",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "0d44dc56-cf89-41fc-8c78-be70e8c17bab",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Conner",
            'team' => [
                [
                    'id' => PokedexNo::CATERPIE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::WEEDLE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::VENONAT,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "49fbe0fc-0861-4354-8a6f-3fbf6da61992",
            'class' => TrainerClass::CAMPER,
            'name' => "Drew",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "8ce8b443-9971-4cc0-bff3-90493c85ad83",
            'class' => TrainerClass::HIKER,
            'name' => "Brice",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "c196b66e-66ba-452b-aa99-be1971194cc1",
            'class' => TrainerClass::PICNICKER,
            'name' => "Caitlin",
            'team' => [
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "ed8b9ca8-881f-450f-ae22-b02926f94423",
            'class' => TrainerClass::PICNICKER,
            'name' => "Heidi",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "cb0034ca-9393-48a2-9581-db0b3b6b0bfe",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Mark",
            'team' => [
                [
                    'id' => PokedexNo::RHYHORN,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::LICKITUNG,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::ROCK_TUNNEL_1F => [
        [
            'id' => "72ba6b08-0ef6-4ceb-9cc3-5c68f573ffab",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Ashton",
            'team' => [
                [
                    'id' => PokedexNo::CUBONE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "1a8a1936-8e48-45ea-b1f0-83063eed6d20",
            'class' => TrainerClass::HIKER,
            'name' => "Lenny",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "f9f4a612-7d0a-4604-bb62-518afef1786a",
            'class' => TrainerClass::HIKER,
            'name' => "Oliver",
            'team' => [
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "82499d37-1aa3-4715-98f2-b8b6ebcd2267",
            'class' => TrainerClass::HIKER,
            'name' => "Lucas",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "8242fb82-39d7-4e93-8749-cad0a653db60",
            'class' => TrainerClass::PICNICKER,
            'name' => "Leah",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "e4375630-ab5b-4e20-9c0a-3f8837c41764",
            'class' => TrainerClass::PICNICKER,
            'name' => "Ariana",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "6d9fb813-cc7a-4adc-87a5-d5a9d8b44912",
            'class' => TrainerClass::PICNICKER,
            'name' => "Dana",
            'team' => [
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 20,
                ],
            ],
        ],
    ],
    LocationId::ROCK_TUNNEL_B1F => [
        [
            'id' => "120cd08d-8d40-43b3-8d15-e45c5d410197",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Winston",
            'team' => [
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "33122a2d-322b-4b7d-93f2-3c19bcd0c612",
            'class' => TrainerClass::PICNICKER,
            'name' => "Martha",
            'team' => [
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::BULBASAUR,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "d1bfea0e-ce9d-4e72-b656-773929d3f6a6",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Steve",
            'team' => [
                [
                    'id' => PokedexNo::CHARMANDER,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::CUBONE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "222d97a3-7c45-48ce-988b-bb361f31ed40",
            'class' => TrainerClass::HIKER,
            'name' => "Allen",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "d1b45631-ae08-41a1-9c3e-500060e74885",
            'class' => TrainerClass::HIKER,
            'name' => "Eric",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "7448c161-0f97-4059-9ac7-1b04164a9ec2",
            'class' => TrainerClass::PICNICKER,
            'name' => "Sofia",
            'team' => [
                [
                    'id' => PokedexNo::JIGGLYPUFF,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "4a3e344a-929e-48ad-afec-492989457e1f",
            'class' => TrainerClass::HIKER,
            'name' => "Dudley",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "b1ba820c-8a4b-4132-9575-33fb6c3d561b",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Cooper",
            'team' => [
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 20,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_10 => [
        [
            'id' => "e25a0ffb-9cf9-4b23-ae0e-b3d3c510fd52",
            'class' => TrainerClass::PICNICKER,
            'name' => "Carol",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "9b7df5ba-982e-4d66-a4d5-828abf9e4135",
            'class' => TrainerClass::HIKER,
            'name' => "Clark",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "f75b130e-067c-42b0-bafe-89f666cd4323",
            'class' => TrainerClass::HIKER,
            'name' => "Trent",
            'team' => [
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "0185086d-5324-4887-9c0d-c60e42fd6b4a",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Herman",
            'team' => [
                [
                    'id' => PokedexNo::CUBONE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 20,
                ],
            ],
        ],
    ],
    LocationId::POKEMON_TOWER_3F => [
        [
            'id' => "92ce1fa2-a713-4f50-afe7-16f39a92d6eb",
            'class' => TrainerClass::CHANNELER,
            'name' => "Hope",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "013de3a9-fc49-42c1-ac69-53e6e7492f70",
            'class' => TrainerClass::CHANNELER,
            'name' => "Patricia",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "a33d8aef-efd1-410a-a6c5-d6392980c6f5",
            'class' => TrainerClass::CHANNELER,
            'name' => "Carly",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 24,
                ],
            ],
        ],
    ],
    LocationId::POKEMON_TOWER_4F => [
        [
            'id' => "db8e258b-419c-470f-92ec-20ace369746c",
            'class' => TrainerClass::CHANNELER,
            'name' => "Laurel",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "885428b6-c523-4deb-9512-dfdca23eb0a7",
            'class' => TrainerClass::CHANNELER,
            'name' => "Jody",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "5c06a5bf-17f8-439a-a144-49b737edfba9",
            'class' => TrainerClass::CHANNELER,
            'name' => "Paula",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 24,
                ],
            ],
        ],
    ],
    LocationId::POKEMON_TOWER_5F => [
        [
            'id' => "d794b035-2d31-4000-ab68-866aa489d7b7",
            'class' => TrainerClass::CHANNELER,
            'name' => "Ruth",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "b8d35177-0a76-44b9-a89c-7c36ac563b86",
            'class' => TrainerClass::CHANNELER,
            'name' => "Tammy",
            'team' => [
                [
                    'id' => PokedexNo::HAUNTER,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "929a234c-ed42-414e-8865-61546018d826",
            'class' => TrainerClass::CHANNELER,
            'name' => "Karina",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "ce63f6e5-1d97-4be4-bd88-482724ffea1c",
            'class' => TrainerClass::CHANNELER,
            'name' => "Janae",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 22,
                ],
            ],
        ],
    ],
    LocationId::POKEMON_TOWER_6F => [
        [
            'id' => "0f507938-4ba9-46f6-bf66-5c575a497afc",
            'class' => TrainerClass::CHANNELER,
            'name' => "Angelica",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "956752e0-06ce-480c-95d3-b2b171a6e62f",
            'class' => TrainerClass::CHANNELER,
            'name' => "Jennifer",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "c086dff5-9d0e-42fb-b962-c3c4dbdebf25",
            'class' => TrainerClass::CHANNELER,
            'name' => "Emilia",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 24,
                ],
            ],
        ],
    ],
    LocationId::POKEMON_TOWER_7F => [
        [
            'id' => "6ba1b67c-d49e-4340-aeac-ecaabdc33618",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "1f1130d0-a49f-4e95-9227-a85790427e00",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "6b64c52f-16b7-49ac-b0a0-c5c94118163b",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 23,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_8 => [
        [
            'id' => "5be79a45-7c60-4fc9-a5c5-b5c61020fed0",
            'class' => TrainerClass::LASS,
            'name' => "Julia",
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "c72b5b24-c99a-4d33-82bd-5560208d9aa2",
            'class' => TrainerClass::GAMER,
            'name' => "Rich",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::VULPIX,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "0f0b37cb-8c0d-40f3-8ba7-49892be3f78b",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Glenn",
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "c5280d3f-db52-4f04-b4c6-9d3c42d091ed",
            'class' => TrainerClass::TWINS,
            'name' => "Eli & Anne",
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::JIGGLYPUFF,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "6f6bc9f5-12a3-4dad-aed1-9c149ce0bc6a",
            'class' => TrainerClass::LASS,
            'name' => "Paige",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "e3004964-9b9b-412c-a4d3-2ae2f40dafa6",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Leslie",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "9699cdad-aff3-4436-90b8-8d9f5162383c",
            'class' => TrainerClass::LASS,
            'name' => "Andrea",
            'team' => [
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "a11513e1-9afc-4951-97a7-3b5b4ae97fbe",
            'class' => TrainerClass::LASS,
            'name' => "Megan",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "bc57d6f9-6dab-464d-8750-516ec5bb7a48",
            'class' => TrainerClass::BIKER,
            'name' => "Jaren",
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "db5a003f-8829-4e6a-8af4-08dc8f15e33a",
            'class' => TrainerClass::BIKER,
            'name' => "Ricardo",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "b584f24a-f395-4878-9cd0-7cac7937debe",
            'class' => TrainerClass::GAMER,
            'name' => "Stan",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "3f0eabf6-cf09-4fe8-bc26-fc0c712a8af0",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Aidan",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 20,
                ],
            ],
        ],
    ],
    LocationId::CELADON_GYM => [
        [
            'id' => "5e537726-5069-4aa0-87b8-13de46c9a1c7",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Erika",
            'leader' => [
                'badge' => GymBadge::RAINBOW,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/c/c9/Spr_FRLG_Erika.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::VICTREEBEL,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::TANGELA,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::VILEPLUME,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::TEAM_ROCKET_HIDEOUT_B1F => [
        [
            'id' => "a6e829fd-13bb-4a27-8ef6-73bce173a36f",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "72a63583-733f-4dbb-918f-e14dd49b62a2",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "2d70ff36-4fc7-495b-a4ac-41d59baae232",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "f12d6163-339d-4ad3-8cb2-b205a6232e40",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "cc642ab2-5486-4aae-a85b-3ee82f4d541c",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 22,
                ],
            ],
        ],
    ],
    LocationId::TEAM_ROCKET_HIDEOUT_B2F => [
        [
            'id' => "ce4b768f-b308-4f94-9596-43fe62ba4e9e",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 17,
                ],
            ],
        ],
    ],
    LocationId::TEAM_ROCKET_HIDEOUT_B3F => [
        [
            'id' => "29b7e64d-321a-44e7-8380-255d330e9542",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "3d2499f7-e900-4913-a7bc-4ffbad658e4d",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 20,
                ],
            ],
        ],
    ],
    LocationId::TEAM_ROCKET_HIDEOUT_B4F => [
        [
            'id' => "77696e1e-dd1a-4be4-ac41-98f281cc977a",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "c8ee3714-f86f-4e16-a2f0-0d5a585538d3",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "4b7c8ef5-27c6-4ae1-b2b7-bb71817adca9",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::ARBOK,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "3d0d7e0b-53b1-47c6-ae27-01cdd4273034",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ONIX,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::RHYHORN,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::KANGASKHAN,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_12 => [
        [
            'id' => "62db9ca6-98ca-49ad-8a0b-58ff088610bd",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Ned",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "b8c929a3-c785-43e5-acc3-ef40bfa1cc04",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Chip",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "a6577aec-e86d-43eb-aa25-982f53034eef",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Hank",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "265df209-20a8-4fe8-b660-530d3f3e43d6",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Elliot",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "0a254440-ffaa-4342-a132-f4079559a9f0",
            'class' => TrainerClass::YOUNG_COUPLE,
            'name' => "Gia & Jes",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "57062fae-b94b-48ff-8ea5-29adbe5ef5e8",
            'class' => TrainerClass::ROCKER,
            'name' => "Luca",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::ELECTRODE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "afd0fcf8-b41c-482d-92ba-4a303c46e19e",
            'class' => TrainerClass::CAMPER,
            'name' => "Justin",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "1e601821-1a31-4596-8499-a4a6d4f4409d",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Andrew",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'level' => 24,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_13 => [
        [
            'id' => "644a8103-a89d-4171-a341-4e6d49dc839f",
            'class' => TrainerClass::PICNICKER,
            'name' => "Alma",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "2f773abc-6e1c-4e49-a61d-5620afee3360",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Sebastian",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "da037b33-b3a9-4b60-949e-f403bf9464cd",
            'class' => TrainerClass::PICNICKER,
            'name' => "Susie",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "b803b9cd-e691-412d-a5fa-f94b01e67362",
            'class' => TrainerClass::BEAUTY,
            'name' => "Lola",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "598d167a-bfa2-43a8-912c-5393823cef07",
            'class' => TrainerClass::BEAUTY,
            'name' => "Sheila",
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "b49982e5-d3a7-4974-bc14-3d4dea8fd623",
            'class' => TrainerClass::PICNICKER,
            'name' => "Valerie",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "6d2c6663-79db-4c47-8715-4575947e680e",
            'class' => TrainerClass::PICNICKER,
            'name' => "Gwen",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "df1b07b9-faae-4376-90fd-b1df1b8195b1",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Robert",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "094dbf59-c075-4509-808a-66475ca90347",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Perry",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "f2303515-205b-49e0-a632-b12126f65ba3",
            'class' => TrainerClass::BIKER,
            'name' => "Jared",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 28,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_14 => [
        [
            'id' => "5efe4490-5277-410a-b1dc-27fb4889f80b",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Carter",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::DODUO,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "e252a453-4afc-4dd1-9bb6-5ba12e5fd4e8",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Mitch",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "0207c020-1cb8-4d78-816f-f295152aa622",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Marlon",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::DODUO,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "fd6a855f-ea6e-4b05-b3ad-c0d81be312bb",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Beck",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "6587080d-962d-4cc7-adf9-925fccde55bb",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Donald",
            'team' => [
                [
                    'id' => PokedexNo::FARFETCHD,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "ea350949-766b-44b6-ba5b-9bbb62d82e6e",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Benny",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "69aa3d07-4afa-4cbf-a9d1-4ceb4ede8c02",
            'class' => TrainerClass::TWINS,
            'name' => "Kiri & Jan",
            'team' => [
                [
                    'id' => PokedexNo::CHARMANDER,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::SQUIRTLE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "0a48176e-7bb1-4fd6-bdb4-8568b26d890a",
            'class' => TrainerClass::BIKER,
            'name' => "Gerald",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "cb855fd5-f98b-4888-9782-14084f58c23b",
            'class' => TrainerClass::BIKER,
            'name' => "Malik",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "9fdfd942-9323-4f90-bb59-f6159ecaa1fa",
            'class' => TrainerClass::BIKER,
            'name' => "Isaac",
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "99d73863-24f2-4377-96c4-d8eddbb108ac",
            'class' => TrainerClass::BIKER,
            'name' => "Lukas",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 26,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_15 => [
        [
            'id' => "e2a6da66-56dd-4da9-bb27-c20e4d104126",
            'class' => TrainerClass::PICNICKER,
            'name' => "Becky",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::RAICHU,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "34a21813-61e9-4348-a9a5-0654fb4ecc58",
            'class' => TrainerClass::CRUSH_KIN,
            'name' => "Ron & Mya",
            'team' => [
                [
                    'id' => PokedexNo::HITMONCHAN,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::HITMONLEE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "debd32dd-ce71-4990-9e05-72cc00e02559",
            'class' => TrainerClass::PICNICKER,
            'name' => "Celia",
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "44a14a2c-6bc5-47e4-8e30-9f1bfce0d823",
            'class' => TrainerClass::BIKER,
            'name' => "Ernest",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "c36f0860-3f06-4553-ab73-3fcd1fbdcea8",
            'class' => TrainerClass::BIKER,
            'name' => "Alex",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "69965eb3-e464-4b7a-a6d4-3343be724e5f",
            'class' => TrainerClass::BEAUTY,
            'name' => "Grace",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::WIGGLYTUFF,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "e4d2f09e-64c8-432b-976f-fef3d180fdd2",
            'class' => TrainerClass::BEAUTY,
            'name' => "Olivia",
            'team' => [
                [
                    'id' => PokedexNo::BULBASAUR,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::IVYSAUR,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "79efa160-1057-44b8-9813-5c8fcae46092",
            'class' => TrainerClass::PICNICKER,
            'name' => "Kindra",
            'team' => [
                [
                    'id' => PokedexNo::GLOOM,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "1733788a-c22c-4b43-9dcb-c525536c1fb5",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Chester",
            'team' => [
                [
                    'id' => PokedexNo::DODRIO,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::DODUO,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::DODUO,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "98f03dd4-0841-4852-8a08-ea84743c43c5",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Edwin",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::FARFETCHD,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::DODUO,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "5bb60ed1-ffba-4303-927f-b98fa1785c71",
            'class' => TrainerClass::PICNICKER,
            'name' => "Yazmin",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::TANGELA,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_16 => [
        [
            'id' => "19e299d5-a59a-4c12-8a1f-4a04482f1400",
            'class' => TrainerClass::YOUNG_COUPLE,
            'name' => "Lea & Jed",
            'team' => [
                [
                    'id' => PokedexNo::RAPIDASH,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::NINETALES,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "67634f35-8fb4-4a86-b5e1-026a5af5d96d",
            'class' => TrainerClass::BIKER,
            'name' => "Lao",
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "3c1af688-e7bb-4036-8130-bb5f11cbfc76",
            'class' => TrainerClass::CUE_BALL,
            'name' => "Koji",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::MANKEY,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "91b88b47-413d-4eab-b892-2d7ef55f056b",
            'class' => TrainerClass::CUE_BALL,
            'name' => "Luke",
            'team' => [
                [
                    'id' => PokedexNo::MANKEY,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "22f3145e-5e53-41e6-9bdf-f821b6cb0dd1",
            'class' => TrainerClass::BIKER,
            'name' => "Hideo",
            'team' => [
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "b7649d21-3893-4742-8201-935de52480ed",
            'class' => TrainerClass::BIKER,
            'name' => "Ruben",
            'team' => [
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "a28273b7-3992-41da-ad11-3b61c79ffd30",
            'class' => TrainerClass::CUE_BALL,
            'name' => "Camron",
            'team' => [
                [
                    'id' => PokedexNo::MANKEY,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_17 => [
        [
            'id' => "50cbf84c-f7f5-4402-8f2f-70fe7653dd74",
            'class' => TrainerClass::CUE_BALL,
            'name' => "Isaiah",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MACHAMP,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "c39970b9-980d-4909-98db-a021ac65e230",
            'class' => TrainerClass::BIKER,
            'name' => "Virgil",
            'team' => [
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "2fe7f96a-d5cd-4db0-a1cc-7382499f6669",
            'class' => TrainerClass::CUE_BALL,
            'name' => "Raul",
            'team' => [
                [
                    'id' => PokedexNo::MANKEY,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::PRIMEAPE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "40e9014d-0490-48a2-b509-77b2aefed22a",
            'class' => TrainerClass::BIKER,
            'name' => "Billy",
            'team' => [
                [
                    'id' => PokedexNo::MUK,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "567b96a2-faa0-4607-ba43-3444e4bb2484",
            'class' => TrainerClass::CUE_BALL,
            'name' => "Jamal",
            'team' => [
                [
                    'id' => PokedexNo::MANKEY,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::MANKEY,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::MACHAMP,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "15efc94a-42e7-4c76-a9bd-6fd631a79aaa",
            'class' => TrainerClass::BIKER,
            'name' => "Nikolas",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "9d99c801-e613-4ab3-98c4-c4a1fd71dc29",
            'class' => TrainerClass::CUE_BALL,
            'name' => "Zeek",
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "f4d0f0af-d91a-4557-9070-7d710c7f414b",
            'class' => TrainerClass::CUE_BALL,
            'name' => "Corey",
            'team' => [
                [
                    'id' => PokedexNo::PRIMEAPE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "1206cf64-f7c0-4fd5-b889-9e7162eb81e3",
            'class' => TrainerClass::BIKER,
            'name' => "Jaxon",
            'team' => [
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "14d43d2a-1124-4f03-b9af-35ea9d8d2d77",
            'class' => TrainerClass::BIKER,
            'name' => "William",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 25,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_18 => [
        [
            'id' => "b3e4cac1-8650-4fff-a25d-6a99c5113d8f",
            'class' => TrainerClass::BIRD_KEEPER,
            'gender' => Gender::MALE,
            'name' => "Jacob",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "a82f7099-f622-4bd2-8c55-7c58f35faf97",
            'class' => TrainerClass::BIRD_KEEPER,
            'gender' => Gender::MALE,
            'name' => "Wilton",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "3b431917-9216-4b76-9991-4c7ec148a1b8",
            'class' => TrainerClass::BIRD_KEEPER,
            'gender' => Gender::MALE,
            'name' => "Ramiro",
            'team' => [
                [
                    'id' => PokedexNo::DODRIO,
                    'level' => 34,
                ],
            ],
        ],
    ],
];
