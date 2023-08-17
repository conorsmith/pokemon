<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\UseCases;

final class ResultOfSpendingChallengeTokens
{
    public static function success(): self
    {
        return new self(true);
    }

    public static function failure(): self
    {
        return new self(false);
    }

    private function __construct(
        public readonly bool $succeeded,
    ) {}
}
