<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetIndex
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $teamRows = $this->caughtPokemonRepository->getTeam();

        $team = TeamMember::fromRows($teamRows, $this->pokedex);

        $successes = $this->session->getFlashBag()->get("successes");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Index.php", [
            'summary' => (object) [
                'money' => $instanceRow['money'],
                'pokeballs' => $instanceRow['unused_encounters'],
                'rareCandies' => $instanceRow['unused_level_ups'],
                'challengeTokens' => $instanceRow['unused_moves'],
            ],
            'team' => $team,
            'successes' => $successes,
            'encounter' => $encounter ?? null,
        ]);
    }
}
