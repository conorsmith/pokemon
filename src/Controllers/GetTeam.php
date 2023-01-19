<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Domain\Battle\Player;
use ConorSmith\Pokemon\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\Repositories\Battle\PlayerRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use Exception;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetTeam
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly PlayerRepository $playerRepository,
        private readonly array $pokedex,
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function __invoke(): void
    {
        $player = $this->playerRepository->findPlayer();

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

        $successes = $this->session->getFlashBag()->get("successes");
        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Box.php", [
            'team' => $this->createTeamViewModels($player),
            'box' => $this->createBoxViewModels($rows),
            'successes' => $successes,
            'errors' => $errors,
        ]);
    }

    private function createTeamViewModels(Player $player): array
    {
        $viewModels = [];

        foreach ($player->team as $i => $pokemon) {
            $viewModels[] = $this->viewModelFactory->createPokemonOnTeam($player->teamIds[$i], $pokemon);
        }

        return $viewModels;
    }

    private function createBoxViewModels(array $rows): array
    {
        return array_map(
            fn(array $row) => (object) [
                'id' => $row['id'],
                'name' => $this->findPokedexEntry($row['pokemon_id'])['name'],
                'imageUrl' => TeamMember::createImageUrl($row['pokemon_id']),
                'primaryType' => ViewModelFactory::createPokemonTypeName($this->findPokedexEntry($row['pokemon_id'])['type'][0]),
                'secondaryType' => isset($this->findPokedexEntry($row['pokemon_id'])['type'][1])
                    ? ViewModelFactory::createPokemonTypeName($this->findPokedexEntry($row['pokemon_id'])['type'][1])
                    : null,
                'level' => $row['level'],
            ],
            $rows
        );
    }

    private function findPokedexEntry(string $number): array
    {
        if (!array_key_exists($number, $this->pokedex)) {
            throw new Exception;
        }

        return $this->pokedex[$number];
    }
}
