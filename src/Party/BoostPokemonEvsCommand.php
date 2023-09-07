<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party;

use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\SharedKernel\Commands\BoostPokemonEvsCommand as CommandInterface;

final class BoostPokemonEvsCommand implements CommandInterface
{
    public function __construct(
        private readonly PokemonRepositoryDb $pokemonRepository,
    ) {}

    public function run(
        string $pokemonId,
        int $hpIncrement,
        int $physicalAttackIncrement,
        int $physicalDefenceIncrement,
        int $specialAttackIncrement,
        int $specialDefenceIncrement,
        int $speedIncrement,
    ): void {
        $pokemon = $this->pokemonRepository->find($pokemonId);

        $pokemon = $pokemon->boostHpEv($hpIncrement);
        $pokemon = $pokemon->boostPhysicalAttackEv($physicalAttackIncrement);
        $pokemon = $pokemon->boostPhysicalDefenceEv($physicalDefenceIncrement);
        $pokemon = $pokemon->boostSpecialAttackEv($specialAttackIncrement);
        $pokemon = $pokemon->boostSpecialDefenceEv($specialDefenceIncrement);
        $pokemon = $pokemon->boostSpeedEv($speedIncrement);

        $this->pokemonRepository->save($pokemon);
    }
}
