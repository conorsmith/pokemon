<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

return [
    LocationId::PALLET_TOWN => [
        [
            'id' => "5f56e328-457b-4327-8100-1a452d9dc013",
            'class' => TrainerClass::RETIRED_TRAINER,
            'name' => "Blue",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/1/10/Spr_FRLG_Blue_3.png",
            'prerequisite' => [
                'victory' => RegionId::KANTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::HERACROSS,
                    'sex' => Sex::MALE,
                    'level' => 72,
                ],
                [
                    'id' => PokedexNo::ALAKAZAM,
                    'sex' => Sex::MALE,
                    'level' => 73,
                ],
                [
                    'id' => PokedexNo::TYRANITAR,
                    'sex' => Sex::MALE,
                    'level' => 72,
                ],
                [
                    'id' => PokedexNo::EXEGGUTOR,
                    'sex' => Sex::MALE,
                    'level' => 75,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 75,
                ],
                [
                    'id' => PokedexNo::ARCANINE,
                    'sex' => Sex::MALE,
                    'level' => 75,
                ],
            ],
        ],
    ],
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
            'id' => "98327e6e-dac8-454d-b2a4-10198b642f33",
            'class' => TrainerClass::LASS,
            'name' => "Kay",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::WEEPINBELL,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "0f90d440-5a8b-4881-977a-e7ddb2842b38",
            'class' => TrainerClass::BEAUTY,
            'name' => "Bridget",
            'team' => [
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "38c0776f-c2ec-49b4-b373-258786435f9a",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Mary",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::WEEPINBELL,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::IVYSAUR,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "ea6bbdf6-4e3f-49f7-8452-1411324603e5",
            'class' => TrainerClass::LASS,
            'name' => "Lisa",
            'team' => [
                [
                    'id' => PokedexNo::ODDISH,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "3cc0eedb-8dbd-4d13-bb5a-86103807af1c",
            'class' => TrainerClass::PICNICKER,
            'name' => "Tina",
            'team' => [
                [
                    'id' => PokedexNo::BULBASAUR,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::IVYSAUR,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "1803b06d-f3d5-484e-918c-8013ec1ee188",
            'class' => TrainerClass::BEAUTY,
            'name' => "Lori",
            'team' => [
                [
                    'id' => PokedexNo::EXEGGCUTE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "a837541a-ee51-494a-9ea7-982ef3c18f10",
            'class' => TrainerClass::BEAUTY,
            'name' => "Tamia",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 24,
                ],
            ],
        ],
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
            'class' => TrainerClass::BOSS,
            'gender' => Gender::MALE,
            'name' => "Giovanni",
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
                    'id' => PokedexNo::FARFETCH_D,
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
                    'id' => PokedexNo::FARFETCH_D,
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
    LocationId::FUCHSIA_GYM => [
        [
            'id' => "c8c9493a-29bb-402a-a406-d90613d4ac8a",
            'class' => TrainerClass::JUGGLER,
            'name' => "Nate",
            'team' => [
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "239f607f-673a-4c65-8617-75ffe5e0774c",
            'class' => TrainerClass::JUGGLER,
            'name' => "Kayden",
            'team' => [
                [
                    'id' => PokedexNo::HYPNO,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "512b1193-3733-4c6d-a0e9-bf7afbc69f5b",
            'class' => TrainerClass::JUGGLER,
            'name' => "Kirk",
            'team' => [
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "68d67bf0-51f5-4ec6-b5e8-99f3abafc9cd",
            'class' => TrainerClass::TAMER,
            'name' => "Edgar",
            'team' => [
                [
                    'id' => PokedexNo::ARBOK,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::ARBOK,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "03654bde-9946-4a58-b358-03301c08ad7d",
            'class' => TrainerClass::TAMER,
            'name' => "Phil",
            'team' => [
                [
                    'id' => PokedexNo::SANDSLASH,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::ARBOK,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "cfd8c3c1-bb6e-4762-b21c-a1676a6241aa",
            'class' => TrainerClass::JUGGLER,
            'name' => "Shawn",
            'team' => [
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::HYPNO,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "b1a493a2-661c-48fc-a5af-6e05ca81b03b",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Koga",
            'leader' => [
                'badge' => GymBadge::SOUL,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/0/02/Spr_FRLG_Koga.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 43,
                ],
            ],
        ],
    ],
    LocationId::SAFFRON_GYM => [
        [
            'id' => "3bc0b9ee-97d9-4679-bfd7-e1ad18b403d5",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Cameron",
            'team' => [
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::SLOWBRO,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "0fa86c89-8218-481e-9cfe-c6a6731eb33c",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Tyron",
            'team' => [
                [
                    'id' => PokedexNo::MR_MIME,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "0e4256a5-adf3-40a7-aff4-51b85346fa31",
            'class' => TrainerClass::CHANNELER,
            'name' => "Stacy",
            'team' => [
                [
                    'id' => PokedexNo::HAUNTER,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "aa8de66b-ec2d-401c-9095-2a3cdb792787",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Preston",
            'team' => [
                [
                    'id' => PokedexNo::SLOWBRO,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "aa8de66b-ec2d-401c-9095-2a3cdb792787",
            'class' => TrainerClass::CHANNELER,
            'name' => "Amanda",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::HAUNTER,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "2c06f85d-141e-4c61-a203-f6444d8acd3e",
            'class' => TrainerClass::CHANNELER,
            'name' => "Tasha",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::GASTLY,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::HAUNTER,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "c60d399b-5d79-4018-8338-cab9a9a6d33a",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Johan",
            'team' => [
                [
                    'id' => PokedexNo::KADABRA,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::MR_MIME,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "e8590afb-d891-4e99-8349-bd2d275fb460",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Sabrina",
            'leader' => [
                'badge' => GymBadge::MARSH,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/d/dd/Spr_FRLG_Sabrina.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::KADABRA,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::MR_MIME,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::VENOMOTH,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::ALAKAZAM,
                    'level' => 43,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_2F => [
        [
            'id' => "0c2300d5-94b5-4ff6-ab2c-4b2d8f32712e",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::GOLBAT,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "17831078-8ac6-4329-ac04-0c1d67e4cd45",
            'class' => TrainerClass::SCIENTIST,
            'gender' => Gender::MALE,
            'name' => "Jerry",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::MAGNETON,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "f84bb93e-58ce-4678-bd5e-c1adf12b8367",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CUBONE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "79299e82-e868-4003-99aa-7391c2d571f1",
            'class' => TrainerClass::SCIENTIST,
            'gender' => Gender::MALE,
            'name' => "Connor",
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 26,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_3F => [
        [
            'id' => "4903ab43-2fb0-4b73-980d-387339c1c63a",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::HYPNO,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "c989bcc8-3855-42bf-9ad2-a1eb3e1989d4",
            'class' => TrainerClass::SCIENTIST,
            'gender' => Gender::MALE,
            'name' => "Jose",
            'team' => [
                [
                    'id' => PokedexNo::ELECTRODE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_4F => [
        [
            'id' => "ff40a457-89e2-46c2-924c-e85ba3a73d1b",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::CUBONE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "17654057-7875-4046-b58d-c987116e5de4",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "350a5e42-77bc-4fc0-9547-ec56bbca7eaf",
            'class' => TrainerClass::SCIENTIST,
            'gender' => Gender::MALE,
            'name' => "Rodney",
            'team' => [
                [
                    'id' => PokedexNo::ELECTRODE,
                    'level' => 33,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_5F => [
        [
            'id' => "b37dce41-8057-4634-bae6-15d5612ddfb0",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::HYPNO,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "ab05539d-d853-4b35-b4cb-a6ab056b951d",
            'class' => TrainerClass::JUGGLER,
            'name' => "Dalton",
            'team' => [
                [
                    'id' => PokedexNo::KADABRA,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MR_MIME,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "522a57c5-944e-4104-9a6a-fe48f6213243",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Beau",
            'team' => [
                [
                    'id' => PokedexNo::MAGNETON,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "8f08b268-6f8a-4314-8b92-ac23ebbd8d66",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ARBOK,
                    'level' => 33,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_6F => [
        [
            'id' => "6fb3f9ee-5cb9-4a0f-beb4-311468d2ab6a",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "806ac8fb-fe29-458a-88d8-4ecea81dda27",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "97bed691-3d71-473d-a562-06ade14737bb",
            'class' => TrainerClass::SCIENTIST,
            'gender' => Gender::MALE,
            'name' => "Taylor",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::MAGNETON,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 25,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_7F => [
        [
            'id' => "334f9127-5c02-44ef-bd5d-de4e0545320b",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CUBONE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::CUBONE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "21c0a8e1-d7b0-42b2-ac29-23eed5626d1b",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "73ba381e-d0e6-4fd5-a9ae-3a30133b6ff2",
            'class' => TrainerClass::SCIENTIST,
            'gender' => Gender::MALE,
            'name' => "Joshua",
            'team' => [
                [
                    'id' => PokedexNo::ELECTRODE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "2bcd62f7-ea6a-472a-8c5c-fc7b025c2421",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_8F => [
        [
            'id' => "81c064ce-be78-4f7e-a224-d0a35f1d6971",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::ARBOK,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "1e126fad-38fe-4b41-8a24-6953c20dd691",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "64b5bbee-4792-4d75-9eb4-a48f84836df9",
            'class' => TrainerClass::SCIENTIST,
            'gender' => Gender::MALE,
            'name' => "Parker",
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::ELECTRODE,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_9F => [
        [
            'id' => "9ec85c0b-8fba-4ae1-9190-790cd1c731c5",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::GOLBAT,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::HYPNO,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "57a0b83a-0531-4dc4-919d-9000b294eda6",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "20f38d13-c1d3-4bd9-8bc6-249cf7a6fc63",
            'class' => TrainerClass::SCIENTIST,
            'gender' => Gender::MALE,
            'name' => "Ed",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::MAGNETON,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 28,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_10F => [
        [
            'id' => "2cbb5c78-e570-4650-8412-94b46386b310",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "fb7aee18-bfcb-4eb7-93fc-d996b9634f6e",
            'class' => TrainerClass::SCIENTIST,
            'gender' => Gender::MALE,
            'name' => "Travis",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::SILPH_CO_11F => [
        [
            'id' => "ab2fe5a7-5560-44b5-a8ef-939bcc5899eb",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "6e383181-765f-4ac2-b857-f2654977cd8c",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CUBONE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::MAROWAK,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "614f8452-7e95-4783-a327-2c991720b6ef",
            'class' => TrainerClass::BOSS,
            'gender' => Gender::MALE,
            'name' => "Giovanni",
            'team' => [
                [
                    'id' => PokedexNo::NIDORINO,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::RHYHORN,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::KANGASKHAN,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::NIDOQUEEN,
                    'level' => 41,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_19 => [
        [
            'id' => "9d62d378-464c-4d61-b313-41be51f604eb",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Richard",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "8c838bf4-897f-40e4-a0e3-50bb7a5a721e",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Reece",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "a2cc0374-4658-4d50-a611-5cbc0daba637",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Tony",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "2db843d8-ec25-4a18-81b8-a597991a3e8e",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "David",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "7c466f17-bf71-4b6c-8588-9205429e8538",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Douglas",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "b1d69498-074e-4ff5-8e5a-7b8b6b7671e1",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Matthew",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "aa6c8b3a-e058-49bc-82d3-13f6ded74655",
            'class' => TrainerClass::SIS_AND_BRO,
            'name' => "Lia & Luc",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "75542e6f-3795-4404-85f4-51ea4acd4e09",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Axle",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "3219384f-6993-4f37-a5ea-66e51d146d8f",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Alice",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "45520105-1a64-4e5c-9304-b99acd12756c",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Anya",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "13bf75c7-5323-4a22-bc50-c2a6c80d4b4c",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Connie",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_20 => [
        [
            'id' => "920ae1c2-7d9a-4ed5-ab70-09c53b1520ac",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Barry",
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::CLOYSTER,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "c103a127-6272-45d9-8d7d-c58ca7457870",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Darrin",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::SEADRA,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "9f0b0633-0559-4e91-92ff-647694c7ee2c",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Shirley",
            'team' => [
                [
                    'id' => PokedexNo::SEADRA,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SEADRA,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "d414afc9-6255-446e-9c4b-bac4831078cb",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Tiffany",
            'team' => [
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "617b0af9-09dc-44ad-beb5-87ecbfed22f7",
            'class' => TrainerClass::PICNICKER,
            'name' => "Irene",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SEEL,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "06484cd7-fe17-4c08-bd69-3d0c89407ece",
            'class' => TrainerClass::BIRD_KEEPER,
            'gender' => Gender::MALE,
            'name' => "Roger",
            'team' => [
                [
                    'id' => PokedexNo::FEAROW,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "440a22bc-3606-437b-88df-339ef6e428f9",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Nora",
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::CLOYSTER,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "ece685ec-5e84-4a25-8150-a1e36c1cda1d",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Dean",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "0735e54d-01ab-4ff6-a676-f0ba858bcd1e",
            'class' => TrainerClass::PICNICKER,
            'name' => "Missy",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "8d5fa9b1-5f14-4997-8fbb-79ba83ac7949",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Melissa",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 31,
                ],
            ],
        ],
    ],
    LocationId::CINNABAR_GYM => [
        [
            'id' => "64471f8c-2c5a-4690-84b9-646fac88de76",
            'class' => TrainerClass::BURGLAR,
            'name' => "Quinn",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::VULPIX,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::NINETALES,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "9fd37018-bd47-4cab-bef7-9f3555ae5f9d",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Erik",
            'team' => [
                [
                    'id' => PokedexNo::VULPIX,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::VULPIX,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::NINETALES,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "abfe1b8f-5243-45f2-817d-9d96f1feea76",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Avery",
            'team' => [
                [
                    'id' => PokedexNo::PONYTA,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::CHARMANDER,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::VULPIX,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "98292bac-9879-4d5a-9a0d-5790efcd0e70",
            'class' => TrainerClass::BURGLAR,
            'name' => "Ramon",
            'team' => [
                [
                    'id' => PokedexNo::PONYTA,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "bb66dc68-841e-4bf6-a8b7-af38ecec357c",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Derek",
            'team' => [
                [
                    'id' => PokedexNo::RAPIDASH,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "0f68d295-62ff-4ff2-9319-1dc6608283da",
            'class' => TrainerClass::BURGLAR,
            'name' => "Dusty",
            'team' => [
                [
                    'id' => PokedexNo::VULPIX,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "8c15e910-2166-49c6-8186-38b0a7e06f2b",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Zac",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::VULPIX,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "f7f662ad-215b-404a-998e-7bdd1febe1f1",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Blaine",
            'leader' => [
                'badge' => GymBadge::VOLCANO,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/6/6d/Spr_FRLG_Blaine.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::PONYTA,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::RAPIDASH,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::ARCANINE,
                    'level' => 47,
                ],
            ],
        ],
    ],
    LocationId::POKEMON_MANSION => [
        [
            'id' => "ef02e024-b618-40a4-baea-986e6034de78",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Johnson",
            'team' => [
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "bddea5c6-9f2b-4295-838d-5872c9726616",
            'class' => TrainerClass::BURGLAR,
            'name' => "Arnie",
            'team' => [
                [
                    'id' => PokedexNo::CHARMANDER,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::CHARMELEON,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "f3f0870e-0388-4b97-8a1f-613372091d45",
            'class' => TrainerClass::BURGLAR,
            'name' => "Simon",
            'team' => [
                [
                    'id' => PokedexNo::NINETALES,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "3efa379c-e46f-432f-8833-710e506ea74f",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Braydon",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::MAGNETON,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "61842242-dfe6-46d8-b13b-7d78a3b7ab44",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Ted",
            'team' => [
                [
                    'id' => PokedexNo::ELECTRODE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "d6ffd92d-f396-4a50-b636-fc9a26d97309",
            'class' => TrainerClass::BURGLAR,
            'name' => "Lewis",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::PONYTA,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "7944ec05-71a6-4e85-a228-6d95bc422c75",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Ivan",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::ELECTRODE,
                    'level' => 34,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_21 => [
        [
            'id' => "9c245f4a-08f1-4d94-82af-21cde3c06173",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Wade",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "7060879f-594b-4090-bf03-161ddc1e6f33",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Ronald",
            'team' => [
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "8878fb24-b3ff-4a20-b56e-020f9d2564e3",
            'class' => TrainerClass::SIS_AND_BRO,
            'name' => "Lil & Ian",
            'team' => [
                [
                    'id' => PokedexNo::SEADRA,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::STARMIE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "e4f2873c-698f-407b-b3a6-bfad2efb2eb7",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Spencer",
            'team' => [
                [
                    'id' => PokedexNo::SEADRA,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "d990d1cb-9396-40b6-9ee3-a33946f02aba",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Claude",
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::CLOYSTER,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "30345d0d-fd49-4b96-807b-64c39940e22a",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Nolan",
            'team' => [
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "5fbfebad-43f7-473a-9c32-c47d12b566ad",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Jack",
            'team' => [
                [
                    'id' => PokedexNo::STARMIE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "5e23a5fc-f25a-4f8c-9a3e-9f1501651362",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Roland",
            'team' => [
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::SEADRA,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "e0751b70-5c72-4aa7-ac0a-9e380c81faed",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Jerome",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::WARTORTLE,
                    'level' => 33,
                ],
            ],
        ],
    ],
    LocationId::VICTORY_ROAD_1F => [
        [
            'id' => "c8b4d889-ccff-4089-8bdc-b808bb3ad450",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Naomi",
            'team' => [
                [
                    'id' => PokedexNo::PERSIAN,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::PONYTA,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::RAPIDASH,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::VULPIX,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::NINETALES,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "b831968a-457f-4f4d-9ca1-7c83f9882787",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Rolando",
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::IVYSAUR,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::WARTORTLE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::CHARMELEON,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::CHARIZARD,
                    'level' => 42,
                ],
            ],
        ],
    ],
    LocationId::VICTORY_ROAD_2F => [
        [
            'id' => "849d6dd5-b288-4566-a5a4-530dc4a574d1",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Daisuke",
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "6635986d-ba2b-4775-b51c-ececbdfe677e",
            'class' => TrainerClass::JUGGLER,
            'name' => "Nelson",
            'team' => [
                [
                    'id' => PokedexNo::DROWZEE,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::HYPNO,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "39339ecd-6336-492b-ac1e-0fbd9d14eec8",
            'class' => TrainerClass::TAMER,
            'name' => "Vincent",
            'team' => [
                [
                    'id' => PokedexNo::PERSIAN,
                    'level' => 44,
                ],
                [
                    'id' => PokedexNo::GOLDUCK,
                    'level' => 44,
                ],
            ],
        ],
        [
            'id' => "aca38bc4-254f-45bf-b189-064267ef6161",
            'class' => TrainerClass::JUGGLER,
            'name' => "Gregory",
            'team' => [
                [
                    'id' => PokedexNo::MR_MIME,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "e9539c63-d26c-496a-9286-e1e5f9f966cd",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Dawson",
            'team' => [
                [
                    'id' => PokedexNo::CHARMELEON,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::LAPRAS,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::LICKITUNG,
                    'level' => 40,
                ],
            ],
        ],
    ],
    LocationId::VICTORY_ROAD_3F => [
        [
            'id' => "bc42d013-8344-4521-90a8-4c64968428d0",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "George",
            'team' => [
                [
                    'id' => PokedexNo::EXEGGUTOR,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::CLOYSTER,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::ELECTRODE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::ARCANINE,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "738c6012-ba89-4243-a47c-f7246c6beac5",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Alexa",
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::JIGGLYPUFF,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::PERSIAN,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::DEWGONG,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::CHANSEY,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "6ad11037-cf81-4945-863b-9cadefd6c2bf",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Colby",
            'team' => [
                [
                    'id' => PokedexNo::KINGLER,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::SEADRA,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::BLASTOISE,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "64706041-1546-4e36-83ec-36a839199124",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Caroline",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::WEEPINBELL,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::VICTREEBEL,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::PARAS,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::PARASECT,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "87723889-c878-4aec-8ae4-5e360cf483a5",
            'class' => TrainerClass::COOL_COUPLE,
            'name' => "Ray & Tyra",
            'team' => [
                [
                    'id' => PokedexNo::NIDOKING,
                    'level' => 45,
                ],
                [
                    'id' => PokedexNo::NIDOQUEEN,
                    'level' => 45,
                ],
            ],
        ],
    ],
    LocationId::KANTO_LEAGUE_CHAMBER => [
        [
            'id' => "3be7e165-f553-41c7-87ee-37389aaeea82",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Lorelei",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/d/db/Spr_FRLG_Lorelei.png",
            'prerequisite' => [
                'champion' => RegionId::KANTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::DEWGONG,
                    'sex' => Sex::MALE,
                    'level' => 64,
                ],
                [
                    'id' => PokedexNo::CLOYSTER,
                    'sex' => Sex::MALE,
                    'level' => 63,
                ],
                [
                    'id' => PokedexNo::PILOSWINE,
                    'sex' => Sex::MALE,
                    'level' => 63,
                ],
                [
                    'id' => PokedexNo::JYNX,
                    'sex' => Sex::FEMALE,
                    'level' => 66,
                ],
                [
                    'id' => PokedexNo::LAPRAS,
                    'sex' => Sex::MALE,
                    'level' => 66,
                ],
            ],
        ],
        [
            'id' => "b09db16b-eba5-4821-abe1-b287646f7ed3",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Bruno",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/f/f7/Spr_FRLG_Bruno.png",
            'prerequisite' => [
                'champion' => RegionId::KANTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::STEELIX,
                    'sex' => Sex::MALE,
                    'level' => 65,
                ],
                [
                    'id' => PokedexNo::HITMONCHAN,
                    'sex' => Sex::MALE,
                    'level' => 65,
                ],
                [
                    'id' => PokedexNo::HITMONLEE,
                    'sex' => Sex::MALE,
                    'level' => 65,
                ],
                [
                    'id' => PokedexNo::STEELIX,
                    'sex' => Sex::MALE,
                    'level' => 66,
                ],
                [
                    'id' => PokedexNo::MACHAMP,
                    'sex' => Sex::MALE,
                    'level' => 68,
                ],
            ],
        ],
        [
            'id' => "bdefb7de-7234-4f42-bd0f-8d7254ae7f08",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Agatha",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/5/56/Spr_FRLG_Agatha.png",
            'prerequisite' => [
                'champion' => RegionId::KANTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::GENGAR,
                    'sex' => Sex::MALE,
                    'level' => 66,
                ],
                [
                    'id' => PokedexNo::CROBAT,
                    'sex' => Sex::MALE,
                    'level' => 66,
                ],
                [
                    'id' => PokedexNo::MISDREAVUS,
                    'sex' => Sex::MALE,
                    'level' => 65,
                ],
                [
                    'id' => PokedexNo::ARBOK,
                    'sex' => Sex::MALE,
                    'level' => 68,
                ],
                [
                    'id' => PokedexNo::GENGAR,
                    'sex' => Sex::MALE,
                    'level' => 70,
                ],
            ],
        ],
        [
            'id' => "2e3067a1-dcf6-4e39-8a3f-9fd12af58683",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Lance",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/f/fb/Spr_FRLG_Lance.png",
            'prerequisite' => [
                'champion' => RegionId::KANTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 68,
                ],
                [
                    'id' => PokedexNo::DRAGONITE,
                    'sex' => Sex::MALE,
                    'level' => 66,
                ],
                [
                    'id' => PokedexNo::KINGDRA,
                    'sex' => Sex::MALE,
                    'level' => 66,
                ],
                [
                    'id' => PokedexNo::AERODACTYL,
                    'sex' => Sex::MALE,
                    'level' => 70,
                ],
                [
                    'id' => PokedexNo::DRAGONITE,
                    'sex' => Sex::MALE,
                    'level' => 72,
                ],
            ],
        ],
    ],
    LocationId::JOHTO_LEAGUE_CHAMBER => [
        [
            'id' => "5daee68c-acf7-469b-8f55-5588b23817eb",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Will",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/f/fd/Spr_HGSS_Will.png",
            'prerequisite' => [
                'champion' => RegionId::JOHTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::BRONZONG,
                    'sex' => Sex::MALE,
                    'level' => 58,
                ],
                [
                    'id' => PokedexNo::JYNX,
                    'sex' => Sex::FEMALE,
                    'level' => 60,
                ],
                [
                    'id' => PokedexNo::GRUMPIG,
                    'sex' => Sex::FEMALE,
                    'level' => 59,
                ],
                [
                    'id' => PokedexNo::SLOWBRO,
                    'sex' => Sex::FEMALE,
                    'level' => 60,
                ],
                [
                    'id' => PokedexNo::GARDEVOIR,
                    'sex' => Sex::FEMALE,
                    'level' => 61,
                ],
                [
                    'id' => PokedexNo::XATU,
                    'sex' => Sex::FEMALE,
                    'level' => 62,
                ],
            ],
        ],
        [
            'id' => "2284432e-1259-44c6-8547-db5814fe4a42",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Koga",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/1/18/Spr_HGSS_Koga.png",
            'prerequisite' => [
                'champion' => RegionId::JOHTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::SKUNTANK,
                    'sex' => Sex::MALE,
                    'level' => 61,
                ],
                [
                    'id' => PokedexNo::VENOMOTH,
                    'sex' => Sex::MALE,
                    'level' => 63,
                ],
                [
                    'id' => PokedexNo::TOXICROAK,
                    'sex' => Sex::MALE,
                    'level' => 60,
                ],
                [
                    'id' => PokedexNo::SWALOT,
                    'sex' => Sex::MALE,
                    'level' => 62,
                ],
                [
                    'id' => PokedexNo::CROBAT,
                    'sex' => Sex::MALE,
                    'level' => 64,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'sex' => Sex::MALE,
                    'level' => 62,
                ],
            ],
        ],
        [
            'id' => "47f575f1-5941-481a-afc5-ca30416c0998",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Bruno",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/e/ee/Spr_HGSS_Bruno.png",
            'prerequisite' => [
                'champion' => RegionId::JOHTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::HITMONTOP,
                    'sex' => Sex::MALE,
                    'level' => 62,
                ],
                [
                    'id' => PokedexNo::HITMONLEE,
                    'sex' => Sex::MALE,
                    'level' => 61,
                ],
                [
                    'id' => PokedexNo::HITMONCHAN,
                    'sex' => Sex::MALE,
                    'level' => 61,
                ],
                [
                    'id' => PokedexNo::HARIYAMA,
                    'sex' => Sex::MALE,
                    'level' => 62,
                ],
                [
                    'id' => PokedexNo::MACHAMP,
                    'sex' => Sex::MALE,
                    'level' => 64,
                ],
                [
                    'id' => PokedexNo::LUCARIO,
                    'sex' => Sex::MALE,
                    'level' => 64,
                ],
            ],
        ],
        [
            'id' => "5a2d94f2-4a50-4c24-8e8d-d7ea571fef91",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Karen",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/a/a2/Spr_HGSS_Karen.png",
            'prerequisite' => [
                'champion' => RegionId::JOHTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::WEAVILE,
                    'sex' => Sex::FEMALE,
                    'level' => 62,
                ],
                [
                    'id' => PokedexNo::ABSOL,
                    'sex' => Sex::FEMALE,
                    'level' => 62,
                ],
                [
                    'id' => PokedexNo::SPIRITOMB,
                    'sex' => Sex::FEMALE,
                    'level' => 62,
                ],
                [
                    'id' => PokedexNo::HOUNDOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 63,
                ],
                [
                    'id' => PokedexNo::HONCHKROW,
                    'sex' => Sex::FEMALE,
                    'level' => 64,
                ],
                [
                    'id' => PokedexNo::UMBREON,
                    'sex' => Sex::FEMALE,
                    'level' => 64,
                ],
            ],
        ],
    ],
    LocationId::TREASURE_BEACH => [
        [
            'id' => "9351b079-0ddb-4cf0-9f8f-534101015e51",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Amara",
            'team' => [
                [
                    'id' => PokedexNo::SEEL,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::SEEL,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::DEWGONG,
                    'level' => 36,
                ],
            ],
        ],
    ],
    LocationId::KINDLE_ROAD => [
        [
            'id' => "1b4969cf-7992-4872-9c7f-a05baa747656",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Abigail",
            'team' => [
                [
                    'id' => PokedexNo::PSYDUCK,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::PSYDUCK,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::GOLDUCK,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "bcbe4c52-be28-4594-a569-d1578a7c75a2",
            'class' => TrainerClass::PICNICKER,
            'name' => "Claire",
            'team' => [
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::PIKACHU,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "e540e093-167b-4047-ab91-7d89406dc862",
            'class' => TrainerClass::CRUSH_GIRL,
            'name' => "Tanya",
            'team' => [
                [
                    'id' => PokedexNo::HITMONLEE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::HITMONCHAN,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "41e19f7b-af06-4773-832f-d298c88c61b4",
            'class' => TrainerClass::CAMPER,
            'name' => "Bryce",
            'team' => [
                [
                    'id' => PokedexNo::NIDORINO,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "7c890fa4-da25-4731-b573-0ce99c33489d",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Garrett",
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::CLOYSTER,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::WARTORTLE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "b815865b-4c6a-4ae0-be37-073f11cb337b",
            'class' => TrainerClass::CRUSH_KIN,
            'name' => "Mik & Kia",
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::PRIMEAPE,
                    'level' => 39,
                ],
            ],
        ],
        [
            'id' => "4f419158-d58d-4f2d-841b-4d3e954f1685",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Hugh",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "3a624cb3-6f7a-44da-bd5b-314ac2dad72b",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Shea",
            'team' => [
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
            'id' => "c5106b54-e0cb-43ae-b22d-ef27fd325741",
            'class' => TrainerClass::CRUSH_GIRL,
            'name' => "Sharon",
            'team' => [
                [
                    'id' => PokedexNo::MANKEY,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::PRIMEAPE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "dc7b50e0-81a8-49bf-8506-5689da341f02",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Finn",
            'team' => [
                [
                    'id' => PokedexNo::STARMIE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "d71a62ec-4009-4016-94e4-9303f70d74fc",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Maria",
            'team' => [
                [
                    'id' => PokedexNo::SEADRA,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::SEADRA,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "7eff638e-68f8-45b3-8bf1-85930b1585fc",
            'class' => TrainerClass::FISHERMAN,
            'gender' => Gender::MALE,
            'name' => "Tommy",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'level' => 35,
                ],
            ],
        ],
    ],
    LocationId::MT_EMBER_SUMMIT_PATH_1 => [
        [
            'id' => "f08c75cf-d2a6-497f-90dd-9b2e4f36eab7",
            'class' => TrainerClass::POKEMON_RANGER,
            'gender' => Gender::FEMALE,
            'name' => "Beth",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "3783feb1-bee0-4bc8-9678-ddef1d632874",
            'class' => TrainerClass::CRUSH_GIRL,
            'name' => "Jocelyn",
            'team' => [
                [
                    'id' => PokedexNo::HITMONCHAN,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::HITMONCHAN,
                    'level' => 38,
                ],
            ],
        ],
    ],
    LocationId::MT_EMBER_SUMMIT_PATH_2 => [
        [
            'id' => "7b4a369d-c2bb-49a1-bfdf-ca7feced5699",
            'class' => TrainerClass::POKEMON_RANGER,
            'gender' => Gender::MALE,
            'name' => "Logan",
            'team' => [
                [
                    'id' => PokedexNo::EXEGGCUTE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::EXEGGUTOR,
                    'level' => 40,
                ],
            ],
        ],
    ],
    LocationId::MT_EMBER_BASE => [
        [
            'id' => "1d8b5318-4a13-4a3b-abf7-09f19bec8550",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CUBONE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::MAROWAK,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "0c099949-e40b-44e1-bad8-fc3c8320b75a",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::SANDSHREW,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'level' => 35,
                ],
            ],
        ],
    ],
    LocationId::BOND_BRIDGE => [
        [
            'id' => "af5ae449-195c-4697-a856-6a6966e71775",
            'class' => TrainerClass::TWINS,
            'name' => "Joy & Meg",
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'sex' => Sex::FEMALE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'sex' => Sex::FEMALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "81d62ae1-bee4-42f0-9812-0a21f7df800b",
            'class' => TrainerClass::AROMA_LADY,
            'name' => "Violet",
            'team' => [
                [
                    'id' => PokedexNo::BULBASAUR,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::IVYSAUR,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::IVYSAUR,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "d1e23de3-eca2-4d1b-b784-f35251f0a6b0",
            'class' => TrainerClass::TUBER,
            'name' => "Alexis",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::KRABBY,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::KRABBY,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "24c0074f-ddca-47a2-bae9-3c51fd186cf2",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Tisha",
            'team' => [
                [
                    'id' => PokedexNo::KINGLER,
                    'sex' => Sex::FEMALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "4d95fe0d-7013-4647-9800-2859202e10b5",
            'class' => TrainerClass::TUBER,
            'name' => "Amira",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::POLIWAG,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "fdf48865-2a98-47e3-85d4-9a8f0358d0d6",
            'class' => TrainerClass::AROMA_LADY,
            'name' => "Nikki",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::FEMALE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::WEEPINBELL,
                    'sex' => Sex::FEMALE,
                    'level' => 37,
                ],
            ],
        ],
    ],
    LocationId::ICEFALL_CAVE_BACK_CAVE => [
        [
            'id' => "64a14a2c-aef1-49e6-9d70-5f4acc3b2e5b",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
    ],
    LocationId::CHRONO_ISLE_MEADOW => [
        [
            'id' => "63a26712-79d3-45bc-9f61-156123fdfb0b",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "308babf9-457f-4358-82eb-0e5524d315aa",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::EKANS,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "45ad2fc9-9ca3-48d6-888c-379762e85f17",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
    ],
    LocationId::ROCKET_WAREHOUSE => [
        [
            'id' => "0f70377d-2bac-45b7-95b9-2cf35f6321f2",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::HOUNDOUR,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::HOUNDOUR,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "81348302-c48f-4379-a2a3-e4a0f0236c2d",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "f64f4516-a261-4ff3-a021-e64df25773df",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::HYPNO,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::HYPNO,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "09690ad5-7e90-4144-92f5-e55f12a111f1",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::MUK,
                    'sex' => Sex::MALE,
                    'level' => 52,
                ],
                [
                    'id' => PokedexNo::ARBOK,
                    'sex' => Sex::MALE,
                    'level' => 53,
                ],
                [
                    'id' => PokedexNo::VILEPLUME,
                    'sex' => Sex::MALE,
                    'level' => 54,
                ],
            ],
        ],
        [
            'id' => "3adbd4c9-e00e-4f2a-8fc8-590cf6ef067b",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 53,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'sex' => Sex::MALE,
                    'level' => 54,
                ],
                [
                    'id' => PokedexNo::HOUNDOOM,
                    'sex' => Sex::MALE,
                    'level' => 55,
                ],
            ],
        ],
        [
            'id' => "28618ba3-b55e-4633-a3a0-313cbf5cb04e",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Gideon",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 46,
                ],
                [
                    'id' => PokedexNo::ELECTRODE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 46,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 46,
                ],
            ],
        ],
    ],
    LocationId::MEMORIAL_PILLAR => [
        [
            'id' => "56c19618-efa1-4bf7-b855-e9340a6d4320",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Milo",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "2bc894f8-8599-4ac5-8c5e-bfbd69227b2b",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Chaz",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "604d333e-4dde-4314-9d59-585dfa215911",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Harold",
            'team' => [
                [
                    'id' => PokedexNo::HOOTHOOT,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::NOCTOWL,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
    ],
    LocationId::WATER_LABYRINTH => [
        [
            'id' => "3b821840-ee68-457f-90e4-19102b862eca",
            'class' => TrainerClass::POKEMON_BREEDER,
            'name' => "Alize",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
    ],
    LocationId::RESORT_GORGEOUS => [
        [
            'id' => "af7847e7-6aaa-4f51-b05a-f36eee969fb8",
            'class' => TrainerClass::PAINTER,
            'name' => "Rayna",
            'team' => [
                [
                    'id' => PokedexNo::SMEARGLE,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "4b0d57c7-ff06-47ef-88be-aa12b3936454",
            'class' => TrainerClass::LADY,
            'name' => "Jacki",
            'team' => [
                [
                    'id' => PokedexNo::HOPPIP,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::SKIPLOOM,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "98eb6b45-b78d-4932-b1b4-5b9f096a0a2e",
            'class' => TrainerClass::PAINTER,
            'name' => "Celina",
            'team' => [
                [
                    'id' => PokedexNo::SMEARGLE,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "352efab8-f9cf-40ca-bf5e-4a908ed30ae3",
            'class' => TrainerClass::LADY,
            'name' => "Gillian",
            'team' => [
                [
                    'id' => PokedexNo::MAREEP,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::MAREEP,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::FLAAFFY,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "2c1f035f-ac16-4017-b5bb-dc56baeaee80",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Destin",
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "c8c2c2d1-1898-468e-973d-36f7b9807ac7",
            'class' => TrainerClass::PAINTER,
            'name' => "Daisy",
            'team' => [
                [
                    'id' => PokedexNo::SMEARGLE,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "132613cd-2f77-4514-b6e1-e9e7c04f80a4",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Toby",
            'team' => [
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_1 => [
        [
            'id' => "2d4359a5-ff08-4976-8a5c-8aee4de53cda",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Lawson",
            'team' => [
                [
                    'id' => PokedexNo::ONIX,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::MAROWAK,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_9 => [
        [
            'id' => "4a6bf1c1-1f88-41f9-9013-b24ec469c676",
            'class' => TrainerClass::PSYCHIC,
            'name' => "Laura",
            'team' => [
                [
                    'id' => PokedexNo::NATU,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::NATU,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::XATU,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
            ],
        ],
    ],
    LocationId::LOST_CAVE_B1F_14 => [
        [
            'id' => "a2f5a743-672a-48af-b80e-80f5585d5056",
            'class' => TrainerClass::LADY,
            'name' => "Selphy",
            'team' => [
                [
                    'id' => PokedexNo::PERSIAN,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::PERSIAN,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
    ],
    LocationId::WATER_PATH => [
        [
            'id' => "f75a7bfb-1dfb-4242-a2fa-f77b19ea9e92",
            'class' => TrainerClass::JUGGLER,
            'name' => "Edward",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 46,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 46,
                ],
                [
                    'id' => PokedexNo::ELECTRODE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::MR_MIME,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "c7412f03-4d3f-4496-8b25-8a4856e77bce",
            'class' => TrainerClass::HIKER,
            'name' => "Earl",
            'team' => [
                [
                    'id' => PokedexNo::ONIX,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "c19f2aea-8761-417f-86c2-a5d083ab3cb1",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Denise",
            'team' => [
                [
                    'id' => PokedexNo::CHINCHOU,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::LANTURN,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "7dded6d9-293e-4942-9771-cfcce83e654d",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Samir",
            'team' => [
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "52a4dd74-7fad-4462-b7e4-a574bd553f03",
            'class' => TrainerClass::TWINS,
            'name' => "Miu & Mia",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
                [
                    'id' => PokedexNo::PIKACHU,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "506f4f56-8748-4c65-a4f6-4983ce09f872",
            'class' => TrainerClass::AROMA_LADY,
            'name' => "Rose",
            'team' => [
                [
                    'id' => PokedexNo::SUNKERN,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::SUNFLORA,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
            ],
        ],
    ],
    LocationId::GREEN_PATH => [
        [
            'id' => "c657f047-7a3d-4f32-ad0f-763bd30fea90",
            'class' => TrainerClass::PSYCHIC,
            'name' => "Jaclyn",
            'team' => [
                [
                    'id' => PokedexNo::NATU,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::SLOWBRO,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
    ],
    LocationId::OUTCAST_ISLAND => [
        [
            'id' => "d6d47d9e-e8f6-4d4f-ab3e-ec9bba1b055d",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Nicole",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "c24eb154-599b-4437-bb3a-aee0731e907f",
            'class' => TrainerClass::SIS_AND_BRO,
            'name' => "Ava & Geb",
            'team' => [
                [
                    'id' => PokedexNo::STARMIE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 50,
                ],
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "7859dfc2-9c6c-4459-b654-0ea3af1d4233",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Mymo",
            'team' => [
                [
                    'id' => PokedexNo::KINGLER,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::WARTORTLE,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "e5255222-a007-4d83-bc97-1736f3eeb712",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Tylor",
            'team' => [
                [
                    'id' => PokedexNo::QWILFISH,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::QWILFISH,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "3466ba4b-3d55-4683-a3e6-28d875db0aa8",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MUK,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
    ],
    LocationId::RUIN_VALLEY => [
        [
            'id' => "e3602655-77b4-486e-98cf-be2b77e91cf2",
            'class' => TrainerClass::HIKER,
            'name' => "Daryl",
            'team' => [
                [
                    'id' => PokedexNo::SUDOWOODO,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "9d757ab2-e6d9-49b2-84a0-590c47226159",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Hector",
            'team' => [
                [
                    'id' => PokedexNo::RHYHORN,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::KANGASKHAN,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "795be8de-2818-40b3-8c11-9049128dd895",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Stanly",
            'team' => [
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "a41f49ef-8505-464c-8e80-5c5347ab7f6c",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Foster",
            'team' => [
                [
                    'id' => PokedexNo::GOLEM,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "d8dbe23a-e5d1-43f3-ad0c-9094b7c75c16",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Larry",
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
    ],
    LocationId::PATTERN_BUSH => [
        [
            'id' => "c99ab11f-a6bd-41d1-91cd-42a76c5a430e",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Cordell",
            'team' => [
                [
                    'id' => PokedexNo::FARFETCH_D,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::FARFETCH_D,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "cfd7e13e-c9c8-4691-8fb7-ea2cdcadbeec",
            'class' => TrainerClass::POKEMON_BREEDER,
            'name' => "Bethany",
            'team' => [
                [
                    'id' => PokedexNo::CHANSEY,
                    'sex' => Sex::FEMALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "c2fa9b4e-ce5a-4a30-a248-a94becafa3b2",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Garret",
            'team' => [
                [
                    'id' => PokedexNo::HERACROSS,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "d3f771ca-836d-4f9f-8241-3134883c178a",
            'class' => TrainerClass::LASS,
            'name' => "Joana",
            'team' => [
                [
                    'id' => PokedexNo::SNUBBULL,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "00191eab-0839-4424-9fbe-13e58814cf23",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Nash",
            'team' => [
                [
                    'id' => PokedexNo::WEEPINBELL,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::WEEPINBELL,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::VICTREEBEL,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "70f034e1-a736-4304-bce3-c86b6ddcd23e",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Vance",
            'team' => [
                [
                    'id' => PokedexNo::VENONAT,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::VENOMOTH,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "6401cea8-5c2f-4510-bac0-95598d43cab4",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Layton",
            'team' => [
                [
                    'id' => PokedexNo::SANDSLASH,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "0099dc38-94c7-4dd6-96b6-9c9087ce4c02",
            'class' => TrainerClass::PICNICKER,
            'name' => "Marcy",
            'team' => [
                [
                    'id' => PokedexNo::PARAS,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::PARAS,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::PARASECT,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "42bcfa4b-6461-4210-9c8e-97ca0b721c15",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Jonah",
            'team' => [
                [
                    'id' => PokedexNo::YANMA,
                    'sex' => Sex::MALE,
                    'level' => 45,
                ],
                [
                    'id' => PokedexNo::BEEDRILL,
                    'sex' => Sex::MALE,
                    'level' => 45,
                ],
                [
                    'id' => PokedexNo::YANMA,
                    'sex' => Sex::MALE,
                    'level' => 46,
                ],
                [
                    'id' => PokedexNo::BEEDRILL,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
            ],
        ],
        [
            'id' => "142f2aac-31e1-4a8d-91ec-bca50a085c67",
            'class' => TrainerClass::LASS,
            'name' => "Dalia",
            'team' => [
                [
                    'id' => PokedexNo::HOPPIP,
                    'sex' => Sex::FEMALE,
                    'level' => 46,
                ],
                [
                    'id' => PokedexNo::HOPPIP,
                    'sex' => Sex::FEMALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::SKIPLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::SKIPLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "5f292925-92c2-4bcf-896f-dc5da8167dc1",
            'class' => TrainerClass::POKEMON_BREEDER,
            'name' => "Allison",
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::CLEFABLE,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "4492435c-0549-4038-9d0e-628b28ced514",
            'class' => TrainerClass::CAMPER,
            'name' => "Riley",
            'team' => [
                [
                    'id' => PokedexNo::PINSIR,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::HERACROSS,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
    ],
    LocationId::CANYON_ENTRANCE => [
        [
            'id' => "c6d1b9fa-7c72-49b0-ba3e-8a6d69fb94c8",
            'class' => TrainerClass::AROMA_LADY,
            'name' => "Miah",
            'team' => [
                [
                    'id' => PokedexNo::BELLOSSOM,
                    'sex' => Sex::FEMALE,
                    'level' => 50,
                ],
                [
                    'id' => PokedexNo::BELLOSSOM,
                    'sex' => Sex::FEMALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "0533f07d-48e1-4d22-a3f0-6d66ac5b58b1",
            'class' => TrainerClass::JUGGLER,
            'name' => "Mason",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::PINECO,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::PINECO,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
            ],
        ],
        [
            'id' => "92ed6e75-18e7-4951-bf10-cae6ac2c142f",
            'class' => TrainerClass::POKEMON_RANGER,
            'gender' => Gender::MALE,
            'name' => "Nicolas",
            'team' => [
                [
                    'id' => PokedexNo::WEEPINBELL,
                    'sex' => Sex::MALE,
                    'level' => 51,
                ],
                [
                    'id' => PokedexNo::VICTREEBEL,
                    'sex' => Sex::MALE,
                    'level' => 51,
                ],
            ],
        ],
        [
            'id' => "676840d5-3bed-49f3-9c01-11ceb7e29b40",
            'class' => TrainerClass::POKEMON_RANGER,
            'gender' => Gender::FEMALE,
            'name' => "Madeline",
            'team' => [
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 51,
                ],
                [
                    'id' => PokedexNo::VILEPLUME,
                    'sex' => Sex::FEMALE,
                    'level' => 51,
                ],
            ],
        ],
        [
            'id' => "f95d79af-7f4a-4b04-a94c-bf574e811cfc",
            'class' => TrainerClass::YOUNG_COUPLE,
            'name' => "Eve & Jon",
            'team' => [
                [
                    'id' => PokedexNo::GOLDUCK,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
                [
                    'id' => PokedexNo::PSYDUCK,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
    ],
    LocationId::SEVAULT_CANYON => [
        [
            'id' => "46589e11-32ca-4553-9427-409d6fdd312c",
            'class' => TrainerClass::COOL_COUPLE,
            'name' => "Lex & Nya",
            'team' => [
                [
                    'id' => PokedexNo::TAUROS,
                    'sex' => Sex::MALE,
                    'level' => 52,
                ],
                [
                    'id' => PokedexNo::MILTANK,
                    'sex' => Sex::FEMALE,
                    'level' => 52,
                ],
            ],
        ],
        [
            'id' => "73c0e829-6c1d-48c1-8f55-06de4c3b1362",
            'class' => TrainerClass::TAMER,
            'name' => "Evan",
            'team' => [
                [
                    'id' => PokedexNo::SANDSLASH,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::LICKITUNG,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::URSARING,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "5cfc70c6-8f27-4479-b14c-8e56a2d13cd7",
            'class' => TrainerClass::POKEMON_RANGER,
            'gender' => Gender::MALE,
            'name' => "Jackson",
            'team' => [
                [
                    'id' => PokedexNo::TANGELA,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::EXEGGCUTE,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::EXEGGUTOR,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "b71decdf-97a5-415c-a752-b64579be7697",
            'class' => TrainerClass::POKEMON_RANGER,
            'gender' => Gender::FEMALE,
            'name' => "Katelyn",
            'team' => [
                [
                    'id' => PokedexNo::CHANSEY,
                    'sex' => Sex::FEMALE,
                    'level' => 52,
                ],
            ],
        ],
        [
            'id' => "6381bbd5-f380-4160-aed0-8bd038f86ac1",
            'class' => TrainerClass::CRUSH_GIRL,
            'name' => "Cyndy",
            'team' => [
                [
                    'id' => PokedexNo::PRIMEAPE,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::HITMONTOP,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
        [
            'id' => "22f84748-d7a8-40c0-8923-35b98fc88e33",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Leroy",
            'team' => [
                [
                    'id' => PokedexNo::RHYDON,
                    'sex' => Sex::MALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::SLOWBRO,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::KANGASKHAN,
                    'sex' => Sex::FEMALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::URSARING,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "f1b09aac-eb91-48bc-a1d4-8bc6eca93205",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Michelle",
            'team' => [
                [
                    'id' => PokedexNo::PERSIAN,
                    'sex' => Sex::FEMALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::DEWGONG,
                    'sex' => Sex::FEMALE,
                    'level' => 47,
                ],
                [
                    'id' => PokedexNo::NINETALES,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::RAPIDASH,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::GIRAFARIG,
                    'sex' => Sex::FEMALE,
                    'level' => 50,
                ],
            ],
        ],
    ],
    LocationId::TANOBY_RUINS => [
        [
            'id' => "e4526e41-d5de-4394-a403-a15fe67f09cd",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Brandon",
            'team' => [
                [
                    'id' => PokedexNo::ONIX,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "ede4e854-6f83-455f-82e7-7854e3d25a08",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Clifford",
            'team' => [
                [
                    'id' => PokedexNo::MAROWAK,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::GOLDUCK,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "7216161f-d30e-45f5-b16e-100ac43c623a",
            'class' => TrainerClass::PAINTER,
            'name' => "Edna",
            'team' => [
                [
                    'id' => PokedexNo::SMEARGLE,
                    'sex' => Sex::MALE,
                    'level' => 50,
                ],
            ],
        ],
        [
            'id' => "aea262c5-829a-42c5-bc9c-e8850ac69e4e",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Benjamin",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
            ],
        ],
    ],
];
