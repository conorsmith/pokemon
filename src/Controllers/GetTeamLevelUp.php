<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;

final class GetTeamLevelUp
{
    public function __construct(
        private readonly Connection $db,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $unusedLevelUps = $row['unused_level_ups'];

        $rows = $this->caughtPokemonRepository->getTeam();

        $team = TeamMember::fromRows($rows, $this->pokedex);

        include __DIR__ . "/../Templates/LevelUp.php";
        exit;
    }
}
