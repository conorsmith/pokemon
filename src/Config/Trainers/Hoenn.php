<?php
declare(strict_types=1);

use ConorSmith\Pokemon\Gender;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\Region;

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
];
