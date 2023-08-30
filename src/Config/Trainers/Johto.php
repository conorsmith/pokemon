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
                'victory' => RegionId::JOHTO,
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
    LocationId::ROUTE_32 => [
        [
            'id' => "9f582fe3-ce21-48f1-abf6-83c4e4685b4d",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Albert",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
            ],
        ],
        [
            'id' => "25ff8b04-1455-4f93-9ff9-bbc6fa2348f1",
            'class' => TrainerClass::PICNICKER,
            'name' => "Liz",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_F,
                    'sex' => Sex::UNKNOWN,
                    'level' => 8,
                ],
            ],
        ],
        [
            'id' => "2501bbca-41ff-4336-b081-67b9c5346175",
            'class' => TrainerClass::CAMPER,
            'name' => "Roland",
            'team' => [
                [
                    'id' => PokedexNo::NIDORAN_M,
                    'sex' => Sex::UNKNOWN,
                    'level' => 9,
                ],
            ],
        ],
        [
            'id' => "690058b4-95c3-4d99-bc98-ca0c782d216e",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Henry",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::POLIWAG,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
            ],
        ],
        [
            'id' => "59f8e390-53cd-4212-8855-5fcda9e10a34",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Justin",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 5,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 5,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 5,
                ],
            ],
        ],
        [
            'id' => "4e07aec8-9d1d-4776-b3b6-4b264f410dd5",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Ralph",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "ce3dd535-2229-4aaf-ad7e-68c9ffed62c7",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Gordon",
            'team' => [
                [
                    'id' => PokedexNo::WOOPER,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "8b9a78ac-12be-408d-b70d-0057a0bee52d",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Peter",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
            ],
        ],
    ],
    LocationId::RUINS_OF_ALPH_OUTSIDE => [
        [
            'id' => "b08da045-fb0b-4e57-817f-baf275d1f789",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Nathan",
            'team' => [
                [
                    'id' => PokedexNo::GIRAFARIG,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
    ],
    LocationId::UNION_CAVE_1F => [
        [
            'id' => "fe30967c-af58-4a81-ba10-14f272184083",
            'class' => TrainerClass::FIREBREATHER,
            'name' => "Ray",
            'team' => [
                [
                    'id' => PokedexNo::VULPIX,
                    'sex' => Sex::FEMALE,
                    'level' => 9,
                ],
            ],
        ],
        [
            'id' => "57314227-be6e-40d7-b454-dac9c7667a58",
            'class' => TrainerClass::HIKER,
            'name' => "Daniel",
            'team' => [
                [
                    'id' => PokedexNo::ONIX,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "d62277b2-eded-42eb-9450-9f0507ee9bed",
            'class' => TrainerClass::HIKER,
            'name' => "Russel",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 4,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
            ],
        ],
        [
            'id' => "e0114089-7dfc-4fcf-bc86-76b34b150eca",
            'class' => TrainerClass::FIREBREATHER,
            'name' => "Bill",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 6,
                ],
            ],
        ],
        [
            'id' => "4849c7b6-b42a-4f1b-bc35-30ee58e768f7",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Larry",
            'team' => [
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
    ],
    LocationId::UNION_CAVE_B1F => [
        [
            'id' => "657550c6-aeb0-490c-8275-8ca108f75486",
            'class' => TrainerClass::HIKER,
            'name' => "Leonard",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "2d9074d4-d41a-45bd-9668-d5638d8b7782",
            'class' => TrainerClass::HIKER,
            'name' => "Phillip",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "024c5c74-8a4c-4c60-83f2-d69e7bf8c47c",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Andrew",
            'team' => [
                [
                    'id' => PokedexNo::MAROWAK,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::MAROWAK,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "8baaf4f7-983b-4208-b14a-2db6187c8cb7",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Calvin",
            'team' => [
                [
                    'id' => PokedexNo::KANGASKHAN,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
            ],
        ],
    ],
    LocationId::UNION_CAVE_B2F => [
        [
            'id' => "e4f3f940-de3e-4a52-8244-15ee1cc87e8b",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Nick",
            'team' => [
                [
                    'id' => PokedexNo::CHARMANDER,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SQUIRTLE,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::BULBASAUR,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "78f6b45b-3661-4f8f-922f-6be72cd045d2",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Gwen",
            'team' => [
                [
                    'id' => PokedexNo::EEVEE,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::VAPOREON,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::FLAREON,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::JOLTEON,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "e7b4ac72-3033-4cda-afa2-0725df5140b8",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Emma",
            'team' => [
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'sex' => Sex::FEMALE,
                    'level' => 28,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_33 => [
        [
            'id' => "c0c42200-01c1-4e30-9bd2-a810c6f899e1",
            'class' => TrainerClass::HIKER,
            'name' => "Anthony",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
    ],
    LocationId::SLOWPOKE_WELL_B2F => [
        [
            'id' => "192bac25-6cb6-46b4-88e5-44813874fec0",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
            ],
        ],
        [
            'id' => "2892bc7b-4ee6-47dc-9cdd-6e8f65eb3d7e",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::FEMALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'sex' => Sex::FEMALE,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "8aa9622e-e74a-4ee1-a406-eb25ccdc2e9a",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
            ],
        ],
        [
            'id' => "7224e587-d77c-4fcc-98b0-b66fe0237b5e",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'name' => "Proton",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/8/8f/Spr_HGSS_Proton.png",
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
    ],
    LocationId::AZALEA_GYM => [
        [
            'id' => "2db91f43-247c-4438-b60a-46b361f58bc9",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Al",
            'team' => [
                [
                    'id' => PokedexNo::CATERPIE,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::WEEDLE,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "ece40096-4ee5-48d1-a0fa-b1aeed074453",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Benny",
            'team' => [
                [
                    'id' => PokedexNo::WEEDLE,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::KAKUNA,
                    'sex' => Sex::MALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::BEEDRILL,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "c305f50e-5a22-4d26-864e-efe53682091e",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Josh",
            'team' => [
                [
                    'id' => PokedexNo::PARAS,
                    'sex' => Sex::MALE,
                    'level' => 13,
                ],
            ],
        ],
        [
            'id' => "09448ad5-e591-4d7d-8c98-555e19f50f46",
            'class' => TrainerClass::TWINS,
            'name' => "Amy & Mimi",
            'team' => [
                [
                    'id' => PokedexNo::LEDYBA,
                    'sex' => Sex::FEMALE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::SPINARAK,
                    'sex' => Sex::FEMALE,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "b776573c-3965-4170-ae87-36b30645e1e1",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Bugsy",
            'leader' => [
                'badge' => GymBadge::HIVE,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/b/b6/Spr_HGSS_Bugsy.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::SCYTHER,
                    'sex' => Sex::FEMALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::METAPOD,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::KAKUNA,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_34 => [
        [
            'id' => "9a320c7c-54c2-42ce-8614-030a789e8758",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Samuel",
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'sex' => Sex::MALE,
                    'level' => 8,
                ],
            ],
        ],
        [
            'id' => "ca7315a4-e890-4963-9700-b74d894d9988",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::MALE,
            'name' => "Brandon",
            'team' => [
                [
                    'id' => PokedexNo::SNUBBULL,
                    'sex' => Sex::FEMALE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::MAREEP,
                    'sex' => Sex::MALE,
                    'level' => 13,
                ],
            ],
        ],
        [
            'id' => "ef50ccf2-af8c-4dc7-aed7-13b4739f942d",
            'class' => TrainerClass::PICNICKER,
            'name' => "Gina",
            'team' => [
                [
                    'id' => PokedexNo::HOPPIP,
                    'sex' => Sex::FEMALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::HOPPIP,
                    'sex' => Sex::FEMALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::BULBASAUR,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "d75bf19e-143a-4ad3-8e52-946405d49237",
            'class' => TrainerClass::YOUNGSTER,
            'name' => "Ian",
            'team' => [
                [
                    'id' => PokedexNo::MANKEY,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::DIGLETT,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "9184fc5c-fd2f-4224-b0e5-41d2be92d533",
            'class' => TrainerClass::OFFICER,
            'name' => "Keith",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "90df73d9-6680-40a3-b535-ba68340e47b2",
            'class' => TrainerClass::CAMPER,
            'name' => "Todd",
            'team' => [
                [
                    'id' => PokedexNo::PSYDUCK,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "abf73918-a2ab-47ed-a131-65d8490bd8c6",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Irene",
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'sex' => Sex::FEMALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "6bea598c-cd72-415d-b901-98220b59f751",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Jenn",
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::STARMIE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "8b48d10b-c329-45f8-a85f-b931ce97d581",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Kate",
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::CLOYSTER,
                    'sex' => Sex::FEMALE,
                    'level' => 28,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_TUNNEL_B1F => [
        [
            'id' => "3d215e78-520e-474e-ab10-fad14ae1680c",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Donald",
            'team' => [
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "4a9668f3-7b18-4845-a43e-4662e67c31a3",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Teru",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 7,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 11,
                ],
            ],
        ],
        [
            'id' => "a39f1893-cf7d-4d05-b2d4-be3ae8d3f568",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Issac",
            'team' => [
                [
                    'id' => PokedexNo::LICKITUNG,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "4bb3f198-2943-4bb2-9776-05374ff51a39",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Eric",
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_TUNNEL_B2F => [
        [
            'id' => "bf679401-c23c-41c6-8091-b82da31dfe42",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "21db28ee-810f-4190-b4a6-0f21e481aaae",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::MUK,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "a2da5894-465d-429f-a8ba-e19aebc2298e",
            'class' => TrainerClass::BURGLAR,
            'name' => "Duncan",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::MAGMAR,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "dfcccb43-3ed0-4380-b313-bef82b6daece",
            'class' => TrainerClass::BURGLAR,
            'name' => "Orson",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "b237193e-2bdb-4945-ad4a-a63a6201708f",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "f1b8f8af-5ad0-43bf-9089-e7d3c3cf310c",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_TUNNEL_WAREHOUSE => [
        [
            'id' => "b8b906ec-4f0e-496c-b9a3-244b79dc08af",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "b0344979-3448-4269-854b-2fefaab46038",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "50d71ccf-476a-49ab-bfba-c8e5abf55e58",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_RADIO_TOWER_1F => [
        [
            'id' => "27751ea9-5caf-4d5a-8766-da112b9dba53",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_RADIO_TOWER_2F => [
        [
            'id' => "0c2c3632-fbf0-4791-80a4-4db44e8d4331",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::ARBOK,
                    'sex' => Sex::FEMALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "1604ed92-14ca-4118-9d69-a1645a983f65",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "72932a88-c531-4c2e-aec0-e44bd55cf3b1",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "80aa80ab-22db-405d-8b2e-6c74653e9464",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_RADIO_TOWER_3F => [
        [
            'id' => "4c651082-fd45-4d9c-acac-e6a699d6b5e2",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "02170d45-b2ba-48f6-b556-482852f014b9",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Garett",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "e2822a7e-b767-432e-965a-73a60959c4c1",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::WEEZING,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
        [
            'id' => "9924450a-5508-4df5-8e2e-578bf0996413",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_RADIO_TOWER_4F => [
        [
            'id' => "c8d2aaa9-9ff4-4a95-a665-36d4e7cde024",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "a8131925-dc6a-4b64-9827-db158781eba5",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Trenton",
            'team' => [
                [
                    'id' => PokedexNo::PORYGON,
                    'sex' => Sex::UNKNOWN,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "8fd9ce19-bfcf-4f0b-b737-a28fb5b954ab",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::EKANS,
                    'sex' => Sex::FEMALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::EKANS,
                    'sex' => Sex::FEMALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'sex' => Sex::FEMALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "4266e83a-ec9a-4adc-8599-e770f7ccbf7c",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'name' => "Proton",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/8/8f/Spr_HGSS_Proton.png",
            'team' => [
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_RADIO_TOWER_5F => [
        [
            'id' => "30a87326-a481-485e-94df-c72a0b27c8c2",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'name' => "Petrel",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/9/96/Spr_HGSS_Petrel.png",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::WEEZING,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "c0b3092f-813b-48e0-91dc-64119491879c",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'name' => "Ariana",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/2/20/Spr_HGSS_Ariana.png",
            'team' => [
                [
                    'id' => PokedexNo::ARBOK,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::VILEPLUME,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::MURKROW,
                    'sex' => Sex::FEMALE,
                    'level' => 32,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_RADIO_TOWER_OBSERVATION_DECK => [
        [
            'id' => "a059bd40-8526-4004-a851-b5358940f42e",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'name' => "Archer",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/3/3b/Spr_HGSS_Archer.png",
            'team' => [
                [
                    'id' => PokedexNo::HOUNDOUR,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::HOUNDOOM,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
    ],
    LocationId::GOLDENROD_GYM => [
        [
            'id' => "f299aeae-4019-4423-a3b6-cdcb41bc6c29",
            'class' => TrainerClass::BEAUTY,
            'name' => "Victoria",
            'team' => [
                [
                    'id' => PokedexNo::SENTRET,
                    'sex' => Sex::FEMALE,
                    'level' => 9,
                ],
                [
                    'id' => PokedexNo::SENTRET,
                    'sex' => Sex::FEMALE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::SENTRET,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "2dfe25e3-9931-42e5-87e4-42f234cc1952",
            'class' => TrainerClass::BEAUTY,
            'name' => "Samantha",
            'team' => [
                [
                    'id' => PokedexNo::MEOWTH,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "41b1cdce-2d81-4542-9491-b81a7148f292",
            'class' => TrainerClass::LASS,
            'name' => "Carrie",
            'team' => [
                [
                    'id' => PokedexNo::SNUBBULL,
                    'sex' => Sex::FEMALE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "140fd2c5-c82b-41e3-b8f2-f3a8ae21394b",
            'class' => TrainerClass::LASS,
            'name' => "Cathy",
            'team' => [
                [
                    'id' => PokedexNo::JIGGLYPUFF,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::JIGGLYPUFF,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::JIGGLYPUFF,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "edb9b781-fdde-4ffc-8cee-b604ecfc1c82",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Whitney",
            'leader' => [
                'badge' => GymBadge::PLAIN,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/f/fc/Spr_HGSS_Whitney.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'sex' => Sex::FEMALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::MILTANK,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_35 => [
        [
            'id' => "9b39a4c1-20be-4aff-ad84-b4caefb93a1c",
            'class' => TrainerClass::PICNICKER,
            'name' => "Kim",
            'team' => [
                [
                    'id' => PokedexNo::VULPIX,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "554053fd-a081-42f8-bc09-a6f891cd7fdf",
            'class' => TrainerClass::CAMPER,
            'name' => "Elliot",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "3562ec1b-1027-442f-a0ca-4f46162a311a",
            'class' => TrainerClass::PICNICKER,
            'name' => "Brooke",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "da35cf48-81f8-4daa-bcc0-ae070bdcd9bc",
            'class' => TrainerClass::CAMPER,
            'name' => "Ivan",
            'team' => [
                [
                    'id' => PokedexNo::DIGLETT,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::DIGLETT,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
            ],
        ],
        [
            'id' => "792aba51-8b16-4cee-bbd1-31f30fe7eaac",
            'class' => TrainerClass::JUGGLER,
            'name' => "Irwin",
            'team' => [
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 2,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 6,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "81070a3c-5f08-4b28-ad47-853c925811d6",
            'class' => TrainerClass::FIREBREATHER,
            'name' => "Walt",
            'team' => [
                [
                    'id' => PokedexNo::MAGMAR,
                    'sex' => Sex::MALE,
                    'level' => 11,
                ],
                [
                    'id' => PokedexNo::MAGMAR,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "a845afe6-ccc2-41a6-91e9-c65a5e4905f9",
            'class' => TrainerClass::OFFICER,
            'name' => "Dirk",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::GROWLITHE,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "c21ea09d-50da-47be-a0c1-9ff9485f6bd2",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Arnie",
            'team' => [
                [
                    'id' => PokedexNo::VENONAT,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "8daa635f-b31e-430f-af6a-37707c30ee80",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Bryan",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
            ],
        ],
    ],
    LocationId::NATIONAL_PARK => [
        [
            'id' => "2d6a84c9-c929-4379-9093-509d1948c341",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::FEMALE,
            'name' => "Beverly",
            'team' => [
                [
                    'id' => PokedexNo::SNUBBULL,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "838749ac-3cdc-4759-a90a-93a0ed4102c8",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::MALE,
            'name' => "William",
            'team' => [
                [
                    'id' => PokedexNo::RAICHU,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "c575b520-1379-4c10-beee-87589ffe3a60",
            'class' => TrainerClass::SCHOOL_KID,
            'name' => "Jack",
            'team' => [
                [
                    'id' => PokedexNo::ODDISH,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
                [
                    'id' => PokedexNo::VOLTORB,
                    'sex' => Sex::UNKNOWN,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "cf9758e2-e633-4807-8337-9473cb3fa661",
            'class' => TrainerClass::LASS,
            'name' => "Krise",
            'team' => [
                [
                    'id' => PokedexNo::ODDISH,
                    'sex' => Sex::FEMALE,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::CUBONE,
                    'sex' => Sex::FEMALE,
                    'level' => 17,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_36 => [
        [
            'id' => "868ad733-ab0e-4ac4-bc67-fd3189229721",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Mark",
            'team' => [
                [
                    'id' => PokedexNo::ABRA,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::ABRA,
                    'sex' => Sex::MALE,
                    'level' => 14,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "2883ed00-7b8b-4c63-8784-c6aaf89bdbc9",
            'class' => TrainerClass::SCHOOL_KID,
            'name' => "Alan",
            'team' => [
                [
                    'id' => PokedexNo::TANGELA,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_37 => [
        [
            'id' => "91430a65-7700-4069-afb4-7f5fa425aee0",
            'class' => TrainerClass::TWINS,
            'name' => "Tori & Til",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::MAREEP,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "534d79e6-126f-489a-a84d-8e597f8d890b",
            'class' => TrainerClass::BEAUTY,
            'name' => "Callie",
            'team' => [
                [
                    'id' => PokedexNo::CLEFABLE,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::WIGGLYTUFF,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "760af9ab-305e-4719-ab4a-4c21bcaa409b",
            'class' => TrainerClass::BEAUTY,
            'name' => "Kassandra",
            'team' => [
                [
                    'id' => PokedexNo::WIGGLYTUFF,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::CLEFABLE,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "b00aa820-766b-44c3-9098-e3f2e94a66ec",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Greg",
            'team' => [
                [
                    'id' => PokedexNo::DROWZEE,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "4c5d24d8-7fd9-4445-b042-227479695b05",
            'class' => TrainerClass::TWINS,
            'name' => "Saya and Aya",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::MAREEP,
                    'sex' => Sex::FEMALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "f70f38c1-f7de-4ea5-bdd4-1f5e9c5c526e",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Tōru",
            'team' => [
                [
                    'id' => PokedexNo::DUNSPARCE,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
    ],
    LocationId::ECRUTEAK_GYM => [
        [
            'id' => "db671d2b-aeb0-468b-a567-4eeed8717dcc",
            'class' => TrainerClass::MEDIUM,
            'name' => "Georgina",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GASTLY,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GASTLY,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GASTLY,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GASTLY,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "38a04b44-dc84-4222-8928-4a5e084df18e",
            'class' => TrainerClass::MEDIUM,
            'name' => "Grace",
            'team' => [
                [
                    'id' => PokedexNo::HAUNTER,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::HAUNTER,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "2c495239-bc2a-46b5-9d7a-cb4410e7e113",
            'class' => TrainerClass::MEDIUM,
            'name' => "Edith",
            'team' => [
                [
                    'id' => PokedexNo::HAUNTER,
                    'sex' => Sex::FEMALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "9d23c172-3259-43c3-822a-f27fff66c8a1",
            'class' => TrainerClass::MEDIUM,
            'name' => "Martha",
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::HAUNTER,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::GASTLY,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "32703d52-68df-42e6-8a69-34461d35d084",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Morty",
            'leader' => [
                'badge' => GymBadge::FOG,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/c/ca/Spr_HGSS_Morty.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::GASTLY,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::HAUNTER,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
            ],
        ],
    ],
    LocationId::BURNED_TOWER_1F => [
        [
            'id' => "645fc7cb-eb18-4020-bd4a-59033d2180c6",
            'class' => TrainerClass::FIREBREATHER,
            'name' => "Ned",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GROWLITHE,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "5457d575-e528-4459-ac93-09d9af1cab8f",
            'class' => TrainerClass::FIREBREATHER,
            'name' => "Richard",
            'team' => [
                [
                    'id' => PokedexNo::CHARMELEON,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::ECRUTEAK_DANCE_THEATRE => [
        [
            'id' => "34e6ee72-4a8d-4521-a031-8ad48f15ee6d",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 12,
                ],
            ],
        ],
        [
            'id' => "7d87d5d3-640d-4abe-ba06-566392bd560e",
            'class' => TrainerClass::KIMONO_GIRL,
            'name' => "Zuki",
            'team' => [
                [
                    'id' => PokedexNo::UMBREON,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "85b71474-b886-4ddc-bade-493fdeed06e1",
            'class' => TrainerClass::KIMONO_GIRL,
            'name' => "Naoko",
            'team' => [
                [
                    'id' => PokedexNo::ESPEON,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "c28f580f-7a72-4964-a28a-24de4bdcfd10",
            'class' => TrainerClass::KIMONO_GIRL,
            'name' => "Miki",
            'team' => [
                [
                    'id' => PokedexNo::FLAREON,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "0060d693-f9a7-4a5a-b6ae-597af6b1da1b",
            'class' => TrainerClass::KIMONO_GIRL,
            'team' => [
                [
                    'id' => PokedexNo::JOLTEON,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "a73c9a18-b005-42d7-9981-4ca6074439c1",
            'class' => TrainerClass::KIMONO_GIRL,
            'name' => "Kuni",
            'team' => [
                [
                    'id' => PokedexNo::VAPOREON,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_38 => [
        [
            'id' => "ac9b0253-9d1f-4de6-8f48-207dd19f2973",
            'class' => TrainerClass::SAILOR,
            'name' => "Harry",
            'team' => [
                [
                    'id' => PokedexNo::WOOPER,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "f9fd8882-ceeb-408e-b9f4-add009b70297",
            'class' => TrainerClass::LASS,
            'name' => "Dana",
            'team' => [
                [
                    'id' => PokedexNo::FLAAFFY,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::PSYDUCK,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "16a9aa89-f5ef-4b93-94dc-f16a31268ada",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Toby",
            'team' => [
                [
                    'id' => PokedexNo::DODUO,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::DODUO,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::DODUO,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "9f525c44-4e8b-4596-bdfb-1c6a394621e9",
            'class' => TrainerClass::SCHOOL_KID,
            'name' => "Chad",
            'team' => [
                [
                    'id' => PokedexNo::MR_MIME,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "4187db1c-cd8b-4e2f-94c9-bb205b2becd1",
            'class' => TrainerClass::BEAUTY,
            'name' => "Valerie",
            'team' => [
                [
                    'id' => PokedexNo::HOPPIP,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::SKIPLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_39 => [
        [
            'id' => "1b44ace5-2520-4bf3-97eb-b4d03d69ca24",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Nelson",
            'team' => [
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "c20d38b5-9c3b-4912-bd41-dc6263dd8f4a",
            'class' => TrainerClass::SAILOR,
            'name' => "Eugene",
            'team' => [
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::KRABBY,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "52590090-ad43-4050-819a-553c29b36982",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::MALE,
            'name' => "Derek",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "947cab71-b87d-4a63-ae82-d85752c6ee6c",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::FEMALE,
            'name' => "Ruth",
            'team' => [
                [
                    'id' => PokedexNo::PIKACHU,
                    'sex' => Sex::FEMALE,
                    'level' => 17,
                ],
            ],
        ],
    ],
    LocationId::OLIVINE_CITY => [
        [
            'id' => "e49566f9-3bcf-46f8-aa00-0ba65ed8d6ed",
            'class' => TrainerClass::BEAUTY,
            'name' => "Charlotte",
            'team' => [
                [
                    'id' => PokedexNo::BELLOSSOM,
                    'sex' => Sex::FEMALE,
                    'level' => 16,
                ],
            ],
        ],
    ],
    LocationId::OLIVINE_GYM => [
        [
            'id' => "fe6267af-4e0f-4a91-b743-89d70de4ccaa",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Jasmine",
            'leader' => [
                'badge' => GymBadge::MINERAL,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/4/44/Spr_HGSS_Jasmine.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::STEELIX,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
            ],
        ],
    ],
    LocationId::GLITTER_LIGHTHOUSE_2F => [
        [
            'id' => "c7be64db-db5f-46fe-8ab7-9886ae284ac6",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Alfred",
            'team' => [
                [
                    'id' => PokedexNo::NOCTOWL,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "46725d9b-d8ea-47db-825d-4b997c16e9b9",
            'class' => TrainerClass::SAILOR,
            'name' => "Huey",
            'team' => [
                [
                    'id' => PokedexNo::POLIWAG,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
    ],
    LocationId::GLITTER_LIGHTHOUSE_3F => [
        [
            'id' => "fd6b3653-4591-40be-8b50-bbf8d4f8e990",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Theo",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::PIDGEY,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
        [
            'id' => "468e62d1-93f4-4654-86b1-37a4168d5dc7",
            'class' => TrainerClass::SAILOR,
            'name' => "Kent",
            'team' => [
                [
                    'id' => PokedexNo::KRABBY,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::KRABBY,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "076661fe-55ae-4690-a60f-041fe287ded3",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Denis",
            'team' => [
                [
                    'id' => PokedexNo::SPEAROW,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::FEAROW,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::SPEAROW,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::GLITTER_LIGHTHOUSE_4F => [
        [
            'id' => "6c186334-39c2-409e-ac8e-b5e676b0902e",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Preston",
            'team' => [
                [
                    'id' => PokedexNo::GROWLITHE,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::GROWLITHE,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "c92603e5-ad64-4953-b7b8-3c5a7a4beb0d",
            'class' => TrainerClass::LASS,
            'name' => "Connie",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 21,
                ],
            ],
        ],
    ],
    LocationId::GLITTER_LIGHTHOUSE_5F => [
        [
            'id' => "3ca3a704-1c14-4a51-a99c-c4ec8700bb87",
            'class' => TrainerClass::SAILOR,
            'name' => "Terrell",
            'team' => [
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "50a229cf-d02a-4458-a19c-1afb6290b53c",
            'class' => TrainerClass::SAILOR,
            'name' => "Roberto",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::POLIWHIRL,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::SS_AQUA_1F => [
        [
            'id' => "3c6d88d9-26fe-4f44-947d-06bc840e53e7",
            'class' => TrainerClass::HIKER,
            'name' => "Noland",
            'team' => [
                [
                    'id' => PokedexNo::BRONZOR,
                    'sex' => Sex::UNKNOWN,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::GOLEM,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "acfa1792-16fe-4e88-8179-cb85d7290ed3",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::MALE,
            'name' => "Colin",
            'team' => [
                [
                    'id' => PokedexNo::DELIBIRD,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "f5bf6c53-f467-4e5a-ae6f-76722870169d",
            'class' => TrainerClass::TWINS,
            'name' => "Meg & Peg",
            'team' => [
                [
                    'id' => PokedexNo::TEDDIURSA,
                    'sex' => Sex::FEMALE,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::PHANPY,
                    'sex' => Sex::FEMALE,
                    'level' => 39,
                ],
            ],
        ],
        [
            'id' => "57f69f3c-4544-479c-b39d-fddca52594ee",
            'class' => TrainerClass::FIREBREATHER,
            'name' => "Lyle",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::FLAREON,
                    'sex' => Sex::MALE,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "5b0d3aa4-6291-4326-9ffa-e10aba424c67",
            'class' => TrainerClass::SAILOR,
            'name' => "Stanly",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::PSYDUCK,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],

        [
            'id' => "9a7d71c0-dc88-4f6d-b5c4-c6fe16b9893f",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Shawn",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::MUK,
                    'sex' => Sex::MALE,
                    'level' => 41,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 39,
                ],
            ],
        ],
        [
            'id' => "5c9b8163-43c7-46c8-9d70-c20c9a452a24",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Rodney",
            'team' => [
                [
                    'id' => PokedexNo::CHINGLING,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::HYPNO,
                    'sex' => Sex::MALE,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "81bc08e6-ac07-4e83-a09c-c669827b7e7f",
            'class' => TrainerClass::BEAUTY,
            'name' => "Cassie",
            'team' => [
                [
                    'id' => PokedexNo::VILEPLUME,
                    'sex' => Sex::FEMALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::BUTTERFREE,
                    'sex' => Sex::FEMALE,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "fa0a3578-1d21-4114-827f-57c18260f815",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Shaye",
            'team' => [
                [
                    'id' => PokedexNo::JOLTEON,
                    'sex' => Sex::MALE,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::TANGELA,
                    'sex' => Sex::MALE,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::TAUROS,
                    'sex' => Sex::MALE,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "59c4d8f7-c76a-4d33-9490-ecffbfa09168",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Carol",
            'team' => [
                [
                    'id' => PokedexNo::ELECTRODE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::STARMIE,
                    'sex' => Sex::UNKNOWN,
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
            'id' => "7cf43c45-5955-4963-a0d5-22796e2d02ee",
            'class' => TrainerClass::GENTLEMAN,
            'name' => "Edward",
            'team' => [
                [
                    'id' => PokedexNo::PERSIAN,
                    'sex' => Sex::MALE,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "e1a31037-b207-449c-8c0a-813e61cf1efa",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::FEMALE,
            'name' => "Georgia",
            'team' => [
                [
                    'id' => PokedexNo::SENTRET,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::SENTRET,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::SENTRET,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
                [
                    'id' => PokedexNo::FURRET,
                    'sex' => Sex::FEMALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::SENTRET,
                    'sex' => Sex::FEMALE,
                    'level' => 31,
                ],
            ],
        ],
        [
            'id' => "384e7e41-a683-4733-86a4-d8546c4db070",
            'class' => TrainerClass::POKEFAN,
            'gender' => Gender::MALE,
            'name' => "Jeremy",
            'team' => [
                [
                    'id' => PokedexNo::MEOWTH,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::MEOWTH,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "211efc28-e897-42e9-a9f5-614f51e8b717",
            'class' => TrainerClass::GUITARIST,
            'name' => "Clyde",
            'team' => [
                [
                    'id' => PokedexNo::ELECTABUZZ,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "24ecf0fd-6bdd-4621-903a-5b35e1815370",
            'class' => TrainerClass::BUG_CATCHER,
            'name' => "Ken",
            'team' => [
                [
                    'id' => PokedexNo::ARIADOS,
                    'sex' => Sex::MALE,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::PINSIR,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "4453ee75-f303-4fcf-8a05-6fef49bf590c",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Morgan",
            'team' => [
                [
                    'id' => PokedexNo::RHYHORN,
                    'sex' => Sex::MALE,
                    'level' => 39,
                ],
                [
                    'id' => PokedexNo::RHYDON,
                    'sex' => Sex::MALE,
                    'level' => 39,
                ],
            ],
        ],
        [
            'id' => "6f4afab1-2e86-45e5-a6cc-9e9038aac59d",
            'class' => TrainerClass::BURGLAR,
            'name' => "Corey",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::MAGMAR,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
    ],
    LocationId::SS_AQUA_B1F => [
        [
            'id' => "bf545219-d44b-4342-ae47-891c6c80be3a",
            'class' => TrainerClass::JUGGLER,
            'name' => "Fritz",
            'team' => [
                [
                    'id' => PokedexNo::MR_MIME,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::MAGMAR,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "bae5ce02-8410-45c5-9f04-98b15b14db54",
            'class' => TrainerClass::SAILOR,
            'name' => "Jeff",
            'team' => [
                [
                    'id' => PokedexNo::MAKUHITA,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "056f023b-cce6-4aba-9cb3-3b2bf4affe35",
            'class' => TrainerClass::PICNICKER,
            'name' => "Debra",
            'team' => [
                [
                    'id' => PokedexNo::SEAKING,
                    'sex' => Sex::FEMALE,
                    'level' => 41,
                ],
            ],
        ],
        [
            'id' => "d795fc26-0cb7-47f3-aecc-0e3984b1ff77",
            'class' => TrainerClass::SAILOR,
            'name' => "Garrett",
            'team' => [
                [
                    'id' => PokedexNo::KINGLER,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "897bf84f-cdb6-41be-ad56-91d00c64dc7c",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Jonah",
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::OCTILLERY,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
                [
                    'id' => PokedexNo::REMORAID,
                    'sex' => Sex::MALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::CLOYSTER,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "5b3454dd-7846-4ab9-ae13-457caf3cccf2",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Wai",
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::MEDITITE,
                    'sex' => Sex::MALE,
                    'level' => 42,
                ],
            ],
        ],
        [
            'id' => "e42cda93-8f59-4b9f-9563-e2311673149a",
            'class' => TrainerClass::SAILOR,
            'name' => "Kenneth",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::POLIWRATH,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 36,
                ],
            ],
        ],
        [
            'id' => "de4f62a7-c28a-490f-9fd0-f663b5932858",
            'class' => TrainerClass::SCHOOL_KID,
            'name' => "Ricky",
            'team' => [
                [
                    'id' => PokedexNo::AIPOM,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::DITTO,
                    'sex' => Sex::UNKNOWN,
                    'level' => 40,
                ],
            ],
        ],
        [
            'id' => "470e001b-1ab4-4d27-8eda-0f241e25f917",
            'class' => TrainerClass::TEACHER,
            'name' => "Shirley",
            'team' => [
                [
                    'id' => PokedexNo::CHATOT,
                    'sex' => Sex::FEMALE,
                    'level' => 43,
                ],
                [
                    'id' => PokedexNo::JIGGLYPUFF,
                    'sex' => Sex::FEMALE,
                    'level' => 43,
                ],
            ],
        ],
        [
            'id' => "6ed75a2d-97a7-427c-8c80-622e78836910",
            'class' => TrainerClass::SCHOOL_KID,
            'name' => "Nate",
            'team' => [
                [
                    'id' => PokedexNo::LEDIAN,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
                [
                    'id' => PokedexNo::EXEGGUTOR,
                    'sex' => Sex::MALE,
                    'level' => 40,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_40 => [
        [
            'id' => "f1bb536d-b8e0-4deb-9117-d97ab6c5972e",
            'class' => TrainerClass::SWIMMER,
            'name' => "Simon",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "a612616d-fb78-447b-acd6-397979a853f4",
            'class' => TrainerClass::SWIMMER,
            'name' => "Elaine",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "c1a70574-aa0c-415a-a261-5054322614ad",
            'class' => TrainerClass::SWIMMER,
            'name' => "Paula",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'sex' => Sex::FEMALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "7bfbee0a-656e-4a9b-b713-f3a87e09806e",
            'class' => TrainerClass::SWIMMER,
            'name' => "Randall",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::WARTORTLE,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::SHELLDER,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_41 => [
        [
            'id' => "ba39ba46-1c54-48a4-bf07-d2cb135fd652",
            'class' => TrainerClass::SWIMMER,
            'name' => "Charlie",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::TENTACRUEL,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "3c2a5053-ce5e-41ad-98d7-3a80e5094ba9",
            'class' => TrainerClass::SWIMMER,
            'name' => "George",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::TENTACOOL,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::REMORAID,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "e186c528-1065-477f-9a01-ad07e495745e",
            'class' => TrainerClass::SWIMMER,
            'name' => "Susie",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::PSYDUCK,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "3af94375-0949-4708-aaeb-f51a9de71189",
            'class' => TrainerClass::SWIMMER,
            'name' => "Kaylee",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "bc55faf4-76b0-4f45-bf59-44e114cccca0",
            'class' => TrainerClass::SWIMMER,
            'name' => "Matthew",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::KRABBY,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "3d1d9d93-9bad-4d38-a591-36674562be97",
            'class' => TrainerClass::SWIMMER,
            'name' => "Wendy",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::FEMALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::FEMALE,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "df637063-bcc2-43b1-8c00-b82cb58c9b03",
            'class' => TrainerClass::SWIMMER,
            'name' => "Berke",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::QWILFISH,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
            ],
        ],
        [
            'id' => "f3952967-80c2-4d4b-be55-c9291a63944f",
            'class' => TrainerClass::SWIMMER,
            'name' => "Kara",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::STARYU,
                    'sex' => Sex::UNKNOWN,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::STARMIE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "4746e1ad-e68a-4f6c-8b58-f191209132d7",
            'class' => TrainerClass::SWIMMER,
            'name' => "Ronald",
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "daef957d-5644-4565-8170-5e4738388587",
            'class' => TrainerClass::SWIMMER,
            'name' => "Denise",
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::SEEL,
                    'sex' => Sex::FEMALE,
                    'level' => 22,
                ],
            ],
        ],
    ],
    LocationId::CIANWOOD_CITY => [
        [
            'id' => "86598f4b-79c7-4a9a-814a-95359bd0ff86",
            'class' => TrainerClass::MYSTICALMAN,
            'name' => "Eusine",
            'team' => [
                [
                    'id' => PokedexNo::DROWZEE,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::HAUNTER,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::ELECTRODE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 27,
                ],
            ],
        ],
    ],
    LocationId::CIANWOOD_GYM => [
        [
            'id' => "98daf23e-20b5-4893-8936-9d0b33ca6ae9",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Yoshi",
            'team' => [
                [
                    'id' => PokedexNo::HITMONLEE,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "65e35205-5944-41a1-a623-68c76a7b9f90",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Lao",
            'team' => [
                [
                    'id' => PokedexNo::HITMONCHAN,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "96d6ba08-88ec-4cf8-bc4f-f3861ee7c838",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Nob",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "0e0ac645-32b6-4332-839e-d217c9244759",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Lung",
            'team' => [
                [
                    'id' => PokedexNo::MANKEY,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::MANKEY,
                    'sex' => Sex::MALE,
                    'level' => 23,
                ],
                [
                    'id' => PokedexNo::PRIMEAPE,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "1e2908fd-0ae1-446f-b676-321b0f87c47e",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Chuck",
            'leader' => [
                'badge' => GymBadge::STORM,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/f/fd/Spr_HGSS_Chuck.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::PRIMEAPE,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::POLIWRATH,
                    'sex' => Sex::MALE,
                    'level' => 31,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_47 => [
        [
            'id' => "0c54b8f2-c157-405c-b402-e32f778f44d0",
            'class' => TrainerClass::HIKER,
            'name' => "Devin",
            'team' => [
                [
                    'id' => PokedexNo::DUNSPARCE,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::DUNSPARCE,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
                [
                    'id' => PokedexNo::DUNSPARCE,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "75d59813-f60b-4cb0-80a6-8a24e21c68d8",
            'class' => TrainerClass::CAMPER,
            'name' => "Grant",
            'team' => [
                [
                    'id' => PokedexNo::SKIPLOOM,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::MALE,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "41cc05ad-a20d-4b9b-8978-05819e90b88c",
            'class' => TrainerClass::DOUBLE_TEAM,
            'name' => "Thom & Kae",
            'team' => [
                [
                    'id' => PokedexNo::MAGMAR,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::ELECTABUZZ,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "81ec3f95-a73d-4d6e-b211-566b026e2142",
            'class' => TrainerClass::YOUNG_COUPLE,
            'name' => "Duff & Eda",
            'team' => [
                [
                    'id' => PokedexNo::CLOYSTER,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::ONIX,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_42 => [
        [
            'id' => "813356ce-2933-403e-90db-a181aabf0dd0",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Tully",
            'team' => [
                [
                    'id' => PokedexNo::QWILFISH,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "778f1210-9a14-4fd4-9540-4751c3352129",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Shane",
            'team' => [
                [
                    'id' => PokedexNo::NIDORINA,
                    'sex' => Sex::FEMALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::NIDORINO,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "d1767a48-ab2b-4f22-9585-7da7d98ad514",
            'class' => TrainerClass::HIKER,
            'name' => "Benjamin",
            'team' => [
                [
                    'id' => PokedexNo::DIGLETT,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
                [
                    'id' => PokedexNo::DUGTRIO,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
            ],
        ],
    ],
    LocationId::MT_MORTAR_1F_ENTRANCE => [
        [
            'id' => "d8819afe-c5bc-45b1-816b-8b899ba1c7c9",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Harrison",
            'team' => [
                [
                    'id' => PokedexNo::NIDOKING,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::NIDOQUEEN,
                    'sex' => Sex::FEMALE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "173f9538-ee91-462d-baa8-0ac702d2d4e2",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Markus",
            'team' => [
                [
                    'id' => PokedexNo::SLOWPOKE,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
    ],
    LocationId::MT_MORTAR_2F => [
        [
            'id' => "3cb72ffc-02f3-467d-bc30-0f628ae2a5b7",
            'class' => TrainerClass::SUPER_NERD,
            'name' => "Hugh",
            'team' => [
                [
                    'id' => PokedexNo::SEADRA,
                    'sex' => Sex::MALE,
                    'level' => 39,
                ],
            ],
        ],
    ],
    LocationId::MT_MORTAR_B1F => [
        [
            'id' => "64edd8b1-68ae-4c4c-8b85-7c349319749e",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Kiyo",
            'team' => [
                [
                    'id' => PokedexNo::HITMONLEE,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
                [
                    'id' => PokedexNo::HITMONCHAN,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
    ],
    LocationId::MAHOGANY_GYM => [
        [
            'id' => "1ddda37b-46f2-4f56-9547-01633df97f44",
            'class' => TrainerClass::SKIER,
            'name' => "Diana",
            'team' => [
                [
                    'id' => PokedexNo::JYNX,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "ad075a01-d29e-4cb5-8267-443d17943eac",
            'class' => TrainerClass::BOARDER,
            'name' => "Patton",
            'team' => [
                [
                    'id' => PokedexNo::SWINUB,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::SWINUB,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "c764b074-ca51-4b07-99ee-48eb414f482e",
            'class' => TrainerClass::BOARDER,
            'name' => "Deandre",
            'team' => [
                [
                    'id' => PokedexNo::SEEL,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::DEWGONG,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SEEL,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "cf66c55a-4a9f-4a57-a369-4abf32c0a7cf",
            'class' => TrainerClass::SKIER,
            'name' => "Jill",
            'team' => [
                [
                    'id' => PokedexNo::DEWGONG,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "7278f621-95e7-427c-8724-3e19d2899797",
            'class' => TrainerClass::BOARDER,
            'name' => "Gerardo",
            'team' => [
                [
                    'id' => PokedexNo::SHELLDER,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::CLOYSTER,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SEEL,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "033b43c5-ea94-4a9d-ad77-fd409840600a",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Pryce",
            'leader' => [
                'badge' => GymBadge::GLACIER,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/4/43/Spr_HGSS_Pryce.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::SEEL,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
                [
                    'id' => PokedexNo::DEWGONG,
                    'sex' => Sex::MALE,
                    'level' => 32,
                ],
                [
                    'id' => PokedexNo::PILOSWINE,
                    'sex' => Sex::MALE,
                    'level' => 34,
                ],
            ],
        ],
    ],
    LocationId::TEAM_ROCKET_HQ_B1F => [
        [
            'id' => "e7e0c20a-62ae-4ec1-a5fe-b18603028254",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
            ],
        ],
        [
            'id' => "e04d1a96-5e06-46cb-87ae-6fef4c3daa97",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Gregg",
            'team' => [
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "d6f5469e-fcb0-431b-8147-df0a7ff4d989",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::DROWZEE,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "f09d07da-7fda-4179-9ea1-6907fa65c872",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 16,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
    ],
    LocationId::TEAM_ROCKET_HQ_B2F => [
        [
            'id' => "384d67f9-30a5-4347-8f84-0b3b94054afb",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::VENONAT,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::VENONAT,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "7bf9017e-a050-4c6d-bc49-c089db8301ac",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::GOLBAT,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "efc623a6-4b08-4569-9c1e-4a9da84a1eaa",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::RATTATA,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "cc5a37ca-d0e7-434b-90b3-24b947a6cb47",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'name' => "Ariana",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/2/20/Spr_HGSS_Ariana.png",
            'team' => [
                [
                    'id' => PokedexNo::ARBOK,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::MURKROW,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::DROWZEE,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::GRIMER,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
    ],
    LocationId::TEAM_ROCKET_HQ_B3F => [
        [
            'id' => "1fa643fd-9c34-4ee7-8347-4e4eadeef39a",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Ross",
            'team' => [
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "f9a71012-af4a-4f89-995b-fa4eff5cabaf",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::FEMALE,
            'team' => [
                [
                    'id' => PokedexNo::EKANS,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::GLOOM,
                    'sex' => Sex::FEMALE,
                    'level' => 18,
                ],
            ],
        ],
        [
            'id' => "2c3ec731-ebf2-4fb5-8647-1777d72c098c",
            'class' => TrainerClass::SCIENTIST,
            'name' => "Mitch",
            'team' => [
                [
                    'id' => PokedexNo::DITTO,
                    'sex' => Sex::UNKNOWN,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "34a3934c-8a1c-4319-a9da-0386ec160bfc",
            'class' => TrainerClass::TEAM_ROCKET_GRUNT,
            'gender' => Gender::MALE,
            'team' => [
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 19,
                ],
            ],
        ],
        [
            'id' => "beca3a8f-dfa6-450f-a609-467f19c18b72",
            'class' => TrainerClass::TEAM_ROCKET_ADMIN,
            'name' => "Petrel",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/9/96/Spr_HGSS_Petrel.png",
            'team' => [
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::KOFFING,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::RATICATE,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_43 => [
        [
            'id' => "93fd47dc-952a-4757-ac62-373d53c542a2",
            'class' => TrainerClass::CAMPER,
            'name' => "Spencer",
            'team' => [
                [
                    'id' => PokedexNo::SANDSHREW,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::SANDSLASH,
                    'sex' => Sex::MALE,
                    'level' => 18,
                ],
                [
                    'id' => PokedexNo::ZUBAT,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "126c7046-8ba7-4f43-8501-9275144eef8c",
            'class' => TrainerClass::PICNICKER,
            'name' => "Tiffany",
            'team' => [
                [
                    'id' => PokedexNo::CLEFAIRY,
                    'sex' => Sex::FEMALE,
                    'level' => 21,
                ],
            ],
        ],
        [
            'id' => "6523a587-a7bb-4973-92af-3134bf6e7610",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Brent",
            'team' => [
                [
                    'id' => PokedexNo::NIDORINA,
                    'sex' => Sex::FEMALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::NIDORINO,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "0a080b8f-4321-4984-a1a3-9c75ac4eb67e",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Beckett",
            'team' => [
                [
                    'id' => PokedexNo::SLOWBRO,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "7e0cd031-ba63-4918-9c69-9f77ef89728f",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Ron",
            'team' => [
                [
                    'id' => PokedexNo::NIDOKING,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
            ],
        ],
        [
            'id' => "d87b49b6-171e-49f8-9962-4b33496a5b0c",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Marvin",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 10,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 20,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 15,
                ],
            ],
        ],
    ],
    LocationId::LAKE_OF_RAGE => [
        [
            'id' => "f584b3d5-99b1-45db-acce-82a07db2368c",
            'class' => TrainerClass::RETIRED_TRAINER,
            'name' => "Lance",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/1/1f/Spr_HGSS_Lance.png",
            'prerequisite' => [
                'victory' => RegionId::JOHTO,
            ],
            'team' => [
                [
                    'id' => PokedexNo::SALAMENCE,
                    'sex' => Sex::MALE,
                    'level' => 72,
                ],
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 68,
                ],
                [
                    'id' => PokedexNo::GARCHOMP,
                    'sex' => Sex::MALE,
                    'level' => 72,
                ],
                [
                    'id' => PokedexNo::ALTARIA,
                    'sex' => Sex::MALE,
                    'level' => 73,
                ],
                [
                    'id' => PokedexNo::CHARIZARD,
                    'sex' => Sex::MALE,
                    'level' => 68,
                ],
                [
                    'id' => PokedexNo::DRAGONITE,
                    'sex' => Sex::MALE,
                    'level' => 75,
                ],
            ],
        ],
        [
            'id' => "8ced76e6-5ed4-4b7c-a94f-74803f623d42",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Andre",
            'team' => [
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "b2e4f9c7-a586-48c2-9111-c3365f4a7c9f",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Raymond",
            'team' => [
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
                [
                    'id' => PokedexNo::MAGIKARP,
                    'sex' => Sex::MALE,
                    'level' => 22,
                ],
            ],
        ],
        [
            'id' => "e399f4b8-1636-4405-982c-40cadeda4734",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Lois",
            'team' => [
                [
                    'id' => PokedexNo::MAREEP,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::NINETALES,
                    'sex' => Sex::FEMALE,
                    'level' => 25,
                ],
            ],
        ],
        [
            'id' => "ecb0e108-971b-4c18-a75a-03066f632cdc",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Alton",
            'team' => [
                [
                    'id' => PokedexNo::IVYSAUR,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::CHARMELEON,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::WARTORTLE,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_44 => [
        [
            'id' => "dc202575-809a-480d-a0e6-9ff6977ab8ec",
            'class' => TrainerClass::PSYCHIC,
            'gender' => Gender::MALE,
            'name' => "Phil",
            'team' => [
                [
                    'id' => PokedexNo::NATU,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::KADABRA,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "55a99eeb-02f6-4a82-aa1e-21e7553d7ed6",
            'class' => TrainerClass::FISHERMAN,
            'name' => "Edgar",
            'team' => [
                [
                    'id' => PokedexNo::REMORAID,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::REMORAID,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "052b29fc-9bf4-4058-bb04-80925cce6b1a",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Cybil",
            'team' => [
                [
                    'id' => PokedexNo::MAREEP,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::BELLOSSOM,
                    'sex' => Sex::FEMALE,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "fbb0bfb4-5c3f-4c2c-aed2-5bb4c2f8ae3b",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Allen",
            'team' => [
                [
                    'id' => PokedexNo::CHARMELEON,
                    'sex' => Sex::MALE,
                    'level' => 29,
                ],
                [
                    'id' => PokedexNo::MAGNEMITE,
                    'sex' => Sex::UNKNOWN,
                    'level' => 29,
                ],
            ],
        ],
        [
            'id' => "2632e8c1-3329-468b-914a-48def9299552",
            'class' => TrainerClass::POKEMANIAC,
            'name' => "Zach",
            'team' => [
                [
                    'id' => PokedexNo::RHYHORN,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "a18e1a4a-2539-4441-a9fd-6557903c9de3",
            'class' => TrainerClass::FISHERMAN,
            'team' => [
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::GOLDEEN,
                    'sex' => Sex::MALE,
                    'level' => 26,
                ],
                [
                    'id' => PokedexNo::SEAKING,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "eaabd30c-06e4-412a-a236-0536c623114c",
            'class' => TrainerClass::BIRD_KEEPER,
            'name' => "Vance",
            'team' => [
                [
                    'id' => PokedexNo::HOOTHOOT,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
                [
                    'id' => PokedexNo::PIDGEOTTO,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
    ],
    LocationId::BLACKTHORN_GYM => [
        [
            'id' => "e1bc4808-13bc-4e93-9436-22de0193c2a6",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Paulo",
            'team' => [
                [
                    'id' => PokedexNo::DRATINI,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::DRATINI,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::SEADRA,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "cc8af498-fb03-40eb-b24d-ffe95b56d75d",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Lola",
            'team' => [
                [
                    'id' => PokedexNo::DRATINI,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::DRAGONAIR,
                    'sex' => Sex::FEMALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "7c2697ab-af00-488d-8f90-70d08f15e070",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Cody",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::MALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::SEADRA,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "da3e7945-eb63-412a-9403-b9fd740189c2",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Fran",
            'team' => [
                [
                    'id' => PokedexNo::SEADRA,
                    'sex' => Sex::FEMALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "e6d4de02-804f-4200-afd5-5599f3f2f559",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Mike",
            'team' => [
                [
                    'id' => PokedexNo::DRAGONAIR,
                    'sex' => Sex::MALE,
                    'level' => 38,
                ],
            ],
        ],
        [
            'id' => "d5c45b0a-7cd0-4043-8f77-e3546b59696d",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Clair",
            'leader' => [
                'badge' => GymBadge::RISING,
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/d/d7/Spr_HGSS_Clair.png",
            ],
            'team' => [
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::FEMALE,
                    'level' => 38,
                ],
                [
                    'id' => PokedexNo::DRAGONAIR,
                    'sex' => Sex::FEMALE,
                    'level' => 38,
                ],
            ],
        ],
    ],
    LocationId::DRAGONS_DEN => [
        [
            'id' => "dba54bb0-3bfa-4297-af16-a652195aa890",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Kobe",
            'team' => [
                [
                    'id' => PokedexNo::DRAGONAIR,
                    'sex' => Sex::MALE,
                    'level' => 37,
                ],
            ],
        ],
        [
            'id' => "4149597e-42a6-47fb-b1c5-684af19255ac",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Piper",
            'team' => [
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::HORSEA,
                    'sex' => Sex::FEMALE,
                    'level' => 33,
                ],
                [
                    'id' => PokedexNo::SEADRA,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "20cf1d07-3158-4023-9945-9cda3fe2905e",
            'class' => TrainerClass::TWINS,
            'name' => "Clea & Gil",
            'team' => [
                [
                    'id' => PokedexNo::DRATINI,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
                [
                    'id' => PokedexNo::DRATINI,
                    'sex' => Sex::FEMALE,
                    'level' => 35,
                ],
            ],
        ],
        [
            'id' => "f697ceaf-4de9-4b07-bbb9-9178fbbfef1d",
            'class' => TrainerClass::GYM_LEADER,
            'name' => "Clair",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/d/d7/Spr_HGSS_Clair.png",
            'team' => [
                [
                    'id' => PokedexNo::DRAGONAIR,
                    'sex' => Sex::FEMALE,
                    'level' => 52,
                ],
                [
                    'id' => PokedexNo::KINGDRA,
                    'sex' => Sex::FEMALE,
                    'level' => 56,
                ],
                [
                    'id' => PokedexNo::DRAGONITE,
                    'sex' => Sex::FEMALE,
                    'level' => 60,
                ],
            ],
        ],
        [
            'id' => "1bc9ef4a-321d-43f4-8664-954c2c3f4e9a",
            'class' => TrainerClass::POKEMON_TRAINER,
            'name' => "Lance",
            'imageUrl' => "https://archives.bulbagarden.net/media/upload/1/1f/Spr_HGSS_Lance.png",
            'team' => [
                [
                    'id' => PokedexNo::GYARADOS,
                    'sex' => Sex::MALE,
                    'level' => 68,
                ],
                [
                    'id' => PokedexNo::CHARIZARD,
                    'sex' => Sex::MALE,
                    'level' => 68,
                ],
                [
                    'id' => PokedexNo::DRAGONITE,
                    'sex' => Sex::MALE,
                    'level' => 75,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_45 => [
        [
            'id' => "a3dc949b-f6fe-466b-8eb4-20cb2e608b3f",
            'class' => TrainerClass::HIKER,
            'name' => "Erik",
            'team' => [
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::MACHOP,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "f9b1f212-d6ef-4f99-852b-9d99882cf62d",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::MALE,
            'name' => "Ryan",
            'team' => [
                [
                    'id' => PokedexNo::PIDGEOT,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::ELECTABUZZ,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "c809d55f-40d6-494e-b918-433791d5bd4a",
            'class' => TrainerClass::COOLTRAINER,
            'gender' => Gender::FEMALE,
            'name' => "Kelly",
            'team' => [
                [
                    'id' => PokedexNo::MARILL,
                    'sex' => Sex::FEMALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::WARTORTLE,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
                [
                    'id' => PokedexNo::WARTORTLE,
                    'sex' => Sex::MALE,
                    'level' => 24,
                ],
            ],
        ],
        [
            'id' => "fa82503f-9bc3-4def-82c2-c2ea2f2f59d3",
            'class' => TrainerClass::HIKER,
            'name' => "Parry",
            'team' => [
                [
                    'id' => PokedexNo::ONIX,
                    'sex' => Sex::MALE,
                    'level' => 30,
                ],
            ],
        ],
        [
            'id' => "059351f5-ce1e-4fdf-917f-37dbaa77c811",
            'class' => TrainerClass::BLACK_BELT,
            'name' => "Kenji",
            'team' => [
                [
                    'id' => PokedexNo::MACHOKE,
                    'sex' => Sex::MALE,
                    'level' => 28,
                ],
            ],
        ],
        [
            'id' => "2bdb7a76-65a7-45bf-8430-6cf97678909e",
            'class' => TrainerClass::HIKER,
            'name' => "Timothy",
            'team' => [
                [
                    'id' => PokedexNo::DIGLETT,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
                [
                    'id' => PokedexNo::DUGTRIO,
                    'sex' => Sex::MALE,
                    'level' => 27,
                ],
            ],
        ],
        [
            'id' => "909716ff-a824-4d46-896c-c3321ca9e7c7",
            'class' => TrainerClass::HIKER,
            'name' => "Michael",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GRAVELER,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
                [
                    'id' => PokedexNo::GOLEM,
                    'sex' => Sex::MALE,
                    'level' => 25,
                ],
            ],
        ],
    ],
    LocationId::ROUTE_46 => [
        [
            'id' => "8f8c43bb-edc3-42c2-aea3-ec9f6211e43f",
            'class' => TrainerClass::CAMPER,
            'name' => "Ted",
            'team' => [
                [
                    'id' => PokedexNo::MANKEY,
                    'sex' => Sex::MALE,
                    'level' => 17,
                ],
            ],
        ],
        [
            'id' => "8e4ece82-dd88-431a-85a1-a047efa39987",
            'class' => TrainerClass::PICNICKER,
            'name' => "Erin",
            'team' => [
                [
                    'id' => PokedexNo::PONYTA,
                    'sex' => Sex::FEMALE,
                    'level' => 17,
                ],
                [
                    'id' => PokedexNo::ODDISH,
                    'sex' => Sex::FEMALE,
                    'level' => 14,
                ],
            ],
        ],
        [
            'id' => "f5266292-b664-40bf-8d0a-3a135da9eb21",
            'class' => TrainerClass::HIKER,
            'name' => "Bailey",
            'team' => [
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 13,
                ],
                [
                    'id' => PokedexNo::GEODUDE,
                    'sex' => Sex::MALE,
                    'level' => 13,
                ],
            ],
        ],
    ],
];
