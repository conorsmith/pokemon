<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Doctrine\DBAL\Connection;

final class PostTeamLevelUp
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function __invoke(): void
    {
        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE id = :pokemonId", [
            'pokemonId' => $_POST['pokemon'],
        ]);

        if ($pokemonRow === false) {
            header("Location: /team/level-up");
            exit;
        }

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($instanceRow['unused_level_ups'] < 1) {
            header("Location: /team/level-up");
            exit;
        }

        $this->db->beginTransaction();

        $this->db->update("instances", [
            'unused_level_ups' => $instanceRow['unused_level_ups'] - 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->update("caught_pokemon", [
            'level' => $pokemonRow['level'] + 1,
        ], [
            'id' => $pokemonRow['id'],
        ]);

        $this->db->commit();

        header("Location: /");
        exit;
    }
}
