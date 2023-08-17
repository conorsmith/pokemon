<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class PokemonEvYield
{
    public function __construct(
        public readonly PokedexNumber $pokedexNumber,
        public readonly ?string $form,
        public readonly ?int $exp,
        public readonly int $hp,
        public readonly int $physicalAttack,
        public readonly int $physicalDefence,
        public readonly int $specialAttack,
        public readonly int $specialDefence,
        public readonly int $speed,
    ) {}
}
