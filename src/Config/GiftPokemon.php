<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

return [

    // KANTO
    [
        'id'       => "aaa294a0-525d-45f4-8157-f338c93ea352",
        'pokemon'  => PokedexNo::BULBASAUR,
        'location' => LocationId::PROFESSOR_OAKS_LAB,
        'level'    => 5,
    ],
    [
        'id'       => "b2ca5fcf-261c-4056-83d7-f08d61d82c54",
        'pokemon'  => PokedexNo::CHARMANDER,
        'location' => LocationId::PROFESSOR_OAKS_LAB,
        'level'    => 5,
    ],
    [
        'id'       => "0304ed8b-60b3-4895-ab8e-e18b81b1db46",
        'pokemon'  => PokedexNo::SQUIRTLE,
        'location' => LocationId::PROFESSOR_OAKS_LAB,
        'level'    => 5,
    ],
    [
        'id'       => "0eb37f88-2c59-4134-8586-6aa90127a352",
        'item'     => ItemId::OLD_AMBER,
        'location' => LocationId::PEWTER_MUSEUM,
    ],
    [
        'id'       => "22304556-7d3b-4763-b9b8-a5542f6f441d",
        'item'     => ItemId::DOME_FOSSIL,
        'location' => LocationId::MT_MOON_BF2,
        'requirements' => [
            'clear' => LocationId::MT_MOON,
        ],
    ],
    [
        'id'       => "25d295fd-daa4-4798-9300-80a0d8c565c0",
        'item'     => ItemId::HELIX_FOSSIL,
        'location' => LocationId::MT_MOON_BF2,
        'requirements' => [
            'clear' => LocationId::MT_MOON,
        ],
    ],
    [
        'id'           => "f0ef06a1-f4e9-42a0-baf5-b41ac0a2db75",
        'pokemon'      => PokedexNo::HITMONLEE,
        'location'     => LocationId::FIGHTING_DOJO,
        'level'        => 30,
        'requirements' => [
            'clear' => LocationId::FIGHTING_DOJO,
        ],
    ],
    [
        'id'           => "2c2030c5-9a6f-4283-bc65-30fa58785276",
        'pokemon'      => PokedexNo::HITMONCHAN,
        'location'     => LocationId::FIGHTING_DOJO,
        'level'        => 30,
        'requirements' => [
            'clear' => LocationId::FIGHTING_DOJO,
        ],
    ],
    [
        'id'           => "b31e4dde-b7f8-4f2b-822d-4f4fa281ebe3",
        'pokemon'      => PokedexNo::LAPRAS,
        'location'     => LocationId::SILPH_CO_7F,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::SILPH_CO,
        ],
    ],
    [
        'id'       => "51072466-13c0-4e37-abc9-f674d144a9fc",
        'pokemon'  => PokedexNo::EEVEE,
        'location' => LocationId::CELADON_CONDOMINIUMS,
        'level'    => 25,
    ],
    [
        'id'           => "09ab7373-93aa-4e91-9ad1-94be0885f060",
        'pokemon'      => PokedexNo::ABRA,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 9,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'id'           => "52cd1e0b-f193-4c64-a9e3-3425ddfea842",
        'pokemon'      => PokedexNo::CLEFAIRY,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 12,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'id'           => "a297802c-feae-4ec2-b56c-c11a471f8d4f",
        'pokemon'      => PokedexNo::SCYTHER,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 25,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'id'           => "5c3713c2-cb08-4926-8697-6ee6600637ee",
        'pokemon'      => PokedexNo::PINSIR,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 18,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'id'           => "10ee016f-b983-4ba3-8250-9cebf0f74602",
        'pokemon'      => PokedexNo::DRATINI,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 24,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],
    [
        'id'           => "47c5b8fd-2779-4c68-b497-ace11e6ad22b",
        'pokemon'      => PokedexNo::PORYGON,
        'location'     => LocationId::ROCKET_GAME_CORNER,
        'level'        => 26,
        'requirements' => [
            'clear' => LocationId::TEAM_ROCKET_HIDEOUT,
        ],
    ],

    // JOHTO
    [
        'id'       => "186eb522-011b-436b-98b5-4cd31f192522",
        'pokemon'  => PokedexNo::CHIKORITA,
        'location' => LocationId::PROFESSOR_ELMS_LAB,
        'level'    => 5,
    ],
    [
        'id'       => "3d2bed2b-5f94-46f3-8615-9f8195429829",
        'pokemon'  => PokedexNo::CYNDAQUIL,
        'location' => LocationId::PROFESSOR_ELMS_LAB,
        'level'    => 5,
    ],
    [
        'id'       => "bab2f816-343a-4567-8ded-b3321c7ae5c4",
        'pokemon'  => PokedexNo::TOTODILE,
        'location' => LocationId::PROFESSOR_ELMS_LAB,
        'level'    => 5,
    ],
    [
        'id'       => "419046d3-7390-4cca-908c-f469d76d8bdf",
        'pokemon'  => PokedexNo::EEVEE,
        'location' => LocationId::GOLDENROD_BILLS_HOUSE,
        'level'    => 20,
    ],
    [
        'id'       => "63b27bb0-d617-4f24-9e20-4c9f60294f2c",
        'pokemon'  => PokedexNo::TOGEPI,
        'location' => LocationId::VIOLET_CITY,
        'isEgg'    => true,
    ],
    [
        'id'       => "d54dfd2e-fcb7-41e9-ad8f-46a05c6a15fe",
        'pokemon'  => PokedexNo::TYROGUE,
        'location' => LocationId::MT_MORTAR_B1F,
        'level'    => 10,
        'requirements' => [
            'defeat' => "64edd8b1-68ae-4c4c-8b85-7c349319749e",
        ],
    ],
    [
        'id'           => "3936f3ed-0296-44d2-8f31-1460473b29b5",
        'pokemon'      => PokedexNo::ABRA,
        'location'     => LocationId::GOLDENROD_GAME_CORNER,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::GOLDENROD_TUNNEL,
        ],
    ],
    [
        'id'           => "8b34e19b-61d8-42c3-812b-c7779c387756",
        'pokemon'      => PokedexNo::EKANS,
        'location'     => LocationId::GOLDENROD_GAME_CORNER,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::GOLDENROD_TUNNEL,
        ],
    ],
    [
        'id'           => "788a01e3-3ba0-4ba9-ab98-49dec4105862",
        'pokemon'      => PokedexNo::SANDSHREW,
        'location'     => LocationId::GOLDENROD_GAME_CORNER,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::GOLDENROD_TUNNEL,
        ],
    ],
    [
        'id'           => "08e65758-049b-45a2-8400-808e4b04b1f4",
        'pokemon'      => PokedexNo::DRATINI,
        'location'     => LocationId::GOLDENROD_GAME_CORNER,
        'level'        => 15,
        'requirements' => [
            'clear' => LocationId::GOLDENROD_TUNNEL,
        ],
    ],

    // HOENN
    [
        'id'       => "3194f1c9-dd1c-4fa5-9fb1-b7d9f27ef28f",
        'pokemon'  => PokedexNo::TREECKO,
        'location' => LocationId::PROFESSOR_BIRCHS_LAB,
        'level'    => 5,
    ],
    [
        'id'       => "0bc203a4-4a60-4f52-b2fb-260185bb612b",
        'pokemon'  => PokedexNo::TORCHIC,
        'location' => LocationId::PROFESSOR_BIRCHS_LAB,
        'level'    => 5,
    ],
    [
        'id'       => "76dc89cf-2486-46f9-9258-154291d4c23b",
        'pokemon'  => PokedexNo::MUDKIP,
        'location' => LocationId::PROFESSOR_BIRCHS_LAB,
        'level'    => 5,
    ],
    [
        'id'       => "a2e343a6-a8c6-4b14-94b4-196ad3fb066f",
        'pokemon'  => PokedexNo::WYNAUT,
        'location' => LocationId::HOT_SPRINGS,
        'isEgg'    => true,
    ],
    [
        'id'       => "d1c4864f-c613-488a-ad25-2cf4e98a39af",
        'item'     => ItemId::ROOT_FOSSIL,
        'location' => LocationId::ROUTE_111,
        'requirements' => [
            'clear' => LocationId::ROUTE_111,
        ],
    ],
    [
        'id'       => "33af2a6f-026e-4a28-8d05-02831a258337",
        'item'     => ItemId::CLAW_FOSSIL,
        'location' => LocationId::ROUTE_111,
        'requirements' => [
            'clear' => LocationId::ROUTE_111,
        ],
    ],
    [
        'id'       => "d378014b-cab2-4045-ba83-f998fe00c946",
        'pokemon'  => PokedexNo::CASTFORM,
        'location' => LocationId::WEATHER_INSTITUTE_2F,
        'level'    => 25,
        'requirements' => [
            'clear' => LocationId::WEATHER_INSTITUTE,
        ],
    ],
    [
        'id'       => "d513e62b-2ebf-4db7-a368-c7afd73d3bc5",
        'pokemon'  => PokedexNo::BELDUM,
        'location' => LocationId::STEVENS_HOUSE,
        'level'    => 5,
        'requirements' => [
            'victory' => RegionId::HOENN,
        ],
    ],
];
