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
];
