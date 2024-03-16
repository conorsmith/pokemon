<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Party;

use DateTimeImmutable;

final class FriendshipEvent
{
    public function __construct(
        public readonly string $type,
        public readonly DateTimeImmutable $loggedAt,
    ) {}
}
