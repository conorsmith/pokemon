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
        'location' => LocationId::INDIGO_PLATEAU,
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
];
