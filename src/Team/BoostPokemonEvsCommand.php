<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\SharedKernel\BoostPokemonEvsCommand as CommandInterface;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;

final class BoostPokemonEvsCommand implements CommandInterface
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
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
