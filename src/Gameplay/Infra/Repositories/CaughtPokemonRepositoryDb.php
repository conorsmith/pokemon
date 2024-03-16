<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use ConorSmith\Pokemon\Gameplay\Domain\Party\CaughtPokemonRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class CaughtPokemonRepositoryDb implements CaughtPokemonRepository
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
