<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class LevelRange
{
    public function __construct(
        public readonly int $lowerBound,
        public readonly ?int $upperBound,
    ) {}

    public function merge(self $other): self
    {
        if (is_null($this->upperBound) && is_null($other->upperBound)) {
            $newUpperBound = null;

        } elseif (is_null($this->upperBound)) {
            $newUpperBound = $other->upperBound;

        } elseif (is_null($other->upperBound)) {
            $newUpperBound = $this->upperBound;

        } else {
            $newUpperBound = max($this->upperBound, $other->upperBound);
        }

        return new self(
            min($this->lowerBound, $other->lowerBound),
            $newUpperBound,
        );
    }
}
