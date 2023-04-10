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
    LocationId::ROUTE_26 => [
        [
            'id' => "48c10c96-8aac-4c60-bfee-fc6a0d725996",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Scott",
            'team' => [
                [
                    'id' => PokedexNo::QWILFISH,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::QWILFISH,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "70abaf21-0bf5-444b-9ea2-7c3b543071cc",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Vernon",
            'team' => [
                [
                    'id' => PokedexNo::ESPEON,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "fdb80abd-5a33-447c-b963-3f91438268fe",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Joyce",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'sex' => Sex::FEMALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::BLASTOISE,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "d1955cad-e49d-48a2-b848-f3f1e279ac23",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Gaven",
            'team' => [
                [
                    'id' => PokedexNo::VICTREEBEL,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::KINGLER,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::FLAREON,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "e4628fdb-841a-47e7-bf0a-b9fa1031995e",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Jake",
            'team' => [
                [
                    'id' => PokedexNo::PARASECT,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::GOLDUCK,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::VAPOREON,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
            ],
        ],
        [
            'id' => "98b91262-bacf-4a6c-b171-0ed1746afcbd",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Jamie",
            'team' => [
                [
                    'id' => PokedexNo::RAPIDASH,
                    'sex' => Sex::FEMALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::FLAAFFY,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
            ],
        ],
    ],

];
