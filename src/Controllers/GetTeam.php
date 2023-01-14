<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;

final class GetTeam
{
    public function __construct(
        private readonly Connection $db,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $rows = $this->caughtPokemonRepository->getTeam();

        $team = TeamMember::fromRows($rows, $this->pokedex);

        $rows = $this->db->fetchAllAssociative(
            "
                SELECT * FROM caught_pokemon
                    WHERE instance_id = :instanceId
                    AND team_position IS NULL
                    ORDER BY (pokemon_id * 1) ASC, level DESC",
            [
                'instanceId' => INSTANCE_ID,
            ]
        );

        $box = TeamMember::fromRows($rows, $this->pokedex);

        echo TemplateEngine::render(__DIR__ . "/../Templates/Box.php", [
            'team' => $team,
            'box' => $box,
        ]);
    }
}
