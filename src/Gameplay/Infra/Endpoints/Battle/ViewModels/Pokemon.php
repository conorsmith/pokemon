<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels;

use ConorSmith\Pokemon\SharedKernel\Domain\Sex;

final class Pokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $form,
        public readonly string $imageUrl,
        public readonly string $primaryType,
        public readonly ?string $secondaryType,
        public readonly string $level,
        public readonly Sex $sex,
        public readonly bool $isShiny,
        public readonly bool $isLegendary,
        public readonly string $remainingHp,
        public readonly string $totalHp,
        public readonly bool $hasFainted,
        public readonly int $physicalAttack,
        public readonly int $specialAttack,
        public readonly IvStrength $ivs,
    ) {}
}
