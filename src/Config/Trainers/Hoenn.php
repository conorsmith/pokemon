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
    LocationId::PETALBURG_WOODS => [
        [
            'id' => "d5b2f648-60b7-476c-9197-acea380c4394",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Lyle",
            'team' => [
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
            ],
        ],
        [
            'id' => "3935b090-48f8-4c18-9c36-ae6b531eccbd",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
            ],
        ],
        [
            'id' => "c83603ef-b875-41ac-bd9a-a8797ef0e590",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
            ],
        ],
        [
            'id' => "b4cb0378-4134-4a0f-b478-37d520f2e7b0",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "James",
            'team' => [
                [
                    'id' => PokedexNo::NINCADA,
                    'sex' => Sex::MALE,
                    'level' => 8,
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
    LocationId::LAVARIDGE_GYM => [
        [
            'id' => "40b99eca-3148-4a38-81af-149b95e36eed",
            'class' => TrainerClass::KINDLER,
            'name' => "Cole",
            'team' => [
                [
                    'id' => PokedexNo::SLUGMA,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::SLUGMA,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "c32b9a6a-1149-4e57-9640-3e1a77850c6a",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Zane",
            'team' => [
                [
                    'id' => PokedexNo::KECLEON,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "8ca34218-2e51-4a35-b11c-934e8e921217",
            'class' => TrainerClass::KINDLER,
            'name' => "Axle",
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::SLUGMA,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "3b6a65f0-eadd-4df3-a7cd-d4bdd012ff33",
            'class' => TrainerClass::BATTLE_GIRL,
            'name' => "Sadie",
            'team' => [
                [
                    'id' => PokedexNo::MEDITITE,
                    'sex' => Sex::FEMALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "b7ead7ce-ce4d-4fc5-aafd-f6db47cf56fa",
            'class' => TrainerClass::KINDLER,
            'name' => "Andy",
            'team' => [
                [
                    'id' => PokedexNo::SLUGMA,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "ec4e1f37-3a8f-4fbb-b547-535fa14c8d6d",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Flannery",
            'leader' => [
                'badge' => GymBadge::HEAT,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/b/be/Spr_RS_Flannery.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::SLUGMA,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SLUGMA,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::TORKOAL,
                    'sex' => Sex::FEMALE,
                    'level' => 28,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_113 => [
        [
            'id' => "2c7685ba-fa2a-4e2a-9bda-e26a0ae26249",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Neal",
            'team' => [
                [
                    'id' => PokedexNo::TRAPINCH,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::LINOONE,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "f6b555a5-4f81-4fd1-9e62-affa31cc46c7",
            'class' => TrainerClass::NINJA_BOY,
            'name' => "Lao",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "d4031d11-7f90-4a7e-95f1-39bd5902200c",
            'class' => TrainerClass::PARASOL_LADY,
            'name' => "Madeline",
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "8a06336b-af07-4f95-9862-f8d23c4d0a1f",
            'class' => TrainerClass::TWINS,
            'name' => "Tori & Tia",
            'team' => [
                [
                    'id' => PokedexNo::WHISMUR,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::WHISMUR,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "fcc2c5f5-434f-40be-a859-9aadbdff913b",
            'class' => TrainerClass::NINJA_BOY,
            'name' => "Lung",
            'team' => [
                [
                    'id' => PokedexNo::NINCADA,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::NINJASK,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "cf319d3e-acbe-4af1-89a3-b43eb005123e",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Dillion",
            'team' => [
                [
                    'id' => PokedexNo::ARON,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_114 => [
        [
            'id' => "289c7dac-aa0b-48b2-b645-e2ffc59e08e1",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Nolan",
            'team' => [
                [
                    'id' => PokedexNo::BARBOACH,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "b2a6aa87-95b5-4250-8094-1fc2185fe061",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Claude",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::BARBOACH,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "459111b0-f4e2-4643-9483-48e7b8c9bcc4",
            'class' => TrainerClass::PICNICKER,
            'name' => "Nancy",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::LOMBRE,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "d5eba62c-c801-4106-b80d-123021020ebe",
            'class' => TrainerClass::TEAMMATES,
            'name' => "Tyra & Ivy",
            'team' => [
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::FEMALE,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "81db59e1-c6b4-43ce-a78f-883c07e1b836",
            'class' => TrainerClass::CAMPER,
            'name' => "Shane",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::NUZLEAF,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "f63dea7a-21dc-4da1-a3ef-91053994769d",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Steve",
            'team' => [
                [
                    'id' => PokedexNo::ARON,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "8e154345-403a-4915-9a36-da38d17263d5",
            'class' => TrainerClass::KINDLER,
            'name' => "Bernie",
            'team' => [
                [
                    'id' => PokedexNo::SLUGMA,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "c83de03b-9002-4d2a-981c-37b894742a69",
            'class' => TrainerClass::HIKER,
            'name' => "Lucas",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "c0418833-a9ab-4077-81af-59153b92f25e",
            'class' => TrainerClass::HIKER,
            'name' => "Lenny",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
    ],
    LocationId::METEOR_FALLS_B1F => [
        [
            'id' => "42f66d36-4aba-4e12-8291-47299658781a",
            'class' => TrainerClass::OLD_COUPLE,
            'name' => "John and Jay",
            'team' => [
                [
                    'id' => PokedexNo::MEDICHAM,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::HARIYAMA,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "7f4fe119-b7df-4971-ab83-aa5e61f2ed26",
            'class' => TrainerClass::DRAGON_TAMER,
            'name' => "Nicolas",
            'team' => [
                [
                    'id' => PokedexNo::ALTARIA,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::ALTARIA,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
    ],
    LocationId::METEOR_FALLS_STEVENS_CAVE => [
        [
            'id' => "2616e52a-60a0-4545-89dd-e8e7fe09fa23",
            'class' => TrainerClass::RETIRED_TRAINER,
            'name' => "Steven",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/a/ad/Spr_RS_Steven.png",
            'prerequisite' => [
                'champion' => RegionId::HOENN,
            ],
            'team' => [
                [
                    'id' => PokedexNo::SKARMORY,
                    'sex' => Sex::MALE,
                    'level' => 77,
                ],
                [
                    'id' => PokedexNo::CLAYDOL,
                    'sex' => Sex::UNKNOWN,
                    'level' => 75,
                ],
                [
                    'id' => PokedexNo::AGGRON,
                    'sex' => Sex::MALE,
                    'level' => 76,
                ],
                [
                    'id' => PokedexNo::CRADILY,
                    'sex' => Sex::MALE,
                    'level' => 76,
                ],
                [
                    'id' => PokedexNo::ARMALDO,
                    'sex' => Sex::MALE,
                    'level' => 76,
                ],
                [
                    'id' => PokedexNo::METAGROSS,
                    'sex' => Sex::MALE,
                    'level' => 78,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_115 => [
        [
            'id' => "5dbacb38-5900-41d7-9354-34db7567a3aa",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Nob",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "84c9e9ea-c9c5-451f-9b4f-e5ee3f7d174d",
            'class' => TrainerClass::COLLECTOR,
            'name' => "Hector",
            'team' => [
                [
                    'id' => PokedexNo::SEVIPER,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "35583f8f-8f91-4d4c-84d6-9b630632d841",
            'class' => TrainerClass::COLLECTOR,
            'name' => "Hector",
            'team' => [
                [
                    'id' => PokedexNo::ZANGOOSE,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "36555a97-718a-4009-ac1f-f7cdb4724708",
            'class' => TrainerClass::BATTLE_GIRL,
            'name' => "Cyndy",
            'team' => [
                [
                    'id' => PokedexNo::MEDITITE,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "c648bbfe-b8ca-457d-9353-f5d3a66668e8",
            'class' => TrainerClass::EXPERT,
            'gender' => Gender::MALE,
            'name' => "Timothy",
            'team' => [
                [
                    'id' => PokedexNo::HARIYAMA,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "56ab15ff-7b3d-4f98-9c2e-10e31f8a23eb",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Koichi",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
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
    LocationId::ROUTE_117 => [
        [
            'id' => "9d5763fe-482a-4acf-a723-43f6e374aa92",
            'class' => TrainerClass::TEAMMATES,
            'name' => "Anna & Meg",
            'team' => [
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "8b9d3ba7-c3a0-45be-b6fd-ac78904c5c2f",
            'class' => TrainerClass::TRIATHLETE,
            'gender' => Gender::MALE,
            'name' => "Dylan",
            'team' => [
                [
                    'id' => PokedexNo::DODUO,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "c8190d61-dd8d-4bf5-969f-0c0fc32e8bd1",
            'class' => TrainerClass::POKEMON_BREEDER,
            'gender' => Gender::FEMALE,
            'name' => "Lydia",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::SHROOMISH,
                    'sex' => Sex::FEMALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::FEMALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::SKITTY,
                    'sex' => Sex::FEMALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "b5b9dc8c-f2c3-4c27-97df-20ed9ab7ba71",
            'class' => TrainerClass::TRIATHLETE,
            'gender' => Gender::FEMALE,
            'name' => "Maria",
            'team' => [
                [
                    'id' => PokedexNo::DODUO,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "47f6a30d-67a9-4c2b-9557-de5d2de03c9b",
            'class' => TrainerClass::BUG_MANIAC,
            'name' => "Derek",
            'team' => [
                [
                    'id' => PokedexNo::NINCADA,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::DUSTOX,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::BEAUTIFLY,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "7db69600-4c99-46f9-a895-e6308b5871ed",
            'class' => TrainerClass::POKEMON_BREEDER,
            'gender' => Gender::MALE,
            'name' => "Isaac",
            'team' => [
                [
                    'id' => PokedexNo::WHISMUR,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::ZIGZAGOON,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::ARON,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::TAILLOW,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_118 => [
        [
            'id' => "dcaa43b7-c802-44ad-bdaf-28068d4cadcd",
            'class' => TrainerClass::AROMA_LADY,
            'name' => "Rose",
            'team' => [
                [
                    'id' => PokedexNo::SHROOMISH,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "f346361b-09e6-4f39-b0ad-7c3bc3ad6715",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Wade",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "39fd89e8-e9d8-40cd-b9f2-f46578f2fafb",
            'class' => TrainerClass::GUITARIST,
            'name' => "Dalton",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::WHISMUR,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "cd014cf8-e6df-4e3e-a31a-af882cb04f0c",
            'class' => TrainerClass::INTERVIEWER,
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::LOUDRED,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "d96ad38a-78ce-4092-ac67-e927c2534e5d",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Barny",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
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
            'id' => "00205916-2504-4b1a-a8e7-9c319def2ea3",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Chester",
            'team' => [
                [
                    'id' => PokedexNo::TAILLOW,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "ce5a550a-cebf-421d-843d-b99ad5eb3990",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Perry",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_119 => [
        [
            'id' => "7536c2cf-4b93-460c-90d0-d231364522c2",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Kent",
            'team' => [
                [
                    'id' => PokedexNo::NINJASK,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "9fc644ab-9bfc-4166-8657-b09faf5c6296",
            'class' => TrainerClass::BUG_MANIAC,
            'name' => "Donald",
            'team' => [
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::SILCOON,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::BEAUTIFLY,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "32486e1e-df5d-4d88-89d3-25e6b28a3c52",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Greg",
            'team' => [
                [
                    'id' => PokedexNo::VOLBEAT,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::ILLUMISE,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "bc3bed79-40f7-401d-af59-e031bab83b04",
            'class' => TrainerClass::BUG_MANIAC,
            'name' => "Taylor",
            'team' => [
                [
                    'id' => PokedexNo::WURMPLE,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::CASCOON,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::DUSTOX,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "bee93ed8-c73d-400f-8ebf-0053cb38e94a",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Doug",
            'team' => [
                [
                    'id' => PokedexNo::NINCADA,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::NINCADA,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "c123b81e-3d4f-498e-90a5-35894685cf99",
            'class' => TrainerClass::BUG_MANIAC,
            'name' => "Brent",
            'team' => [
                [
                    'id' => PokedexNo::SURSKIT,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "8ebb7fcc-a303-4d09-947e-e03894f3a7bd",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Eugene",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::FEEBAS,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "551d5606-5954-4f68-bcda-7c52fb8c59e9",
            'class' => TrainerClass::POKEMON_RANGER,
            'name' => "Catherine",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "c9d7319f-9e8d-4f2a-a957-e7fb481cd342",
            'class' => TrainerClass::POKEMON_RANGER,
            'name' => "Jackson",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::BRELOOM,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "28e5c3ce-d867-4830-8eaa-2313432f11a9",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Phil",
            'team' => [
                [
                    'id' => PokedexNo::TAILLOW,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "52ced958-117d-47a8-b2e5-fd45c104b22b",
            'class' => TrainerClass::NINJA_BOY,
            'name' => "Takashi",
            'team' => [
                [
                    'id' => PokedexNo::NINCADA,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::NINJASK,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "241dcbf9-6236-4533-81db-4dc28bc75f15",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Hugh",
            'team' => [
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "126e4450-ca1e-4b30-8130-f00c339f9257",
            'class' => TrainerClass::NINJA_BOY,
            'name' => "Yasu",
            'team' => [
                [
                    'id' => PokedexNo::NINJASK,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "0ee9e8b8-91f3-4ec3-a88a-83cb3dc1dda3",
            'class' => TrainerClass::NINJA_BOY,
            'name' => "Hideo",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
    ],
    LocationId::WEATHER_INSTITUTE_1F => [
        [
            'id' => "8cbe5ed1-ce68-4843-a338-2e954cfa75d9",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::FEMALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "1b9d2c24-e055-4f78-9e47-08761e9ef581",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "00ff8935-d00e-432d-b027-23c313773d1d",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::FEMALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "6f05520c-2d09-4fed-98fa-b4bc4045034f",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
    ],
    LocationId::WEATHER_INSTITUTE_2F => [
        [
            'id' => "c7468289-cc4e-469d-abcd-af7cc389f671",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "9cce80a8-c37a-41df-806c-838cc101fec2",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "1cc4364c-fa63-423d-a390-810a247d3b0b",
            'class' => TrainerClass::MAGMA_ADMIN,
            'name' => "Courtney",
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::FEMALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::FEMALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "a5941825-b8c3-4184-85b1-7a7339b08b42",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "bdb6b6a0-d234-456e-b8ff-96f866076e1d",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
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
            'id' => "4f9fef93-0fe6-4248-998b-7e8746368c79",
            'class' => TrainerClass::AQUA_ADMIN,
            'name' => "Shelly",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::FEMALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::FEMALE,
                    'level' => 28,
                ],
            ],
        ],
    ],
    LocationId::FORTREE_GYM => [
        [
            'id' => "a3e425ce-f00c-4046-9353-c7c29094fd6a",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Jared",
            'team' => [
                [
                    'id' => PokedexNo::DODUO,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "00954f28-f425-4c15-babb-d5e180813dec",
            'class' => TrainerClass::PICNICKER,
            'name' => "Kylee",
            'team' => [
                [
                    'id' => PokedexNo::SWABLU,
                    'sex' => Sex::FEMALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "59b1e4a1-e670-43bc-a9a7-927d018c560b",
            'class' => TrainerClass::CAMPER,
            'name' => "Terrell",
            'team' => [
                [
                    'id' => PokedexNo::TAILLOW,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "f52b03e3-cbc6-4117-9fd1-32412d58bcf0",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Will",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "21a117e1-20fa-4aa1-ae29-4eda608589ee",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Winona",
            'leader' => [
                'badge' => GymBadge::FEATHER,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/0/0e/Spr_RS_Winona.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::FEMALE,
                    'level' => 30,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_120 => [
        [
            'id' => "0edf07a0-be05-4f9f-b6d9-28e62acea78f",
            'class' => TrainerClass::PARASOL_LADY,
            'name' => "Clarissa",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "14b9e662-5ba1-4e41-9c72-d51f65dd6e37",
            'class' => TrainerClass::INTERVIEWER,
            'team' => [
                [
                    'id' => PokedexNo::MAGNETON,
                    'sex' => Sex::UNKNOWN,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::LOUDRED,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "ef0c6b39-9e92-48a7-a167-2b6dfbb50aeb",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Robert",
            'team' => [
                [
                    'id' => PokedexNo::SWABLU,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "3dcb1066-a01c-4d4e-b514-2bd980d81cf7",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Colin",
            'team' => [
                [
                    'id' => PokedexNo::NATU,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "c3f38bb5-c771-4b85-b456-37c69f797159",
            'class' => TrainerClass::PARASOL_LADY,
            'name' => "Angelica",
            'team' => [
                [
                    'id' => PokedexNo::CASTFORM,
                    'sex' => Sex::FEMALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "e2ef5394-f555-407a-928f-494548900038",
            'class' => TrainerClass::NINJA_BOY,
            'name' => "Tsunao",
            'team' => [
                [
                    'id' => PokedexNo::NINCADA,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::NINJASK,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "fe98400f-86a7-420d-825e-47bba9376c60",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Jennifer",
            'team' => [
                [
                    'id' => PokedexNo::MILOTIC,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "8e5fa571-6d79-4b14-b888-a6bea17782d8",
            'class' => TrainerClass::POKEMON_RANGER,
            'gender' => Gender::FEMALE,
            'name' => "Jenna",
            'team' => [
                [
                    'id' => PokedexNo::LOTAD,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::LOMBRE,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::NUZLEAF,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "64344ba9-c3f8-488c-9585-2a9c7b666d64",
            'class' => TrainerClass::POKEMON_RANGER,
            'gender' => Gender::MALE,
            'name' => "Carlos",
            'team' => [
                [
                    'id' => PokedexNo::SEEDOT,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::NUZLEAF,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::LOMBRE,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "274201fb-95c9-4c62-8c8a-d4be7f037b63",
            'class' => TrainerClass::BUG_MANIAC,
            'name' => "Brandon",
            'team' => [
                [
                    'id' => PokedexNo::SURSKIT,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::SURSKIT,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::SURSKIT,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "876aa67b-eee4-4432-a437-054a23f91f32",
            'class' => TrainerClass::NINJA_BOY,
            'name' => "Keigo",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::NINJASK,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "ab1d9b15-56a2-41fe-bb1f-a22b1de532d5",
            'class' => TrainerClass::RUIN_MANIAC,
            'name' => "Chip",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_121 => [
        [
            'id' => "d956dc2d-8c33-4f4c-a882-736999519a85",
            'class' => TrainerClass::HEX_MANIAC,
            'name' => "Tammy",
            'team' => [
                [
                    'id' => PokedexNo::RALTS,
                    'sex' => Sex::FEMALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::DUSKULL,
                    'sex' => Sex::FEMALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "51971656-8804-4ae9-a897-a3d6b881c585",
            'class' => TrainerClass::BEAUTY,
            'name' => "Jessica",
            'team' => [
                [
                    'id' => PokedexNo::KECLEON,
                    'sex' => Sex::FEMALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SEVIPER,
                    'sex' => Sex::FEMALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "3afe9409-8d4a-49b0-a737-6c67812f1e55",
            'class' => TrainerClass::TEAMMATES,
            'name' => "Kate & Joy",
            'team' => [
                [
                    'id' => PokedexNo::SPINDA,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SLAKING,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "cb75383b-07d4-4b89-b627-129cf651399f",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Walter",
            'team' => [
                [
                    'id' => PokedexNo::MANECTRIC,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "583e44fe-da52-47dc-80cf-125d850b3be7",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::FEMALE,
            'name' => "Vanessa",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
            ],
        ],
    ],
    LocationId::MT_PYRE_2F => [
        [
            'id' => "567fb750-cc83-4096-92c9-996baf1f3e91",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Mark",
            'team' => [
                [
                    'id' => PokedexNo::LAIRON,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "8a2cae81-12ae-484e-93db-3a49ae41b1d0",
            'class' => TrainerClass::YOUNG_COUPLE,
            'name' => "Dez & Luke",
            'team' => [
                [
                    'id' => PokedexNo::DELCATTY,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::MANECTRIC,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
    ],
    LocationId::MT_PYRE_3F => [
        [
            'id' => "6e5df312-ffbd-44c2-9f79-91874885ac6e",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::FEMALE,
            'name' => "Kayla",
            'team' => [
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "1ae62d03-b195-4cc9-8f2d-64858cc434e3",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "William",
            'team' => [
                [
                    'id' => PokedexNo::RALTS,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::KIRLIA,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
    ],
    LocationId::MT_PYRE_4F =>     [
        [
            'id' => "7f94b42d-1995-43f4-bd03-be4f19f52a52",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Atsushi",
            'team' => [
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::HARIYAMA,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
    ],
    LocationId::MT_PYRE_5F => [
        [
            'id' => "c2bdad4d-0190-4f78-8197-134bb24a5627",
            'class' => TrainerClass::HEX_MANIAC,
            'name' => "Tasha",
            'team' => [
                [
                    'id' => PokedexNo::SHUPPET,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
    ],
    LocationId::MT_PYRE_6F => [
        [
            'id' => "fb045b44-a9c0-4e28-a707-1cf2e04cc5c5",
            'class' => TrainerClass::HEX_MANIAC,
            'name' => "Valerie",
            'team' => [
                [
                    'id' => PokedexNo::SABLEYE,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
            ],
        ],
    ],
    LocationId::MT_PYRE_SUMMIT => [
        [
            'id' => "70d52e24-f9dc-4d9c-b89b-90b73a70e364",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "e236368a-252e-4359-87c4-f9d96824cd14",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "3ec36f68-3602-47d9-bc7f-80ccd9b61f68",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "5cc9887f-890b-4c20-96b1-0b3297396535",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "0433dd91-4cab-41db-be02-eae02827a9a3",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "6d8270f1-3d8d-4463-9b72-686c8dd88df6",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_123 => [
        [
            'id' => "f15d681e-c745-4a9d-9171-07d9aebdde09",
            'class' => TrainerClass::TWINS,
            'name' => "Miu & Yuki",
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
            'id' => "6f9d5bbe-e2c3-4ea6-9ed0-dc89937c5807",
            'class' => TrainerClass::AROMA_LADY,
            'name' => "Violet",
            'team' => [
                [
                    'id' => PokedexNo::SHROOMISH,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::BRELOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "2c64916c-b744-4f1f-b80d-aadae53db6ca",
            'class' => TrainerClass::HEX_MANIAC,
            'name' => "Kindra",
            'team' => [
                [
                    'id' => PokedexNo::DUSKULL,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::SHUPPET,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "83137b81-9e6c-4955-989c-695d9d55b777",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Wendy",
            'team' => [
                [
                    'id' => PokedexNo::MAWILE,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "5655cb0b-21a6-48c7-869d-d863277b3062",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Clyde",
            'team' => [
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::TRAPINCH,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MAGNETON,
                    'sex' => Sex::UNKNOWN,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::SHIFTRY,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "e34118cd-c39e-45a3-bd02-cdad1e2ba107",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::FEMALE,
            'name' => "Jacki",
            'team' => [
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::LUNATONE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "df47d936-cb50-4885-8b1c-6daf291f964c",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Cameron",
            'team' => [
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::SOLROCK,
                    'sex' => Sex::UNKNOWN,
                    'level' => 31,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_124 => [
        [
            'id' => "0a6fea69-7a36-4c38-afe0-c3a7e6ff5e32",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Grace",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "e753ad74-429b-469d-8f5b-e50728c9c7f5",
            'class' => TrainerClass::SIS_AND_BRO,
            'name' => "Rita & Sam",
            'team' => [
                [
                    'id' => PokedexNo::CHINCHOU,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "258a2b22-9b48-46a1-a2ca-3bfed6573c9d",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Spencer",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "96f8db67-8acd-49ba-a962-be41b61795a2",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Jenny",
            'team' => [
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "ee6c0e93-7ba3-426c-8683-510215836033",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Chad",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "28b433ce-f986-4609-916f-890f3a0a0df4",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Roland",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
            ],
        ],
    ],
    LocationId::AQUA_HIDEOUT_1F => [
        [
            'id' => "d1ea13c8-8e11-4311-998e-397a642eb697",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
    ],
    LocationId::AQUA_HIDEOUT_B1F => [
        [
            'id' => "2b249710-ffb1-49ab-87aa-ae4e9a4f2301",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "d76980b5-784b-412d-aa19-973d94d0bb6e",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "3428232d-d6d7-473e-81b3-fe38287a0135",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "b6a3878b-e846-47cd-b999-b134423391d1",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
    ],
    LocationId::AQUA_HIDEOUT_B2F => [
        [
            'id' => "9ab37270-0cda-4796-95b2-8aabee5644dc",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "f2ec42d9-5ead-4ea2-a1be-03b2230b22a9",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "fbb3f014-19a6-4883-89c0-a05ca92f534a",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "1fd6536f-301b-4a01-a847-7bd7643e678b",
            'class' => TrainerClass::AQUA_ADMIN,
            'name' => "Matt",
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
    ],
    LocationId::MOSSDEEP_SPACE_CENTER => [
        [
            'id' => "1bb09064-67c2-4507-83ae-c9b4c259bd16",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "e9670e1b-cdb2-4cef-bf43-d4944be5da5c",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "df84be02-8e82-4457-9c7d-2684e55b8edc",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "4a1da106-b30c-4b85-86c6-9d7e4e959fff",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "248b5362-72d0-4e71-a5cf-e33c82fef496",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "2342a0b7-6d94-48b0-a7b9-6e1eadb72c09",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "05afa18c-a20e-4269-a98f-4f0bcf3aa03e",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::BALTOY,
                    'sex' => Sex::UNKNOWN,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "c7588656-7cf3-48e8-a827-2eb57e65299e",
            'class' => TrainerClass::MAGMA_ADMIN,
            'name' => "Tabitha",
            'team' => [
                [
                    'id' => PokedexNo::CAMERUPT,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "4ffcace0-b0bf-4774-8b76-a37e4e715469",
            'class' => TrainerClass::MAGMA_LEADER,
            'name' => "Maxie",
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::CROBAT,
                    'sex' => Sex::MALE,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::CAMERUPT,
                    'sex' => Sex::MALE,
                    'level' => 44,
                ],
            ],
        ],
    ],
    LocationId::MOSSDEEP_GYM => [
        [
            'id' => "3b089577-349e-4d98-91be-04a09bc77b51",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Preston",
            'team' => [
                [
                    'id' => PokedexNo::KIRLIA,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "c7c262aa-7362-4091-b59a-3e574930ab69",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::FEMALE,
            'name' => "Maura",
            'team' => [
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::KIRLIA,
                    'sex' => Sex::FEMALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "5869e1dd-10a9-439a-8c5e-cc11a63b5612",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::FEMALE,
            'name' => "Samantha",
            'team' => [
                [
                    'id' => PokedexNo::XATU,
                    'sex' => Sex::FEMALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "8e31a730-2beb-478f-b1bc-947497ccbe2b",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Fritz",
            'team' => [
                [
                    'id' => PokedexNo::NATU,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::GIRAFARIG,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "5421fc4a-53dc-4ef4-b6de-e3af7e541968",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Virgil",
            'team' => [
                [
                    'id' => PokedexNo::RALTS,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "b41c0a4b-afe8-40c1-9675-456d40124793",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::FEMALE,
            'name' => "Hannah",
            'team' => [
                [
                    'id' => PokedexNo::RALTS,
                    'sex' => Sex::FEMALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::KIRLIA,
                    'sex' => Sex::FEMALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "17dafbd4-82bd-4845-bd22-029c3cc7d36e",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Tate & Liza",
            'leader' => [
                'badge' => GymBadge::MIND,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/3/38/Spr_RS_Tate_and_Liza.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::LUNATONE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::SOLROCK,
                    'sex' => Sex::UNKNOWN,
                    'level' => 42,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_125 => [
        [
            'id' => "7b77e3c0-e368-41ed-b8a2-e3e6cc5e2912",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Sharon",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'sex' => Sex::FEMALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "3e481b94-779b-4880-8773-b9ac39d79921",
            'class' => TrainerClass::SAILOR,
            'name' => "Ernest",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "fd0b2c0c-f963-49a5-9c54-ce5eb6c1606a",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Tanya",
            'team' => [
                [
                    'id' => PokedexNo::LUVDISC,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "57454d80-0504-4c13-9889-6f0ddf1ff96e",
            'class' => TrainerClass::TEAMMATES,
            'name' => "Kim & Iris",
            'team' => [
                [
                    'id' => PokedexNo::SWABLU,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "451ad1a7-57a2-4c3e-82bb-ddba1e0edba7",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Stan",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "122dbff8-d1ee-4505-b013-aca0018b9fec",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Cody",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_126 => [
        [
            'id' => "d8fcd2da-4ab3-413a-a426-5d5fdab6d909",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Barry",
            'team' => [
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "24c096bf-a379-41fb-87c9-e9596fc32744",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Dean",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "48dddc25-e552-4cde-b542-8a1841beb930",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Brenda",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "ef56ada7-3547-4b53-a73c-acd1e6a5e9f8",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Nikki",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::SPHEAL,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
            ],
        ],
    ],
    LocationId::SOOTOPOLIS_GYM => [
        [
            'id' => "16543377-ae65-4348-8e7e-2698f1c1ef8f",
            'class' => TrainerClass::BEAUTY,
            'name' => "Connie",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "1586edb6-7842-4914-a999-81a56c61b744",
            'class' => TrainerClass::LASS,
            'name' => "Andrea",
            'team' => [
                [
                    'id' => PokedexNo::LUVDISC,
                    'sex' => Sex::UNKNOWN,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "8a14f7ec-35c3-4f6a-bec4-be040a513e97",
            'class' => TrainerClass::BEAUTY,
            'name' => "Bridget",
            'team' => [
                [
                    'id' => PokedexNo::AZUMARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "1fcc5967-0ebf-4cfa-97b2-91e0294f1690",
            'class' => TrainerClass::LADY,
            'name' => "Brianna",
            'team' => [
                [
                    'id' => PokedexNo::SEAKING,
                    'sex' => Sex::FEMALE,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "6b3dbfed-66e2-4e38-9a04-569aef1af090",
            'class' => TrainerClass::BEAUTY,
            'name' => "Olivia",
            'team' => [
                [
                    'id' => PokedexNo::LOMBRE,
                    'sex' => Sex::FEMALE,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "c6dc94f6-c77a-4c35-89c1-417a78c600e3",
            'class' => TrainerClass::LASS,
            'name' => "Crissy",
            'team' => [
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "0fb86c7a-b207-44f8-b62f-5111bc56032c",
            'class' => TrainerClass::BEAUTY,
            'name' => "Tiffany",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::FEMALE,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::SHARPEDO,
                    'sex' => Sex::FEMALE,
                    'level' => 39,
                ],
            ],
        ],
        [
            'id' => "4526ee1b-cb41-4383-8013-83733b93fb05",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::FEMALE,
            'name' => "Marissa",
            'team' => [
                [
                    'id' => PokedexNo::AZURILL,
                    'sex' => Sex::FEMALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::AZUMARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "39634d10-9780-4251-8a49-68a8cfa13149",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Wallace",
            'leader' => [
                'badge' => GymBadge::RAIN,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/b/b1/Spr_RS_Wallace.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::LUVDISC,
                    'sex' => Sex::FEMALE,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::WHISCASH,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::SEALEO,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_127 => [
        [
            'id' => "d122ddb1-9ac9-4803-b143-e727e37e89e1",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Byron",
            'team' => [
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "6fa3606d-3168-4400-84ab-c96d7afb485b",
            'class' => TrainerClass::TRIATHLETE,
            'gender' => Gender::FEMALE,
            'name' => "Connor",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "ac10f755-bebf-4a45-b6dd-979b87ac5c53",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Jonah",
            'team' => [
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SHARPEDO,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "278bf329-447a-4bfa-8796-22afb54dc088",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Roger",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 45,
                ],
            ],
        ],
        [
            'id' => "168dc62c-8b88-4831-8844-5686e996d6a3",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Henry",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "9cac2892-b2a8-4f4d-8eab-d96f832a1c5c",
            'class' => TrainerClass::TRIATHLETE,
            'gender' => Gender::MALE,
            'name' => "Caleb",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "8a2b0032-02e5-4036-a58f-73095417ce1d",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Koji",
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_128 => [
        [
            'id' => "315a2e9c-2b3a-46aa-8b24-896167083c96",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Ruben",
            'team' => [
                [
                    'id' => PokedexNo::SHIFTRY,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::LOUDRED,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "0928c59a-69d2-43d4-8dae-67bc92fc41a3",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Alexa",
            'team' => [
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::AZUMARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "25ba0dbd-1a7a-48b7-9160-8b5bd695c245",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Wayne",
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "30303f62-7411-4cda-9458-00f083ef5a85",
            'class' => TrainerClass::TRIATHLETE,
            'gender' => Gender::MALE,
            'name' => "Isaiah",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "3b161d4f-2619-4579-8a73-e3048bcbef4b",
            'class' => TrainerClass::TRIATHLETE,
            'gender' => Gender::FEMALE,
            'name' => "Katelyn",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 36,
                ],
            ],
        ],
    ],
    LocationId::SEAFLOOR_CAVERN => [
        [
            'id' => "68be42e3-ca7b-40d3-b873-2662ed435163",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "352e5543-0b02-4e17-9b07-48999a14f82b",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "8a2f0620-46fb-46a5-951d-677962a8352f",
            'class' => TrainerClass::TEAM_MAGMA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::NUMEL,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "95b30e31-b34b-4896-81fc-d6c20fc2d2aa",
            'class' => TrainerClass::MAGMA_ADMIN,
            'name' => "Courtney",
            'team' => [
                [
                    'id' => PokedexNo::CAMERUPT,
                    'sex' => Sex::FEMALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::FEMALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "0853c7ca-626d-4ce0-9275-d01a0a081510",
            'class' => TrainerClass::MAGMA_LEADER,
            'name' => "Maxie",
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::CROBAT,
                    'sex' => Sex::MALE,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::CAMERUPT,
                    'sex' => Sex::MALE,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "27748a73-b43e-4b8b-8c6c-3d3aae1de7aa",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "ca66a303-7fb3-4f37-a95b-af0be201475a",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "1a4394a4-798a-4468-9e57-0a02862bd6ff",
            'class' => TrainerClass::TEAM_AQUA_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::POOCHYENA,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "0478c27c-6820-495e-86d7-2dfc04ebf2eb",
            'class' => TrainerClass::AQUA_ADMIN,
            'name' => "Shelly",
            'team' => [
                [
                    'id' => PokedexNo::SHARPEDO,
                    'sex' => Sex::FEMALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::FEMALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "b8a8a8c3-3d67-44ee-a1d5-7a1ed2a31076",
            'class' => TrainerClass::AQUA_LEADER,
            'name' => "Archie",
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::CROBAT,
                    'sex' => Sex::MALE,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::SHARPEDO,
                    'sex' => Sex::MALE,
                    'level' => 43,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_129 => [
        [
            'id' => "20dcb0ff-4d59-4030-a4c5-ed275622fe4d",
            'class' => TrainerClass::TRIATHLETE,
            'gender' => Gender::FEMALE,
            'name' => "Allison",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "1b52c7f0-03b9-4b22-b59a-8e81b70deb6c",
            'class' => TrainerClass::TRIATHLETE,
            'gender' => Gender::MALE,
            'name' => "Chase",
            'team' => [
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "8b5af92b-74bd-4be7-a3b4-8782e7d61aa3",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Reed",
            'team' => [
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::CARVANHA,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::SPHEAL,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::SHARPEDO,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "562c765c-a874-4d52-b030-3bf4aa01721a",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Tisha",
            'team' => [
                [
                    'id' => PokedexNo::CHINCHOU,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::LUVDISC,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_130 => [
        [
            'id' => "2329e2ac-f3ac-434a-87da-b4bee7d989f7",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Katie",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::CHINCHOU,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::SPHEAL,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "b8168ba8-baaa-4454-9530-8fca7d76c1a3",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Rodney",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_131 => [
        [
            'id' => "e3d7363c-f5e5-4d14-9d4e-dae5ce3813ac",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Kara",
            'team' => [
                [
                    'id' => PokedexNo::SEAKING,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "3639eaa3-aabf-4d2d-a614-be63de5fdf3d",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Herman",
            'team' => [
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "c0c7e168-bf99-4d4a-b7d0-9b29966d56ce",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Susie",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::WAILMER,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "2e5d07d6-744d-4e6f-985f-2c5c4a561e85",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Richard",
            'team' => [
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "90fee3e0-8331-4b60-8bff-4e71ab759708",
            'class' => TrainerClass::SIS_AND_BRO,
            'name' => "Reli & Ian",
            'team' => [
                [
                    'id' => PokedexNo::AZUMARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_132 => [
        [
            'id' => "a1d52411-0c40-4f73-a526-aa00cea51836",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Dana",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::LUVDISC,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::AZUMARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "e65d2986-5250-4712-af97-19fe2b0ed01c",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Gilbert",
            'team' => [
                [
                    'id' => PokedexNo::SHARPEDO,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "451a8e28-37eb-4853-a803-c5ab4f5e244c",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Kiyo",
            'team' => [
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "764b0be7-ea8b-4774-b343-5e62e1b90584",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Ronald",
            'team' => [
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_133 => [
        [
            'id' => "099815a3-fa19-453f-9582-217e4f09f8b5",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Franklin",
            'team' => [
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::SEALEO,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "40da4859-66b4-4e91-9304-d506add98916",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Warren",
            'team' => [
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::MAGCARGO,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::LUDICOLO,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "97eb6b96-3e92-422f-ad61-6a805d2a0793",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Beck",
            'team' => [
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "82114700-3c45-49c9-ac12-6e9c2cd49819",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Debra",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'sex' => Sex::FEMALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "d57b9654-9651-4695-870e-96437b3f5746",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Linda",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::FEMALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::SEADRA,
                    'sex' => Sex::FEMALE,
                    'level' => 34,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_134 => [
        [
            'id' => "17622519-be75-403f-a53d-6e3d564f4b03",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::MALE,
            'name' => "Jack",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "73f2e8dc-8627-46c7-a5eb-b1ebaa08ac68",
            'class' => TrainerClass::SWIMMER,
            'gender' => Gender::FEMALE,
            'name' => "Laurel",
            'team' => [
                [
                    'id' => PokedexNo::LUVDISC,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::LUVDISC,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::LUVDISC,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "d4e0e2ef-94c3-4251-a90b-8898f712df88",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Hitoshi",
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "d250f65a-e953-4154-a4a3-d46f26de2a3d",
            'class' => TrainerClass::DRAGON_TAMER,
            'name' => "Aaron",
            'team' => [
                [
                    'id' => PokedexNo::BAGON,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "a25d7870-29e5-4af2-8e8f-ffba12b6fdc8",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Alex",
            'team' => [
                [
                    'id' => PokedexNo::NATU,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::WINGULL,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::PELIPPER,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
    ],
    LocationId::HOENN_VICTORY_ROAD_1F => [
        [
            'id' => "446c48e2-6989-450e-8d02-ae476c1da02a",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Albert",
            'team' => [
                [
                    'id' => PokedexNo::MANECTRIC,
                    'sex' => Sex::MALE,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'sex' => Sex::MALE,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "104f07cf-f8eb-453e-9276-71588661cd25",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Hope",
            'team' => [
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::FEMALE,
                    'level' => 44,
                ],
            ],
        ],
        [
            'id' => "5dd17556-e8f3-451c-99c8-8601579bfc60",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Edgar",
            'team' => [
                [
                    'id' => PokedexNo::CACTURNE,
                    'sex' => Sex::MALE,
                    'level' => 44,
                ],
            ],
        ],
    ],
    LocationId::HOENN_VICTORY_ROAD_B1F => [
        [
            'id' => "ecd15182-2170-4717-8850-2dfcb50bd612",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Shannon",
            'team' => [
                [
                    'id' => PokedexNo::CLAYDOL,
                    'sex' => Sex::UNKNOWN,
                    'level' => 44,
                ],
            ],
        ],
        [
            'id' => "1fe4f5eb-f273-4a2f-a3bf-9f0fef79d0cf",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Samuel",
            'team' => [
                [
                    'id' => PokedexNo::DODRIO,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::LAIRON,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "b89d65bf-951c-4825-80a3-f7e7b57da7bd",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Julie",
            'team' => [
                [
                    'id' => PokedexNo::SANDSLASH,
                    'sex' => Sex::FEMALE,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::NINETALES,
                    'sex' => Sex::FEMALE,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "979992e2-2026-4165-b7de-7e86281dd436",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Owen",
            'team' => [
                [
                    'id' => PokedexNo::KECLEON,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::RHYHORN,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "239bc67d-2e8e-4ba0-969a-8566330e8ad0",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Caroline",
            'team' => [
                [
                    'id' => PokedexNo::MAWILE,
                    'sex' => Sex::FEMALE,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::SABLEYE,
                    'sex' => Sex::FEMALE,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "10b36f24-670d-4014-b06b-867f290a1892",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Vito",
            'team' => [
                [
                    'id' => PokedexNo::SWELLOW,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::MANECTRIC,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::SHIFTRY,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "1fdd1d70-5aa6-4b10-b1b6-26c9876653bd",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Michelle",
            'team' => [
                [
                    'id' => PokedexNo::NOSEPASS,
                    'sex' => Sex::FEMALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::MEDICHAM,
                    'sex' => Sex::FEMALE,
                    'level' => 42,
                ],
                [
                    'id' => PokedexNo::LUDICOLO,
                    'sex' => Sex::FEMALE,
                    'level' => 42,
                ],
            ],
        ],
    ],
    LocationId::HOENN_VICTORY_ROAD_B2F => [
        [
            'id' => "d42e3fb1-6bdf-4197-9eec-b1a3fc91a33d",
            'class' => TrainerClass::POKEMON_TRAINER,
            'name' => "Wally",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/8/87/Spr_RS_Wally.png",
            'team' => [
                [
                    'id' => PokedexNo::ALTARIA,
                    'sex' => Sex::MALE,
                    'level' => 44,
                ],
                [
                    'id' => PokedexNo::DELCATTY,
                    'sex' => Sex::FEMALE,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::ROSELIA,
                    'sex' => Sex::MALE,
                    'level' => 44,
                ],
            ],
        ],
    ],
    LocationId::HOENN_POKEMON_LEAGUE => [
        [
            'id' => "7845d843-b393-4e84-9168-4bf21ad9e749",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Sidney",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/8/86/Spr_RS_Sidney.png",
            'prerequisite' => [
                'champion' => RegionId::HOENN,
            ],
            'team' => [
                [
                    'id' => PokedexNo::MIGHTYENA,
                    'sex' => Sex::MALE,
                    'level' => 46,
                ],
                [
                    'id' => PokedexNo::CACTURNE,
                    'sex' => Sex::MALE,
                    'level' => 46,
                ],
                [
                    'id' => PokedexNo::SHIFTRY,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::SHARPEDO,
                    'sex' => Sex::MALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::ABSOL,
                    'sex' => Sex::MALE,
                    'level' => 49,
                ],
            ],
        ],
        [
            'id' => "c87a71ed-f63d-4a77-bb2a-5880766d05a9",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Phoebe",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/e/e6/Spr_RS_Phoebe.png",
            'prerequisite' => [
                'champion' => RegionId::HOENN,
            ],
            'team' => [
                [
                    'id' => PokedexNo::DUSCLOPS,
                    'sex' => Sex::FEMALE,
                    'level' => 48,
                ],
                [
                    'id' => PokedexNo::BANETTE,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::BANETTE,
                    'sex' => Sex::FEMALE,
                    'level' => 49,
                ],
                [
                    'id' => PokedexNo::SABLEYE,
                    'sex' => Sex::FEMALE,
                    'level' => 50,
                ],
                [
                    'id' => PokedexNo::DUSCLOPS,
                    'sex' => Sex::FEMALE,
                    'level' => 51,
                ],
            ],
        ],
        [
            'id' => "396cff05-6033-455e-bf6a-b64fb3a2dbf9",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Glacia",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/7/71/Spr_RS_Glacia.png",
            'prerequisite' => [
                'champion' => RegionId::HOENN,
            ],
            'team' => [
                [
                    'id' => PokedexNo::GLALIE,
                    'sex' => Sex::FEMALE,
                    'level' => 50,
                ],
                [
                    'id' => PokedexNo::SEALEO,
                    'sex' => Sex::FEMALE,
                    'level' => 50,
                ],
                [
                    'id' => PokedexNo::SEALEO,
                    'sex' => Sex::FEMALE,
                    'level' => 52,
                ],
                [
                    'id' => PokedexNo::GLALIE,
                    'sex' => Sex::FEMALE,
                    'level' => 52,
                ],
                [
                    'id' => PokedexNo::WALREIN,
                    'sex' => Sex::FEMALE,
                    'level' => 53,
                ],
            ],
        ],
        [
            'id' => "72f47c8b-af0b-4434-9413-e4de5a6cb76e",
            'class' => TrainerClass::ELITE_FOUR,
            'name' => "Drake",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/0/04/Spr_RS_Drake.png",
            'prerequisite' => [
                'champion' => RegionId::HOENN,
            ],
            'team' => [
                [
                    'id' => PokedexNo::SHELGON,
                    'sex' => Sex::MALE,
                    'level' => 52,
                ],
                [
                    'id' => PokedexNo::ALTARIA,
                    'sex' => Sex::MALE,
                    'level' => 54,
                ],
                [
                    'id' => PokedexNo::FLYGON,
                    'sex' => Sex::MALE,
                    'level' => 53,
                ],
                [
                    'id' => PokedexNo::FLYGON,
                    'sex' => Sex::MALE,
                    'level' => 53,
                ],
                [
                    'id' => PokedexNo::SALAMENCE,
                    'sex' => Sex::MALE,
                    'level' => 55,
                ],
            ],
        ],
    ]
];
