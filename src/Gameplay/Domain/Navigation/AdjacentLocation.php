<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Navigation;

final class AdjacentLocation
{
    public function __construct(
        public readonly string $id,
        public readonly ?string $direction,
        public readonly bool $isLocked,
    ) {}

    public function isInACardinalDirection(): bool
    {
        if (is_null($this->direction)) {
            return false;
        }

        return Direction::isCardinal($this->direction);
    }

    public function isInAVerticalDirection(): bool
    {
        if (is_null($this->direction)) {
            return false;
        }

        return Direction::isVertical($this->direction);
    }

    public function isAnExit(): bool
    {
        if (is_null($this->direction)) {
            return false;
        }

        return Direction::isExit($this->direction);
    }
}
