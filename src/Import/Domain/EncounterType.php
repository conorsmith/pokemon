<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class EncounterType
{
    public static function irrelevant(): self
    {
        return new self("irrelevant");
    }

    public function __construct(
        public readonly string $value,
    ) {}

    public function isIrrelevant(): bool
    {
        return $this->value === "irrelevant";
    }
}
