<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Evolution;

final class EvolutionaryBranch
{
    public function __construct(
        public readonly array $data
    ) {}

    public function hasDescendants(): bool
    {
        return count($this->data['descendants']) > 0;
    }

    public function hasASingleDescendant(): bool
    {
        return count($this->data['descendants']) === 1;
    }

    public function getPokedexNumber(): string
    {
        return $this->data['pokedexNumber'];
    }

    public function getFirstBranch(): self
    {
        return new self($this->data['descendants'][0]);
    }

    public function getAllBranches(): array
    {
        return array_map(
            fn (array $data) => new self($data),
            $this->data['descendants'],
        );
    }
}
