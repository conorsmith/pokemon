<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

final class Pokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $number,
        public readonly int $primaryType,
        public readonly ?int $secondaryType,
        public readonly int $level,
        public readonly bool $isShiny,
        public bool $hasFainted,
    ) {}

    public function faint(): void
    {
        $this->hasFainted = true;
    }

    public function revive(): void
    {
        $this->hasFainted = false;
    }
}
