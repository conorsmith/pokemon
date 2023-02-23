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
        $iv = 0;
        $ev = 0;

        $principalHp = (2 * $this->stats->baseHp) + $iv + floor($ev / 4);

        $physicalHp = floor($principalHp * $this->level / 100);

        $effectiveHp = $physicalHp + $this->level + 10;

        return intval($effectiveHp);
    }

    public function calculateAttack(): int
    {
        $iv = 0;
        $ev = 0;
        $nature = 1;

        $principalAttack = (2 * $this->stats->baseAttack) + $iv + floor($ev / 4);

        $physicalAttack = floor($principalAttack * $this->level / 100) + 5;

        $effectiveAttack = floor($physicalAttack * $nature);

        return intval($effectiveAttack);
    }

    public function calculateDefence(): int
    {
        $iv = 0;
        $ev = 0;
        $nature = 1;

        $principalDefence = (2 * $this->stats->baseDefence) + $iv + floor($ev / 4);

        $physicalDefence = floor($principalDefence * $this->level / 100) + 5;

        $effectiveDefence = floor($physicalDefence * $nature);

        return intval($effectiveDefence);
    }

    public function calculateSpecialAttack(): int
    {
        $iv = 0;
        $ev = 0;
        $nature = 1;

        $principalSpecialAttack = (2 * $this->stats->baseSpecialAttack) + $iv + floor($ev / 4);

        $physicalSpecialAttack = floor($principalSpecialAttack * $this->level / 100) + 5;

        $effectiveSpecialAttack = floor($physicalSpecialAttack * $nature);

        return intval($effectiveSpecialAttack);
    }

    public function calculateSpecialDefence(): int
    {
        $iv = 0;
        $ev = 0;
        $nature = 1;

        $principalSpecialDefence = (2 * $this->stats->baseSpecialDefence) + $iv + floor($ev / 4);

        $physicalSpecialDefence = floor($principalSpecialDefence * $this->level / 100) + 5;

        $effectiveSpecialDefence = floor($physicalSpecialDefence * $nature);

        return intval($effectiveSpecialDefence);
    }

    public function calculateSpeed(): int
    {
        $iv = 0;
        $ev = 0;
        $nature = 1;

        $principalSpeed = (2 * $this->stats->baseSpeed) + $iv + floor($ev / 4);

        $physicalSpeed = floor($principalSpeed * $this->level / 100) + 5;

        $effectiveSpeed = floor($physicalSpeed * $nature);

        return intval($effectiveSpeed);
    }
}
