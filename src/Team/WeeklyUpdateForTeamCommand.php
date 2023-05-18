<?php

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\WeeklyUpdateForTeamCommand as CommandInterface;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Symfony\Component\HttpFoundation\Session\Session;

final class WeeklyUpdateForTeamCommand implements CommandInterface
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepository $pokemonRepository,
        private readonly LevelUpPokemon $levelUpPokemon,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function run(): void
    {
        $team = $this->pokemonRepository->getTeam();

        $members = $team->findAllMembersWithMaxFriendship();

        $results = [];

        /** @var Pokemon $member */
        foreach ($members as $member) {
            $results[$member->number] = $this->levelUpPokemon->run($member->id);
        }

        /** @var ResultOfLevellingUp $result */
        foreach ($results as $pokedexNumber => $result) {
            $pokemonConfig = $this->pokedexConfigRepository->find($pokedexNumber);
            $this->session->getFlashBag()->add(
                "successes",
                "{$pokemonConfig['name']} levelled up to level {$result->newLevel}",
            );

            if ($result->evolved) {
                $oldPokemonConfig = $pokemonConfig;
                $newPokemonConfig = $this->pokedexConfigRepository->find($result->newPokedexNumber);
                $this->session->getFlashBag()->add(
                    "successes",
                    "Your {$oldPokemonConfig['name']} evolved into {$newPokemonConfig['name']}!",
                );
            }
        }
    }
}
