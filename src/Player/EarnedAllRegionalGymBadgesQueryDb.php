<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player;

use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\EarnedAllRegionalGymBadgesQuery;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class EarnedAllRegionalGymBadgesQueryDb implements EarnedAllRegionalGymBadgesQuery
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(RegionId $regionId): bool
    {
        $playerInstanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($playerInstanceRow['badges'])
        );

        foreach (GymBadge::allFromRegion($regionId) as $gymBadge) {
            if (!in_array($gymBadge, $gymBadges)) {
                return false;
            }
        }

        return true;
    }
}
