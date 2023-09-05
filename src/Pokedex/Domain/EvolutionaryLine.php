<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Domain;

final class EvolutionaryLine
{
    public function __construct(
        public readonly array $data
    ) {}

    public function getRootBranch(): EvolutionaryBranch
    {
        return new EvolutionaryBranch($this->data);
    }

    public function getPokedexNumbers(): array
    {
        return $this->recursivelyExtractPokedexNumbers($this->data);
    }

    private function recursivelyExtractPokedexNumbers(array $data): array
    {
        $pokedexNumbers = [$data['pokedexNumber']];

        foreach ($data['descendants'] as $descendantData) {
            $pokedexNumbers = array_merge(
                $pokedexNumbers,
                $this->recursivelyExtractPokedexNumbers($descendantData),
            );
        }

        return $pokedexNumbers;
    }
}
