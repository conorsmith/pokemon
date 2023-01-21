<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Player;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetIndex
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly PlayerRepository $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $player = $this->playerRepository->findPlayer();

        $successes = $this->session->getFlashBag()->get("successes");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Index.php", [
            'summary' => (object) [
                'pokeballs' => $instanceRow['unused_encounters'],
                'rareCandies' => $instanceRow['unused_level_ups'],
                'challengeTokens' => $instanceRow['unused_moves'],
            ],
            'team' => $this->createTeamViewModels($player),
            'badges' => array_map(
                fn(int $value) => $this->viewModelFactory->createGymBadge(GymBadge::from($value)),
                json_decode($instanceRow['badges'])
            ),
            'successes' => $successes,
        ]);
    }

    private function createTeamViewModels(Player $player): array
    {
        $viewModels = [];

        foreach ($player->team as $pokemon) {
            $viewModels[] = $this->viewModelFactory->createPokemonOnTeam($pokemon);
        }

        return $viewModels;
    }
}
