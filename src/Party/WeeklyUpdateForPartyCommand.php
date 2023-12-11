<?php

namespace ConorSmith\Pokemon\Party;

use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\WeeklyUpdateForPartyCommand as CommandInterface;
use Symfony\Component\HttpFoundation\Session\Session;

final class WeeklyUpdateForPartyCommand implements CommandInterface
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly LevelUpPokemon $levelUpPokemon,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function run(): void
    {
        $party = $this->pokemonRepository->getParty();

        $members = $party->findAllMembersWithMaxFriendship();

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