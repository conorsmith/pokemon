<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

return [
    [
        'id'     => RegionId::KANTO,
        'name'   => "Kanto",
        'unlock' => null,
    ],
    [
        'id'     => RegionId::JOHTO,
        'name'   => "Johto",
        'unlock' => RegionId::KANTO,
    ],
    [
        'id'     => RegionId::HOENN,
        'name'   => "Hoenn",
        'unlock' => RegionId::JOHTO,
    ],
    [
        'id'     => RegionId::SINNOH,
        'name'   => "Sinnoh",
        'unlock' => RegionId::HOENN,
    ],
    [
        'id'     => RegionId::UNOVA,
        'name'   => "Unova",
        'unlock' => RegionId::SINNOH,
    ],
    [
        'id'     => RegionId::KALOS,
        'name'   => "Kalos",
        'unlock' => RegionId::UNOVA,
    ],
    [
        'id'     => RegionId::ALOLA,
        'name'   => "Alola",
        'unlock' => RegionId::KALOS,
    ],
    [
        'id'     => RegionId::GALAR,
        'name'   => "Galar",
        'unlock' => RegionId::ALOLA,
    ],
    [
        'id'     => RegionId::PALDEA,
        'name'   => "Paldea",
        'unlock' => RegionId::GALAR,
    ],
];
