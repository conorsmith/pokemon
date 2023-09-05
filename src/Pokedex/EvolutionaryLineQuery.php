<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex;

use ConorSmith\Pokemon\Pokedex\Repositories\EvolutionaryLineRepository;
use ConorSmith\Pokemon\SharedKernel\EvolutionaryLineQuery as QueryInterface;

final class EvolutionaryLineQuery implements QueryInterface
{
    public function __construct(
        private readonly EvolutionaryLineRepository $evolutionaryLineRepository,
    ) {}

    public function run(string $pokedexNumber): array
    {
        return $this->evolutionaryLineRepository->find($pokedexNumber)->getPokedexNumbers();
    }
}
