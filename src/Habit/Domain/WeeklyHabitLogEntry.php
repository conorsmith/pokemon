<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

use Carbon\CarbonPeriod;
use Ramsey\Uuid\UuidInterface;

final class WeeklyHabitLogEntry
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly CarbonPeriod $week,
        public readonly int $value,
    ) {}

    public function equals(self $other): bool
    {
        return $this->id->equals($other->id);
    }
}
