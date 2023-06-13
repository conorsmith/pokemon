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
];
