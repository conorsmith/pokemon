<?php

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\SharedKernel\WeeklyUpdateForTeamCommand as CommandInterface;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Symfony\Component\HttpFoundation\Session\Session;

final class WeeklyUpdateForTeamCommand implements CommandInterface
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): void
    {
        $team = $this->pokemonRepository->getTeam();

        // TODO: Handle evolvution
        $levelledUpTeam = $team->levelUpAllMembersWithMaxFriendship();

        $this->pokemonRepository->saveTeam($levelledUpTeam);

        $teamDiff = $team->diff($levelledUpTeam);

        $pokemonConfig = require __DIR__ . "/../Config/Pokedex.php";

        /** @var Pokemon $pokemon */
        foreach ($teamDiff as [$before, $after]) {
            $this->session->getFlashBag()->add("successes", "{$pokemonConfig[$before->number]['name']} levelled up to level {$after->level}");
        }
    }
}
