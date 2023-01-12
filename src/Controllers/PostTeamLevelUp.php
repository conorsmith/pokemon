<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamLevelUp
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE id = :pokemonId", [
            'pokemonId' => $_POST['pokemon'],
        ]);

        if ($pokemonRow === false) {
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            header("Location: /team/level-up");
            exit;
        }

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($instanceRow['unused_level_ups'] < 1) {
            $this->session->getFlashBag()->add("errors", "No unused levels remaining.");
            header("Location: /team/level-up");
            exit;
        }

        $newLevel = $pokemonRow['level'] + 1;
        $pokemon = $this->pokedex[$pokemonRow['pokemon_id']];

        $this->db->beginTransaction();

        $this->db->update("instances", [
            'unused_level_ups' => $instanceRow['unused_level_ups'] - 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->update("caught_pokemon", [
            'level' => $newLevel,
        ], [
            'id' => $pokemonRow['id'],
        ]);

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "{$pokemon['name']} levelled up to level {$newLevel}");

        header("Location: /");
        exit;
    }
}
