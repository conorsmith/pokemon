<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

final class CapturedPokemonQueryParameters
{
    public static function partyMembers(array $properties): self
    {
        return new self($properties);
    }

    public function __construct(
        public readonly array $properties,
    ) {
        foreach ($this->properties as $property) {
            assert($property instanceof CapturedPokemonQueryProperty);
        }
    }
}
