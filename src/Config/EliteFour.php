<?php
declare(strict_types=1);

use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use ConorSmith\Pokemon\TrainerClass;

return [
    [
        'region' => Region::KANTO,
        'location' => LocationId::KANTO_LEAGUE_CHAMBER,
        'members' => [
            [
                'id' => "e06b0584-3f6d-47ce-a100-fab5b75e62b5",
                'class' => TrainerClass::ELITE_FOUR,
                'name' => "Lorelei",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/d/db/Spr_FRLG_Lorelei.png",
                'team' => [
                    [
                        'id' => PokedexNo::DEWGONG,
                        'sex' => Sex::FEMALE,
                        'level' => 52,
                    ],
                    [
                        'id' => PokedexNo::CLOYSTER,
                        'sex' => Sex::FEMALE,
                        'level' => 51,
                    ],
                    [
                        'id' => PokedexNo::SLOWBRO,
                        'sex' => Sex::FEMALE,
                        'level' => 52,
                    ],
                    [
                        'id' => PokedexNo::JYNX,
                        'sex' => Sex::FEMALE,
                        'level' => 54,
                    ],
                    [
                        'id' => PokedexNo::LAPRAS,
                        'sex' => Sex::FEMALE,
                        'level' => 54,
                    ],
                ],
            ],
            [
                'id' => "953eaf1b-2687-466e-9b76-e33593983c5f",
                'class' => TrainerClass::ELITE_FOUR,
                'name' => "Bruno",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/f/f7/Spr_FRLG_Bruno.png",
                'team' => [
                    [
                        'id' => PokedexNo::ONIX,
                        'sex' => Sex::MALE,
                        'level' => 51,
                    ],
                    [
                        'id' => PokedexNo::HITMONCHAN,
                        'sex' => Sex::MALE,
                        'level' => 53,
                    ],
                    [
                        'id' => PokedexNo::HITMONLEE,
                        'sex' => Sex::MALE,
                        'level' => 53,
                    ],
                    [
                        'id' => PokedexNo::ONIX,
                        'sex' => Sex::MALE,
                        'level' => 54,
                    ],
                    [
                        'id' => PokedexNo::MACHAMP,
                        'sex' => Sex::MALE,
                        'level' => 56,
                    ],
                ],
            ],
            [
                'id' => "4914b631-3a0f-4c1e-9f5e-d79fc1c89766",
                'class' => TrainerClass::ELITE_FOUR,
                'name' => "Agatha",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/5/56/Spr_FRLG_Agatha.png",
                'team' => [
                    [
                        'id' => PokedexNo::GENGAR,
                        'sex' => Sex::FEMALE,
                        'level' => 54,
                    ],
                    [
                        'id' => PokedexNo::GOLBAT,
                        'sex' => Sex::FEMALE,
                        'level' => 54,
                    ],
                    [
                        'id' => PokedexNo::HAUNTER,
                        'sex' => Sex::FEMALE,
                        'level' => 53,
                    ],
                    [
                        'id' => PokedexNo::ARBOK,
                        'sex' => Sex::FEMALE,
                        'level' => 56,
                    ],
                    [
                        'id' => PokedexNo::GENGAR,
                        'sex' => Sex::FEMALE,
                        'level' => 58,
                    ],
                ],
            ],
            [
                'id' => "88ae33b2-4d65-434f-ba7b-048f2970832f",
                'class' => TrainerClass::ELITE_FOUR,
                'name' => "Lance",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/f/fb/Spr_FRLG_Lance.png",
                'team' => [
                    [
                        'id' => PokedexNo::GYARADOS,
                        'sex' => Sex::MALE,
                        'level' => 56,
                    ],
                    [
                        'id' => PokedexNo::DRAGONAIR,
                        'sex' => Sex::MALE,
                        'level' => 54,
                    ],
                    [
                        'id' => PokedexNo::DRAGONAIR,
                        'sex' => Sex::MALE,
                        'level' => 54,
                    ],
                    [
                        'id' => PokedexNo::AERODACTYL,
                        'sex' => Sex::MALE,
                        'level' => 58,
                    ],
                    [
                        'id' => PokedexNo::DRAGONITE,
                        'sex' => Sex::MALE,
                        'level' => 60,
                    ],
                ],
            ],
            [
                'id' => "9555cae4-9c11-44ca-aca2-40ad4f9584af",
                'class' => TrainerClass::CHAMPION,
                'name' => "Blue",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/1/10/Spr_FRLG_Blue_3.png",
                'team' => [
                    [
                        'id' => PokedexNo::PIDGEOT,
                        'sex' => Sex::MALE,
                        'level' => 59,
                    ],
                    [
                        'id' => PokedexNo::ALAKAZAM,
                        'sex' => Sex::MALE,
                        'level' => 57,
                    ],
                    [
                        'id' => PokedexNo::RHYDON,
                        'sex' => Sex::MALE,
                        'level' => 59,
                    ],
                    [
                        'id' => PokedexNo::EXEGGUTOR,
                        'sex' => Sex::MALE,
                        'level' => 63,
                    ],
                    [
                        'id' => PokedexNo::GYARADOS,
                        'sex' => Sex::MALE,
                        'level' => 63,
                    ],
                    [
                        'id' => PokedexNo::ARCANINE,
                        'sex' => Sex::MALE,
                        'level' => 63,
                    ],
                ],
            ],
        ],
    ],
    [
        'region' => Region::JOHTO,
        'location' => LocationId::JOHTO_LEAGUE_CHAMBER,
        'members' => [
            [
                'id' => "c4b69d52-a5f2-4a5f-b1fc-8fb373dda796",
                'class' => TrainerClass::ELITE_FOUR,
                'name' => "Will",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/f/fd/Spr_HGSS_Will.png",
                'team' => [
                    [
                        'id' => PokedexNo::XATU,
                        'sex' => Sex::FEMALE,
                        'level' => 40,
                    ],
                    [
                        'id' => PokedexNo::JYNX,
                        'sex' => Sex::FEMALE,
                        'level' => 41,
                    ],
                    [
                        'id' => PokedexNo::SLOWBRO,
                        'sex' => Sex::FEMALE,
                        'level' => 41,
                    ],
                    [
                        'id' => PokedexNo::EXEGGUTOR,
                        'sex' => Sex::FEMALE,
                        'level' => 41,
                    ],
                    [
                        'id' => PokedexNo::XATU,
                        'sex' => Sex::FEMALE,
                        'level' => 42,
                    ],
                ],
            ],
            [
                'id' => "d0bb3d94-545b-47ed-9bca-49806508e80f",
                'class' => TrainerClass::ELITE_FOUR,
                'name' => "Koga",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/1/18/Spr_HGSS_Koga.png",
                'team' => [
                    [
                        'id' => PokedexNo::ARIADOS,
                        'sex' => Sex::MALE,
                        'level' => 40,
                    ],
                    [
                        'id' => PokedexNo::FORRETRESS,
                        'sex' => Sex::MALE,
                        'level' => 43,
                    ],
                    [
                        'id' => PokedexNo::MUK,
                        'sex' => Sex::MALE,
                        'level' => 42,
                    ],
                    [
                        'id' => PokedexNo::VENOMOTH,
                        'sex' => Sex::MALE,
                        'level' => 41,
                    ],
                    [
                        'id' => PokedexNo::CROBAT,
                        'sex' => Sex::MALE,
                        'level' => 44,
                    ],
                ],
            ],
            [
                'id' => "6d9e5acf-9df2-4c4c-b739-599ea9e3d15e",
                'class' => TrainerClass::ELITE_FOUR,
                'name' => "Bruno",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/e/ee/Spr_HGSS_Bruno.png",
                'team' => [
                    [
                        'id' => PokedexNo::HITMONTOP,
                        'sex' => Sex::MALE,
                        'level' => 42,
                    ],
                    [
                        'id' => PokedexNo::HITMONLEE,
                        'sex' => Sex::MALE,
                        'level' => 42,
                    ],
                    [
                        'id' => PokedexNo::HITMONCHAN,
                        'sex' => Sex::MALE,
                        'level' => 42,
                    ],
                    [
                        'id' => PokedexNo::ONIX,
                        'sex' => Sex::MALE,
                        'level' => 43,
                    ],
                    [
                        'id' => PokedexNo::MACHAMP,
                        'sex' => Sex::MALE,
                        'level' => 46,
                    ],
                ],
            ],
            [
                'id' => "fcd989e3-dce0-48d5-bd49-56dac6476787",
                'class' => TrainerClass::ELITE_FOUR,
                'name' => "Karen",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/a/a2/Spr_HGSS_Karen.png",
                'team' => [
                    [
                        'id' => PokedexNo::UMBREON,
                        'sex' => Sex::MALE,
                        'level' => 42,
                    ],
                    [
                        'id' => PokedexNo::VILEPLUME,
                        'sex' => Sex::FEMALE,
                        'level' => 42,
                    ],
                    [
                        'id' => PokedexNo::MURKROW,
                        'sex' => Sex::FEMALE,
                        'level' => 44,
                    ],
                    [
                        'id' => PokedexNo::GENGAR,
                        'sex' => Sex::FEMALE,
                        'level' => 45,
                    ],
                    [
                        'id' => PokedexNo::HOUNDOOM,
                        'sex' => Sex::FEMALE,
                        'level' => 47,
                    ],
                ],
            ],
            [
                'id' => "f47e15c6-fe2a-4c51-b9e8-547583f81f0a",
                'class' => TrainerClass::CHAMPION,
                'name' => "Lance",
                'imageUrl' => "https://archives.bulbagarden.net/media/upload/1/1f/Spr_HGSS_Lance.png",
                'team' => [
                    [
                        'id' => PokedexNo::GYARADOS,
                        'sex' => Sex::MALE,
                        'level' => 46,
                    ],
                    [
                        'id' => PokedexNo::DRAGONITE,
                        'sex' => Sex::MALE,
                        'level' => 49,
                    ],
                    [
                        'id' => PokedexNo::DRAGONITE,
                        'sex' => Sex::MALE,
                        'level' => 49,
                    ],
                    [
                        'id' => PokedexNo::AERODACTYL,
                        'sex' => Sex::MALE,
                        'level' => 48,
                    ],
                    [
                        'id' => PokedexNo::CHARIZARD,
                        'sex' => Sex::MALE,
                        'level' => 48,
                    ],
                    [
                        'id' => PokedexNo::DRAGONITE,
                        'sex' => Sex::MALE,
                        'level' => 50,
                    ],
                ],
            ],
        ],
    ],
];
