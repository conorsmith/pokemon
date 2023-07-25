<?php
declare(strict_types=1);

use ConorSmith\Pokemon\Gender;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

return [
    LocationId::ROUTE_102 => [
        [
            'id' => "eaf7bfcd-d66c-4ada-916e-6921da44d58e",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Calvin",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 5,
                ],
            ],
        ],
        [
            'id' => "bbfbaef6-31a8-4d7d-a4b2-8d575a33bf8c",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Rick",
            'team' => [
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 4,
                ],
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 4,
                ],
            ],
        ],
        [
            'id' => "bf4c3a0c-cbd5-41cc-9f5f-34c8425da3b1",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Allen",
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 5,
                ],
                [
                    'id' => PokedexNo::TAILLOW,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
            ],
        ],
        [
            'id' => "e110ad13-1fa4-4cf4-855e-bf430229a3ad",
            'class' => TrainerClass::LASS,
            'name' => "Tiana",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::FEMALE,
                    'level' => 4,
                ],
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::FEMALE,
                    'level' => 4,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_103 => [
        [
            'id' => "62ab9898-e67f-4478-a40e-6ec6c8d53239",
            'class' => TrainerClass::AROMA_LADY,
            'name' => "Daisy",
            'team' => [
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "986780cc-c51b-464b-a123-052484717d1b",
            'class' => TrainerClass::TWINS,
            'name' => "Amy & Liv",
            'team' => [
                [
                    'id' => PokedexNo::PLUSLE,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::MINUN,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "c776423f-13f3-4a2d-a75f-85d39846bf58",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::MALE,
            'name' => "Miguel",
            'team' => [
                [
                    'id' => PokedexNo::SKITTY,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "f8017f9c-bfe1-43ca-8dca-cf23bfba6e74",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Andrew",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 5,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "835ba66b-e3ba-4a63-a4c4-1400f01794fb",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Isabelle",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "4b62e643-f221-45c4-8e49-1bcf48a003f7",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Pete",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "103536e2-c9a2-4c11-8d2f-35c4f211b962",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Rhett",
            'team' => [
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "c132ed49-29fe-4837-b7ad-4b7033db336e",
            'class' => TrainerClass::GUITARIST,
            'name' => "Marcos",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 15,
                ],
            ],
        ],
    ],
    LocationId::PETALBURG_GYM => [
        [
            'id' => "035b223d-3997-40d7-a3ae-0d3c46d12da9",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Randall",
            'team' => [
                [
                    'id' => PokedexNo::DELCATTY,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "bcd7ba72-a1bc-42c1-b882-cec524168c2f",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Mary",
            'team' => [
                [
                    'id' => PokedexNo::DELCATTY,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "c6adfc2e-3ad2-4d48-af2f-a7f001d6ee03",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Parker",
            'team' => [
                [
                    'id' => PokedexNo::LINOONE,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "9db55837-7f9e-4f87-a50d-085460e74276",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Lori",
            'team' => [
                [
                    'id' => PokedexNo::LINOONE,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "dc7e86e2-347c-4cea-9b6d-d5262f07ac57",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "George",
            'team' => [
                [
                    'id' => PokedexNo::LINOONE,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "1fcd6505-35fc-4efe-8cdd-f67a37d7802a",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Jody",
            'team' => [
                [
                    'id' => PokedexNo::ZANGOOSE,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "c414d8ee-37e6-4fa3-8031-9dc1598c61e5",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Berke",
            'team' => [
                [
                    'id' => PokedexNo::ZANGOOSE,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "25da48e8-58e1-4ed6-81d4-550fd8bf3f83",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Norman",
            'leader' => [
                'badge' => GymBadge::BALANCE,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/7/75/Spr_RS_Norman.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::SLAKING,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::VIGOROTH,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SLAKING,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_104 => [
        [
            'id' => "da34615e-a8ea-4d8f-97dc-106d465c84a6",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Billy",
            'team' => [
                [
                    'id' => PokedexNo::SEEDOT,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
                [
                    'id' => PokedexNo::TAILLOW,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
            ],
        ],
        [
            'id' => "8851d1ff-4b6b-447b-803a-6898ceed0b4d",
            'class' => TrainerClass::RICH_BOY,
            'name' => "Winston",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
            ],
        ],
        [
            'id' => "f964bc47-0f5c-4f05-ae65-2b95ab788ac7",
            'class' => TrainerClass::LADY,
            'name' => "Cindy",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::FEMALE,
                    'level' => 7,
                ],
            ],
        ],
        [
            'id' => "7cb6b836-4ea4-4f1b-8181-fc80331cb621",
            'class' => TrainerClass::LASS,
            'name' => "Haley",
            'team' => [
                [
                    'id' => PokedexNo::LOTAD,
                    'sex' => Sex::FEMALE,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::SHROOMISH,
                    'sex' => Sex::FEMALE,
                    'level' => 7,
                ],
            ],
        ],
        [
            'id' => "5e9a5967-ce8d-46a1-be51-4351c4830c3e",
            'class' => TrainerClass::TWINS,
            'name' => "Gina & Mia",
            'team' => [
                [
                    'id' => PokedexNo::LOTAD,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::SEEDOT,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
            ],
        ],
        [
            'id' => "9bca0e45-e155-4427-8501-f10cea3a7faf",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Ivan",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
            ],
        ],
    ],
    LocationId::RUSTBORO_GYM => [
        [
            'id' => "240430ae-f2b3-424d-be4d-fca9d20fa35a",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Josh",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
            ],
        ],
        [
            'id' => "eb9dcf97-b174-4e2b-a284-cf72c4715d36",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Tommy",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "7cf893fe-e8a1-475e-871e-a65aadb718d4",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Roxanne",
            'leader' => [
                'badge' => GymBadge::STONE,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/e/ef/Spr_RS_Roxanne.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::FEMALE,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::NOSEPASS,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_116 => [
        [
            'id' => "7df8d045-49b0-4221-b813-738c28e36822",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Joey",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "2ccbe54f-5b78-467c-a82c-d3c88c311a36",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Jose",
            'team' => [
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::SILCOON,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::NINCADA,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
            ],
        ],
        [
            'id' => "f4ce27a7-3219-4805-854f-a1b02923f982",
            'class' => TrainerClass::LASS,
            'name' => "Janice",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "4746334e-be9b-4410-ae29-c76255fb5dfc",
            'class' => TrainerClass::HIKER,
            'name' => "Clark",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
            ],
        ],
        [
            'id' => "bc2724a3-2978-4fc9-b88c-17adbb3fce42",
            'class' => TrainerClass::SCHOOL_KID,
            'gender' => Gender::MALE,
            'name' => "Jerry",
            'team' => [
                [
                    'id' => PokedexNo::RALTS,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "35f97b7b-8b4c-417b-a043-5c59a89dcbed",
            'class' => TrainerClass::SCHOOL_KID,
            'gender' => Gender::FEMALE,
            'name' => "Karen",
            'team' => [
                [
                    'id' => PokedexNo::SHROOMISH,
                    'sex' => Sex::FEMALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::WHISMUR,
                    'sex' => Sex::FEMALE,
                    'level' => 9,
                ],
            ],
        ],
    ],
    LocationId::RUSTURF_TUNNEL => [
        [
            'id' => "ccaa39d3-929a-4a97-807e-2b72c76266f7",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "146a73af-8972-4230-b71a-4bf4a281619d",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "c657f4ba-89fd-4638-8aa9-0d8f6169b727",
            'class' => TrainerClass::HIKER,
            'name' => "Mike",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_105 => [
        [
            'id' => "6ef67fa9-aa1a-4f8d-9e53-4fa064cbf7a3",
            'class' => TrainerClass::SWIMMER,
            'name' => "Dawn",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "68181376-d4d4-4afd-8d34-be48ceac366d",
            'class' => TrainerClass::SWIMMER,
            'name' => "Beverly",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "89d535e1-77fd-418d-9f2f-1f0848e4d3f1",
            'class' => TrainerClass::SWIMMER,
            'name' => "Austin",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "532b9ba6-d89f-4ee8-b11a-12037901c75c",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Foster",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "a2240e25-b92c-4213-83a8-9601b0df0d69",
            'class' => TrainerClass::SWIMMER,
            'name' => "Luis",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_106 => [
        [
            'id' => "6a5cb0ff-bb7c-4d8d-9478-ebffe49cac88",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Ned",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "2ffce169-1768-45c0-943e-1dc90a070cde",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Elliot",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "99ddf94b-2abd-44df-ac11-810ec313d75d",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Douglas",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "97559587-03c2-49c8-bbe1-fbce923a60ec",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Nicole",
            'team' => [
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
    ],
    LocationId::DEWFORD_GYM => [
        [
            'id' => "4a805286-0c0f-4625-937f-ea91eda00779",
            'class' => TrainerClass::BATTLE_GIRL,
            'name' => "Laura",
            'team' => [
                [
                    'id' => PokedexNo::MEDITITE,
                    'sex' => Sex::FEMALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "41d26e64-d445-43fd-b9e6-1684bd151af3",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Hideki",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "8bff4e85-832f-4a63-b846-b69ddc2359d6",
            'class' => TrainerClass::BATTLE_GIRL,
            'team' => [
                [
                    'id' => PokedexNo::MEDITITE,
                    'sex' => Sex::FEMALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::MEDITITE,
                    'sex' => Sex::FEMALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "aa17aae5-c220-4f77-99da-a25db9a22c83",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Brawly",
            'leader' => [
                'badge' => GymBadge::KNUCKLE,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/9/92/Spr_RS_Brawly.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_107 => [
        [
            'id' => "f9245266-ba31-4b2d-95d9-bbba7b82b04e",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Beth",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "87eead00-2e2d-4c37-837f-b3c5261a6a2d",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Darrin",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "36ac2014-b498-44e8-8f3b-fc75722fed38",
            'class' => TrainerClass::SIS_AND_BRO,
            'name' => "Lisa & Ray",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "12ac676b-3fa0-4783-b6ae-50a115a3ae6b",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Tony",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "ddf7726c-b7fc-4698-a91c-326927ab79fc",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Denise",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_108 => [
        [
            'id' => "f3e3579d-d976-4d43-a5b8-57e88774c460",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Jerome",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "1396f3be-62f7-45c3-9d34-d97d19a75711",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Tara",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "4fd84169-d588-4982-ab98-130662583a45",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Matthew",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "aa11cb0f-ceef-49cb-a8dc-14405e3585d2",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Missy",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 24,
                ],
            ],
        ],
    ],
    LocationId::ABANDONED_SHIP_1F => [
        [
            'id' => "8276b17d-fd50-451a-8d5a-1d4a78e64200",
            'class' => TrainerClass::TUBER,
            'gender' => Gender::MALE,
            'name' => "Charlie",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "ebbde931-7746-45c8-8698-632157ac42cb",
            'class' => TrainerClass::YOUNG_COUPLE,
            'name' => "Lois & Hal",
            'team' => [
                [
                    'id' => PokedexNo::VOLBEAT,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::ILLUMISE,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
    ],
    LocationId::ABANDONED_SHIP_B1F => [
        [
            'id' => "712d53e9-d6c0-47c5-bb0c-3319ca21c2ce",
            'class' => TrainerClass::SAILOR,
            'name' => "Duncan",
            'team' => [
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_109 => [
        [
            'id' => "76d147da-d66d-4d31-b2ea-1309623a71ff",
            'class' => TrainerClass::SAILOR,
            'name' => "Huey",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "9cae9cc0-3258-4edd-ab51-e3a42282ff33",
            'class' => TrainerClass::SAILOR,
            'name' => "Edmond",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "bad9988c-25dd-493c-815d-186a1600d4d9",
            'class' => TrainerClass::TUBER,
            'gender' => Gender::MALE,
            'name' => "Ricky",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "be5c320a-21b2-44ac-b2c7-6c158f84fa1e",
            'class' => TrainerClass::TUBER,
            'gender' => Gender::FEMALE,
            'name' => "Lola",
            'team' => [
                [
                    'id' => PokedexNo::AZURILL,
                    'sex' => Sex::FEMALE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::AZURILL,
                    'sex' => Sex::FEMALE,
                    'level' => 13,
                ],
            ],
        ],
        [
            'id' => "870b0e38-1335-4f6f-9ba4-0032b61dcdee",
            'class' => TrainerClass::TUBER,
            'gender' => Gender::FEMALE,
            'name' => "Gwen",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "64835c93-d6c9-4aa4-84c8-2c3645e98774",
            'class' => TrainerClass::TUBER,
            'gender' => Gender::FEMALE,
            'name' => "Carmen",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "365a7714-42a1-477a-b495-123d9eb712ca",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Alice",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "179687c4-e061-4021-8cb8-27936d4092f1",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "David",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "cdce2531-f84f-4e97-a8c4-1832c2a85079",
            'class' => TrainerClass::YOUNG_COUPLE,
            'name' => "Mel & Paul",
            'team' => [
                [
                    'id' => PokedexNo::BEAUTIFLY,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::DUSTOX,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "66109719-1102-4261-86f9-8f1e95b11dd4",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Carter",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
    ],
    LocationId::SEASHORE_HOUSE => [
        [
            'id' => "28d6474e-9ce5-454c-83f0-fca1c1e10ff5",
            'class' => TrainerClass::TUBER,
            'gender' => Gender::MALE,
            'name' => "Simon",
            'team' => [
                [
                    'id' => PokedexNo::AZURILL,
                    'sex' => Sex::FEMALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "0dfb88c8-0865-4489-b296-306b99967cb8",
            'class' => TrainerClass::BEAUTY,
            'name' => "Johanna",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 13,
                ],
            ],
        ],
        [
            'id' => "359eb664-73d5-4ea5-a21c-44da49f4cdad",
            'class' => TrainerClass::SAILOR,
            'name' => "Dwayne",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
    ],
    LocationId::OCEANIC_MUSEUM => [
        [
            'id' => "dd474981-7031-48c2-a377-52163666c6a1",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "4b2a37e6-4425-4797-80cd-3c361175b257",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "3f6f7108-9f31-4fbc-9449-a5f07345ea18",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "9f802a1f-1a40-4b8a-ba3f-74828cfedbcc",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_110 => [
        [
            'id' => "15d3bd2b-5251-4b10-9324-cb9117c4425d",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::FEMALE,
            'name' => "Isabel",
            'team' => [
                [
                    'id' => PokedexNo::PLUSLE,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::MINUN,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "6f72e275-29c0-4030-8adb-5e098ea78d94",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Timmy",
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::ARON,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::ELECTRIKE,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "edd19111-20e8-4ea8-b8ef-a28e5e84e1b2",
            'class' => TrainerClass::COLLECTOR,
            'name' => "Edwin",
            'team' => [
                [
                    'id' => PokedexNo::LOMBRE,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::NUZLEAF,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "78257431-df4d-416b-8145-ac4ddd074a59",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Edward",
            'team' => [
                [
                    'id' => PokedexNo::ABRA,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "e1344c94-6808-4995-b632-11ef5e2995c2",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Dale",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
    ],
    LocationId::MAUVILLE_GYM => [
        [
            'id' => "8a4d346d-b1ba-47a4-98cc-f0785e22b0b1",
            'class' => TrainerClass::GUITARIST,
            'name' => "Kirk",
            'team' => [
                [
                    'id' => PokedexNo::ELECTRIKE,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "b70efa30-ac2a-4c6f-ba70-6890ae4994a5",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Ben",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "d7afb4f1-5fde-44a3-bbdf-5dadc5b0f6c7",
            'class' => TrainerClass::GUITARIST,
            'name' => "Shawn",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "531f59b5-df67-49f9-8c2e-d2862ca5c4ba",
            'class' => TrainerClass::BATTLE_GIRL,
            'name' => "Vivian",
            'team' => [
                [
                    'id' => PokedexNo::MEDITITE,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "5ccb4e29-319b-4d73-ae83-351fa81ee03d",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Wattson",
            'leader' => [
                'badge' => GymBadge::DYNAMO,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/b/b2/Spr_RS_Wattson.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::MAGNETON,
                    'sex' => Sex::UNKNOWN,
                    'level' => 23,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_111 => [
        [
            'id' => "be7e718f-a341-4f21-860f-50daffa7e8d2",
            'class' => TrainerClass::INTERVIEWER,
            'name' => "Gabby and Ty",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::WHISMUR,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "4e5d30eb-2742-4acc-a320-b42fcfeffd28",
            'class' => TrainerClass::PICNICKER,
            'name' => "Irene",
            'team' => [
                [
                    'id' => PokedexNo::SHROOMISH,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "dce8ba96-2436-496f-b308-fc0cc31fa523",
            'class' => TrainerClass::CAMPER,
            'name' => "Travis",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "6f56cbf8-139b-4a31-b53d-a689235653cd",
            'class' => TrainerClass::CAMPER,
            'name' => "Cliff",
            'team' => [
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "3da5efe1-d58c-4c75-8355-915814f79ec3",
            'class' => TrainerClass::PICNICKER,
            'name' => "Heidi",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::FEMALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "1a0783cf-fb4a-4b66-96df-7c9286adbeac",
            'class' => TrainerClass::CAMPER,
            'name' => "Drew",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "7301d6dd-dbcd-48ac-9e33-25bd8b02972c",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Dusty",
            'team' => [
                [
                    'id' => PokedexNo::SANDSLASH,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "8cea3e20-77a1-4c9e-9647-37c3097d5927",
            'class' => TrainerClass::PICNICKER,
            'name' => "Becky",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::FEMALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "6cf19ac4-c032-432d-9542-fb175442fb7a",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Wilton",
            'team' => [
                [
                    'id' => PokedexNo::ELECTRIKE,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "ef9722b7-f8dd-4a1d-b0b8-6fda641d2c97",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Brooke",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "5b3546bf-d339-4c11-9601-fb7cbd916be6",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Daisuke",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
    ],
    LocationId::WINSTRATE_FAMILY_HOME => [
        [
            'id' => "c68def86-3458-443b-9935-8833fa3502ba",
            'class' => TrainerClass::WINSTRATE,
            'name' => "Victor",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/a/a3/Spr_RS_Pok%C3%A9fan_M.png",
            'team' => [
                [
                    'id' => PokedexNo::TAILLOW,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "838fdbfd-f781-4bc2-8f74-f83dc1e737ca",
            'class' => TrainerClass::WINSTRATE,
            'name' => "Victoria",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/6/63/Spr_RS_Pok%C3%A9fan_F.png",
            'team' => [
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::FEMALE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "42d89575-299a-41a0-a736-f3628d75f4f8",
            'class' => TrainerClass::WINSTRATE,
            'name' => "Vivi",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/1/16/Spr_RS_Lass.png",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::SHROOMISH,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "4753554e-0ed7-4791-8a60-f4fad0ae6112",
            'class' => TrainerClass::WINSTRATE,
            'name' => "Vicky",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/6/66/Spr_RS_Expert_F.png",
            'team' => [
                [
                    'id' => PokedexNo::MEDITITE,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_112 => [
        [
            'id' => "ecc576cc-6edb-4a41-9e29-487d2110169e",
            'class' => TrainerClass::CAMPER,
            'name' => "Larry",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::NUZLEAF,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "1c672a8b-a483-4dca-b47b-005116bf7a7c",
            'class' => TrainerClass::PICNICKER,
            'name' => "Carol",
            'team' => [
                [
                    'id' => PokedexNo::TAILLOW,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::LOMBRE,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "f7a142e2-e1ba-4788-b7c0-a26e646f75b7",
            'class' => TrainerClass::HIKER,
            'name' => "Trent",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "6f6db65e-84f8-4384-89fb-c302590496a1",
            'class' => TrainerClass::HIKER,
            'name' => "Brice",
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::MT_CHIMNEY => [
        [
            'id' => "91c983f8-a332-479d-aeac-cce173822918",
            'class' => TrainerClass::BEAUTY,
            'name' => "Shirley",
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::FEMALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "a9c79344-bd74-4d82-9f28-48e589a81ce0",
            'class' => TrainerClass::BEAUTY,
            'name' => "Sheila",
            'team' => [
                [
                    'id' => PokedexNo::SHROOMISH,
                    'sex' => Sex::FEMALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "1ec8b663-776c-41f7-b336-2640ce1d5063",
            'class' => TrainerClass::EXPERT,
            'gender' => Gender::FEMALE,
            'name' => "Shelby",
            'team' => [
                [
                    'id' => PokedexNo::MEDITITE,
                    'sex' => Sex::FEMALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "50f5f381-4e42-47fd-837d-166d80601133",
            'class' => TrainerClass::BEAUTY,
            'name' => "Melissa",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "2f0feff5-6ee7-409f-98ef-b147e2917962",
            'class' => TrainerClass::HIKER,
            'name' => "Sawyer",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "57c54142-824e-423b-9fac-608a4070365e",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "dfc7ef2c-3c12-4466-b403-52f2f8e44c01",
            'class' => TrainerClass::MAGMA_ADMIN,
            'name' => "Tabitha",
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "1a99c548-b967-40fc-bb6a-63c8c19a206e",
            'class' => TrainerClass::MAGMA_LEADER,
            'name' => "Maxie",
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::CAMERUPT,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "ffd46788-be24-4869-b0fb-4b82a9918abd",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "df098ec2-a709-4a87-a1f6-d23797bd00b5",
            'class' => TrainerClass::AQUA_ADMIN,
            'name' => "Matt",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "c3a4c12d-8a2d-4db7-a3d4-74730b5b06b3",
            'class' => TrainerClass::AQUA_LEADER,
            'name' => "Archie",
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::SHARPEDO,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
    ],
    LocationId::JAGGED_PASS => [
        [
            'id' => "5318c81b-cb0a-4981-aa5e-5c5bbd2bb24f",
            'class' => TrainerClass::HIKER,
            'name' => "Eric",
            'team' => [
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "4aa8acf8-dac3-45df-8b87-cde1c4b492a0",
            'class' => TrainerClass::CAMPER,
            'name' => "Ethan",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::TAILLOW,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "d27d0990-4b9a-486d-9460-c42ea02a4f15",
            'class' => TrainerClass::PICNICKER,
            'name' => "Diana",
            'team' => [
                [
                    'id' => PokedexNo::SHROOMISH,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::SWABLU,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
            ],
        ],
    ],
    LocationId::MAGMA_HIDEOUT_1F => [
        [
            'id' => "366b3d34-a4ed-4a56-aff9-44ca6eec86f4",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "f5efcbb6-1456-40ad-a375-bcd79d85127a",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::MAGMA_HIDEOUT_2F => [
        [
            'id' => "69b36fee-b3eb-4db0-91f4-b9b4593a2132",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "1ba6fe99-4cfe-4fd8-a053-5df5ed98ddbf",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "e603b330-a492-4e42-b422-8011deaea905",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "782bc1d8-4ce2-4c51-872a-f91709f578ae",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
    ],
    LocationId::MAGMA_HIDEOUT_3F => [
        [
            'id' => "e1b36cd4-5611-47d6-9247-7ee01dcb66e5",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "c3396656-4e72-4e75-b3a5-206e5a899585",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "797f9ac1-e8f4-4346-83cd-620256069b16",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::MAGMA_HIDEOUT_4F => [
        [
            'id' => "0985660c-d819-4286-b84b-279a533cad11",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "c8d28793-77e6-4985-b6a4-8cba1328c050",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "65b18647-abbe-4b91-bfd5-1b8960ca65fe",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::MAGMA_HIDEOUT_5F => [
        [
            'id' => "6185fc9e-087d-408b-8403-aa4ee9ae1f79",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "6b07911e-02fa-46d2-9671-131bb1d97af0",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "b3317d4a-f619-49e4-ba8b-18f812935b78",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "7054313b-e657-4b28-b97a-80ab9672b3c8",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
    ],
    LocationId::MAGMA_HIDEOUT_6F => [
        [
            'id' => "420cc5ab-3188-4df4-8f16-d1e8b3b68904",
            'class' => TrainerClass::MAGMA_ADMIN,
            'name' => "Tabitha",
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "62089c49-4b35-4f01-91fa-02d8c68689f6",
            'class' => TrainerClass::MAGMA_LEADER,
            'name' => "Maxie",
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::CROBAT,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::CAMERUPT,
                    'sex' => Sex::MALE,
                    'level' => 39,
                ],
            ],
        ],
    ],
];
