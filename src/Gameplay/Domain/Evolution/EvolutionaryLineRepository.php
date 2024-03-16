<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Evolution;

interface EvolutionaryLineRepository
{
    public function find(string $pokedexNumber): EvolutionaryLine;
}
