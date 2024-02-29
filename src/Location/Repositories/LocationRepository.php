<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Repositories;

use ConorSmith\Pokemon\Location\Domain\AdjacentLocation;
use ConorSmith\Pokemon\Location\Domain\Location;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class LocationRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly RegionRepository $regionRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function find(string $locationId): Location
    {
        $locationConfig = $this->locationConfigRepository->findLocation($locationId);

        $adjacentLocations = [];

        /** @var string $directionLocationId */
        foreach ($locationConfig['directions'] as $key => $directionLocationId) {
            $directionConfig = $this->locationConfigRepository->findLocation($directionLocationId);
            $directionRegion = $this->regionRepository->find($directionConfig['region']);

            $adjacentLocations[] = new AdjacentLocation(
                $directionConfig['id'],
                is_string($key) ? $key : null,
                $directionRegion->isLocked,
            );
        }

        return new Location(
            $locationConfig['id'],
            $locationConfig['region'],
            $adjacentLocations,
        );
    }

    public function findCurrentLocation(): Location
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        return $this->find($instanceRow['current_location']);
    }
}
