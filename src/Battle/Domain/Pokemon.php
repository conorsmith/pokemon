<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

final class Pokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $number,
        public readonly ?string $form,
        public readonly int $primaryType,
        public readonly ?int $secondaryType,
        public readonly int $level,
        public readonly int $friendship,
        public readonly bool $isShiny,
        public readonly Stats $stats,
        public int $remainingHp,
        public bool $hasFainted,
    ) {}

    public function hitFor(int $hp): void
    {
        $this->remainingHp = max(0, $this->remainingHp - $hp);

        if ($this->remainingHp === 0) {
            $this->faint();
        }
    }

    public function faint(): void
    {
        $this->hasFainted = true;
    }

    public function revive(): void
    {
        $this->remainingHp = $this->calculateHp();
        $this->hasFainted = false;
    }

    public function calculateHp(): int
    {
        return $this->stats->calculateHp();
    }

    public function calculateAttack(): int
    {
        return $this->stats->calculatePhysicalAttack();
    }

    public function calculateDefence(): int
    {
        return $this->stats->calculatePhysicalDefence();
    }

    public function calculateSpecialAttack(): int
    {
        return $this->stats->calculateSpecialAttack();
    }

    public function calculateSpecialDefence(): int
    {
        return $this->stats->calculateSpecialDefence();
    }

    public function calculateSpeed(): int
    {
        return $this->stats->calculateSpeed();
    }
}
