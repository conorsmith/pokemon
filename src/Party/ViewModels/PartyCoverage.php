<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\ViewModels;

use stdClass;

final class PartyCoverage
{
    public function __construct(
        public readonly array $increase,
        public readonly array $unmodified,
        public readonly array $decrease,
        public readonly array $zero,
        public readonly stdClass $counts,
    ) {}
}
