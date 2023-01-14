<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetBattle
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $pokedex,
        private readonly array $map,
    ) {}

    public function __invoke(array $args): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $args['id'],
        ]);

        $leadPokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position IS NOT NULL AND has_fainted = 0 ORDER BY team_position", [
            'instanceId' => INSTANCE_ID,
        ]);

        $challengedTrainer = null;

        foreach ($this->findLocation($instanceRow['current_location'])['trainers'] as $trainer) {
            if ($trainer['id'] === $trainerBattleRow['trainer_id']) {
                $challengedTrainer = $trainer;
            }
        }

        $activePokemonIndex = $trainerBattleRow['active_pokemon'];

        $activePokemon = (object) [
            'name' => $this->pokedex[$challengedTrainer['team'][$activePokemonIndex]['id']]['name'],
            'imageUrl' => TeamMember::createImageUrl($challengedTrainer['team'][$activePokemonIndex]['id']),
            'level' => $challengedTrainer['team'][$activePokemonIndex]['level'],
        ];

        $leadPokemon = (object) [
            'name'     => $this->pokedex[$leadPokemonRow['pokemon_id']]['name'],
            'imageUrl' => TeamMember::createImageUrl($leadPokemonRow['pokemon_id']),
            'level'    => $leadPokemonRow['level'],
        ];

        $successes = $this->session->getFlashBag()->get("successes");
        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Battle.php", [
            'id' => $trainerBattleRow['id'],
            'activePokemon' => $activePokemon,
            'leadPokemon' => $leadPokemon,
            'trainer' => (object) [
                'name' => $challengedTrainer['name'],
                'team' => (object) [
                    'fainted' => $activePokemonIndex,
                    'active' => count($challengedTrainer['team']) - $activePokemonIndex,
                ]
            ],
            'successes' => $successes,
            'errors' => $errors,
        ]);
    }

    private function findLocation(string $id): array
    {
        /** @var array $location */
        foreach ($this->map as $location) {
            if ($location['id'] === $id) {
                return $location;
            }
        }

        throw new \Exception;
    }
}
