<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player\Repositories;

use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use LogicException;

final class GymBadgeRepositoryDb implements GymBadgeRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function findForRegion(RegionId $regionId): array
    {
        $row = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $regionalBadgeIds = match ($regionId) {
            RegionId::KANTO => range(1, 8),
            RegionId::JOHTO => range(9, 16),
            RegionId::HOENN => range(17, 24),
            default         => throw new LogicException(),
        };

        $earnedBadgeIds = json_decode($row['badges']);

        if (is_null($earnedBadgeIds)) {
            return [];
        }

        $earnedRegionalBadgeIds = array_intersect(
            $regionalBadgeIds,
            $earnedBadgeIds,
        );

        return array_map(
            fn(int $badgeId) => GymBadge::from($badgeId),
            $earnedRegionalBadgeIds,
        );
    }
}
