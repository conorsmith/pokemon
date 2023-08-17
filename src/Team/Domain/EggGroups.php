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
        if ($this->isDitto() && $other->isDitto()) {
            return false;
        }

        if ($this->isDitto() || $other->isDitto()) {
            return true;
        }

        if ($this->firstEggGroup === $other->firstEggGroup
            || $this->firstEggGroup === $other->secondEggGroup
        ) {
            return true;
        }

        if (is_null($this->secondEggGroup)) {
            return false;
        }

        if ($this->secondEggGroup === $other->firstEggGroup
            || $this->secondEggGroup === $other->secondEggGroup
        ) {
            return true;
        }

        return false;
    }

    public function isDitto(): bool
    {
        return $this->firstEggGroup === EggGroup::DITTO;
    }
}
