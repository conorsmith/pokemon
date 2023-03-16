<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class Gender
{
    public static function female(): self
    {
        return new self("female");
    }

    public static function male(): self
    {
        return new self("male");
    }

    public static function irrelevant(): self
    {
        return new self("irrelevant");
    }

    private function __construct(
        private readonly string $value,
    ) {}

    public function isRelevant(): bool
    {
        return $this->value !== "irrelevant";
    }

    public function isFemale(): bool
    {
        return $this->value === "female";
    }

    public function isMale(): bool
    {
        return $this->value === "male";
    }
}
