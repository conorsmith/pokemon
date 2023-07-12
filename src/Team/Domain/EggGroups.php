<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use ConorSmith\Pokemon\EggGroup;

final class EggGroups
{
    public function __construct(
        public readonly EggGroup $firstEggGroup,
        public readonly ?EggGroup $secondEggGroup,
    ) {}

    public function compatibleWith(self $other): bool
    {
        return $this->firstEggGroup === $other->firstEggGroup
            || $this->firstEggGroup === $other->secondEggGroup
            || $this->secondEggGroup === $other->firstEggGroup
            || ($this->secondEggGroup === $other->secondEggGroup && !is_null($this->secondEggGroup));
    }
}
