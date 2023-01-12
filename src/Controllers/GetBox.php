<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;

final class GetBox
{
    public function __construct(
        private readonly Connection $db,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position IS NULL", [
            'instanceId' => INSTANCE_ID,
        ]);

        $team = TeamMember::fromRows($rows, $this->pokedex);

        echo TemplateEngine::render(__DIR__ . "/../Templates/Box.php", [
            'team' => $team,
        ]);
    }
}
