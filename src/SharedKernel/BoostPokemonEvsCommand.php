<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface BoostPokemonEvsCommand
{
    public function run(
        string $pokemonId,
        int $hpIncrement,
        int $physicalAttackIncrement,
        int $physicalDefenceIncrement,
        int $specialAttackIncrement,
        int $specialDefenceIncrement,
        int $speedIncrement,
    ): void;
}
