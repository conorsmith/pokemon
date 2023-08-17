<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class Sex
{
    public static function female(): self
    {
        return new self("female");
    }

    public static function male(): self
    {
        return new self("male");
    }

    public static function unknown(): self
    {
        return new self("unknown");
    }

    private function __construct(
        private readonly string $value,
    ) {}

    public function isFemale(): bool
    {
        return $this->value === "female";
    }

    public function isMale(): bool
    {
        return $this->value === "male";
    }
}
