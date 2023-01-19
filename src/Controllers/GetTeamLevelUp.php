<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetTeamLevelUp
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $rareCandies = $row['unused_level_ups'];

        $rows = $this->caughtPokemonRepository->getTeam();

        $team = TeamMember::fromRows($rows, $this->pokedex);

        echo TemplateEngine::render(__DIR__ . "/../Templates/LevelUp.php", [
            'team' => $team,
            'rareCandies' => $rareCandies,
            'successes' => $this->session->getFlashBag()->get("successes"),
            'errors' => $this->session->getFlashBag()->get("errors"),
        ]);
    }
}
