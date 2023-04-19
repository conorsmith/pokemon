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
];
