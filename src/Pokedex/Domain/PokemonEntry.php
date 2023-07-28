<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class PokemonEntry
{
    public static function createRegistered(string $pokedexNumber, RegionId $regionId, array $forms): self
    {
        return new self($pokedexNumber, true, $regionId, $forms);
    }

    public static function createUnknown(string $pokedexNumber, RegionId $regionId): self
    {
        return new self($pokedexNumber, false, $regionId, []);
    }

    private function __construct(
        public readonly string $pokedexNumber,
        public readonly bool $isRegistered,
        public readonly RegionId $regionId,
        public readonly array $forms,
    ) {}
}
