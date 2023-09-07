<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\ViewModels;

final class EggsList
{
    public function __construct(
        public readonly bool $isEmpty,
        public readonly int $filled,
        public readonly array $slots,
    ) {}
}
