<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

use WeakMap;

final class CapturedPokemonQueryResult
{
    public function __construct(
        public readonly string $id,
        public readonly string $pokedexNumber,
        private readonly WeakMap $properties,
    ) {}

    public function get(CapturedPokemonQueryProperty $property): mixed
    {
        return $this->properties[$property];
    }
}
