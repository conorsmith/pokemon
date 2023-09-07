<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Repositories;

use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class CaughtPokemonRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function getParty(): array
    {
        return $this->db->fetchAllAssociative(
            "
                SELECT * FROM caught_pokemon
                    WHERE instance_id = :instanceId AND location = 'team'
                    ORDER BY party_position",
            [
                'instanceId' => $this->instanceId->value,
            ]
        );
    }
}
