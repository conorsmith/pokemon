<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\Location;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LocationRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class BattleLocationRepositoryDb implements LocationRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function findCurrentLocation(): Location
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $locationId = $instanceRow['current_location'];

        $config = $this->locationConfigRepository->findLocation($locationId);

        return new Location(
            $locationId,
            $config['region'],
        );
    }
}
