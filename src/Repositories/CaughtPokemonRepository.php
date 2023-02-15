<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Repositories;

use Doctrine\DBAL\Connection;

final class CaughtPokemonRepository
{
    public function __construct(
        private readonly Connection $db
    ) {}

    public function getTeam(): array
    {
        return $this->db->fetchAllAssociative(
            "
                SELECT * FROM caught_pokemon
                    WHERE instance_id = :instanceId AND location = 'team'
                    ORDER BY team_position",
            [
                'instanceId' => INSTANCE_ID,
            ]
        );
    }
}
