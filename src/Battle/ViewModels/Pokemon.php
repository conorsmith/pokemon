<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\ViewModels;

final class Pokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $imageUrl,
        public readonly string $primaryType,
        public readonly ?string $secondaryType,
        public readonly string $level,
        public readonly bool $isShiny,
        public readonly string $remainingHp,
        public readonly string $totalHp,
    ) {}
}
