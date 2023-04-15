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
    LocationId::ROUTE_27 => [
        [
            'id' => "5132dfbb-874f-4e96-8dd5-87a20303db3c",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Megan",
            'team' => [
                [
                    'id' => PokedexNo::BULBASAUR,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::IVYSAUR,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::VENUSAUR,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
            ],
        ],
        [
            'id' => "7e0ad647-766e-48b5-845e-d6120b1aadb6",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Blake",
            'team' => [
                [
                    'id' => PokedexNo::MAGNETON,
                    'sex' => Sex::UNKNOWN,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::QUAGSIRE,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::EXEGGCUTE,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "d945a142-532b-4d49-915a-74bbd5b90046",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Jose",
            'team' => [
                [
                    'id' => PokedexNo::FARFETCH_D,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "b7fc9e70-cb72-4ca0-b04d-2d933030867e",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Brian",
            'team' => [
                [
                    'id' => PokedexNo::MAREEP,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "e8e844ae-61cf-4f05-ae69-938b87a819a7",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Eli",
            'team' => [
                [
                    'id' => PokedexNo::STARMIE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::EXEGGCUTE,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::GIRAFARIG,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
        [
            'id' => "2eff8edd-1d4d-41d8-aeaf-7042af8fa0ab",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Reena",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::NIDORINA,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 36,
                ],
            ],
        ],
    ],
    LocationId::MT_SILVER_SUMMIT => [
        [
            'id' => "112a90fc-9f7e-43b4-a7f8-5cc6f451b2f1",
            'class' => TrainerClass::RETIRED_TRAINER,
            'name' => "Red",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/e/e8/Spr_HGSS_Red.png",
            'prerequisite' => [
                'champion' => Region::JOHTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'sex' => Sex::MALE,
                    'level' => 88,
                ],
                [
                    'id' => PokedexNo::LAPRAS,
                    'sex' => Sex::MALE,
                    'level' => 80,
                ],
                [
                    'id' => PokedexNo::SNORLAX,
                    'sex' => Sex::MALE,
                    'level' => 82,
                ],
                [
                    'id' => PokedexNo::VENUSAUR,
                    'sex' => Sex::MALE,
                    'level' => 84,
                ],
                [
                    'id' => PokedexNo::CHARIZARD,
                    'sex' => Sex::MALE,
                    'level' => 84,
                ],
                [
                    'id' => PokedexNo::BLASTOISE,
                    'sex' => Sex::MALE,
                    'level' => 84,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_30 => [
        [
            'id' => "48c3bada-4bc7-4629-a65c-02d18b8cd684",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Joey",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 4,
                ],
            ],
        ],
        [
            'id' => "639310e2-c854-4b6e-a95d-d4301789724e",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Mikey",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 2,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 4,
                ],
            ],
        ],
        [
            'id' => "4fa5fd79-b6e0-47a5-8828-ae7b7337345c",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Don",
            'team' => [
                [
                    'id' => PokedexNo::CATERPIE,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::CATERPIE,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_31 => [
        [
            'id' => "6f9c031b-286f-4909-95a4-a1267ac177b6",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Wade",
            'team' => [
                [
                    'id' => PokedexNo::CATERPIE,
                    'sex' => Sex::MALE,
                    'level' => 2,
                ],
                [
                    'id' => PokedexNo::CATERPIE,
                    'sex' => Sex::MALE,
                    'level' => 2,
                ],
                [
                    'id' => PokedexNo::CATERPIE,
                    'sex' => Sex::MALE,
                    'level' => 2,
                ],
                [
                    'id' => PokedexNo::WEEDLE,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
            ],
        ],
    ],
    LocationId::VIOLET_GYM => [
        [
            'id' => "ae9c5e64-d849-4acf-9aa0-546237ea236a",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Abe",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
            ],
        ],
        [
            'id' => "b9a05374-1b3f-47b2-acc4-d132d13e1808",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Rod",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
            ],
        ],
        [
            'id' => "fa8e997f-764c-49d0-8f97-56a8ae9c4b63",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Falkner",
            'leader' => [
                'badge' => GymBadge::ZEPHYR,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/2/2b/Spr_HGSS_Falkner.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'sex' => Sex::MALE,
                    'level' => 13,
                ],
            ],
        ],
    ],
    LocationId::SPROUT_TOWER_1F => [
        [
            'id' => "29ce4a16-0f3a-40fe-afb6-e84b03bac89e",
            'class' => TrainerClass::SAGE,
            'name' => "Nico",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
            ],
        ],
    ],
    LocationId::SPROUT_TOWER_2F => [
        [
            'id' => "46db15b9-61de-4a7e-89a5-fd9af53d9fe9",
            'class' => TrainerClass::SAGE,
            'name' => "Chow",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
            ],
        ],
        [
            'id' => "1f4f7dbb-8b06-4fe5-8404-f851b5a400bb",
            'class' => TrainerClass::SAGE,
            'name' => "Edmond",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 3,
                ],
            ],
        ],
    ],
    LocationId::SPROUT_TOWER_3F => [
        [
            'id' => "5994663d-6878-4b92-a2ec-04294e9d4680",
            'class' => TrainerClass::SAGE,
            'name' => "Jin",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
            ],
        ],
        [
            'id' => "1cc6d43f-3231-4cad-9fb6-687725006362",
            'class' => TrainerClass::SAGE,
            'name' => "Neal",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
            ],
        ],
        [
            'id' => "da34bb33-c5e4-43e6-bdcd-5746421c6ddd",
            'class' => TrainerClass::SAGE,
            'name' => "Troy",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::HOOTHOOT,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
            ],
        ],
        [
            'id' => "aa4adde3-4885-4470-9834-1f30bc2d9351",
            'class' => TrainerClass::ELDER,
            'name' => "Li",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/f/f3/Spr_HGSS_Li.png",
            'team' => [
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::BELLSPROUT,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::HOOTHOOT,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
            ],
        ],
    ],
];
