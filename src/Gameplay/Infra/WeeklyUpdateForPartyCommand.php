<?php

namespace ConorSmith\Pokemon\Gameplay\Infra;

use ConorSmith\Pokemon\Gameplay\App\UseCases\LevelUpPokemon;
use ConorSmith\Pokemon\Gameplay\App\UseCases\LevelUpPokemonResult;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Commands\WeeklyUpdateForPartyCommand as CommandInterface;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;

final class WeeklyUpdateForPartyCommand implements CommandInterface
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
        private readonly LevelUpPokemon $levelUpPokemon,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
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

        /** @var LevelUpPokemonResult $result */
        foreach ($results as $pokedexNumber => $result) {
            $pokemonConfig = $this->pokedexConfigRepository->find($pokedexNumber);
            $this->notifyPlayerCommand->run(
                Notification::persistent("{$pokemonConfig['name']} levelled up to level {$result->newLevel}")
            );

            if ($result->evolved) {
                $oldPokemonConfig = $pokemonConfig;
                $newPokemonConfig = $this->pokedexConfigRepository->find($result->newPokedexNumber);
                $this->notifyPlayerCommand->run(
                    Notification::persistent("Your {$oldPokemonConfig['name']} evolved into {$newPokemonConfig['name']}!")
                );
            }
        }
    }
}
