<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

final class Attack
{
    public static function physical(): self
    {
        return new self("physical", null);
    }

    public static function special(): self
    {
        return new self("special", null);
    }

    public function __construct(
        public readonly string $damageCategory,
        public readonly ?string $typeOrdinal,
    ) {}

    public function isPhysical(): bool
    {
        return $this->damageCategory === "physical";
    }

    public function isPrimaryType(): bool
    {
        return $this->typeOrdinal === "primary";
    }

    public function isSecondaryType(): bool
    {
        return $this->typeOrdinal === "secondary";
    }
}
