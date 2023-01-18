<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\Repositories\Battle\PlayerRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use Exception;

final class GetTeam
{
    public function __construct(
        private readonly Connection $db,
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

        $boxedPokemon = array_map(
            fn(array $row) => new Pokemon(
                $row['pokemon_id'],
                $this->findPokedexEntry($row['pokemon_id'])['type'][0],
                $this->findPokedexEntry($row['pokemon_id'])['type'][1] ?? null,
                $row['level'],
                false,
            ),
            $rows
        );

        echo TemplateEngine::render(__DIR__ . "/../Templates/Box.php", [
            'team' => array_map(
                fn(Pokemon $pokemon) => $this->viewModelFactory->createPokemonOnTeam($pokemon),
                $player->team
            ),
            'box' => array_map(
                fn(Pokemon $pokemon) => $this->viewModelFactory->createPokemonOnTeam($pokemon),
                $boxedPokemon
            ),
        ]);
    }

    private function findPokedexEntry(string $number): array
    {
        if (!array_key_exists($number, $this->pokedex)) {
            throw new Exception;
        }

        return $this->pokedex[$number];
    }
}
