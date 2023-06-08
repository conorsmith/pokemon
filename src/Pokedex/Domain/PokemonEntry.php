<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Domain;

final class PokemonEntry
{
    public static function createRegistered(string $pokedexNumber, array $forms): self
    {
        return new self($pokedexNumber, true, $forms);
    }

    public static function createUnknown(string $pokedexNumber): self
    {
        return new self($pokedexNumber, false, []);
    }

    private function __construct(
        public readonly string $pokedexNumber,
        public readonly bool $isRegistered,
        public readonly array $forms,
    ) {}
}
