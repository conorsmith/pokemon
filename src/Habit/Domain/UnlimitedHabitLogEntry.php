<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

use Carbon\CarbonImmutable;
use Ramsey\Uuid\UuidInterface;

final class UnlimitedHabitLogEntry
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly CarbonImmutable $date,
        public readonly EntryType $entryType,
    ) {}

    public function equals(self $other): bool
    {
        return $this->id->equals($other->id);
    }
}
