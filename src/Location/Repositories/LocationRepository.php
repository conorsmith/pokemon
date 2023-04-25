<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Repositories;

use ConorSmith\Pokemon\Location\Domain\AdjacentLocation;
use ConorSmith\Pokemon\Location\Domain\Location;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use ConorSmith\Pokemon\SharedKernel\RegionalVictoryQuery;
use Doctrine\DBAL\Connection;

final class LocationRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly RegionalVictoryQuery $regionalVictoryQuery,
        private readonly LocationConfigRepository $locationConfigRepository,
    ) {}

    public function findCurrentLocation(): Location
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $locationConfig = $this->locationConfigRepository->findLocation($instanceRow['current_location']);

        $adjacentLocations = [];

        /** @var string $directionLocationId */
        foreach ($locationConfig['directions'] as $key => $directionLocationId) {
            $directionConfig = $this->locationConfigRepository->findLocation($directionLocationId);

            $adjacentLocations[] = new AdjacentLocation(
                $directionConfig['id'],
                is_string($key) ? $key : null,
                $this->regionIsLocked($directionConfig['region']),
            );
        }

        return new Location($locationConfig['id'], $adjacentLocations);
    }

    private function regionIsLocked(Region $region): bool
    {
        if ($region === Region::KANTO) {
            return false;
        }

        $requiredRegion = match($region) {
            Region::JOHTO => Region::KANTO,
        };

        return !$this->regionalVictoryQuery->run($requiredRegion);
    }
}
