<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\ViewModels\Battle;

final class Pokemon
{
    public function __construct(
        public readonly string $name,
        public readonly string $imageUrl,
        public readonly string $primaryType,
        public readonly ?string $secondaryType,
        public readonly string $level,
    ) {}
}
