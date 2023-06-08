<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Domain;

final class FormEntry
{
    public static function createRegistered(string $id): self
    {
        return new self($id, true);
    }

    public static function createUnknown(string $id): self
    {
        return new self($id, false);
    }

    private function __construct(
        public readonly string $id,
        public readonly bool $isRegistered,
    ) {}
}
