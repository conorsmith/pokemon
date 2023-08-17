<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player;

use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\SharedKernel\HighestRankedGymBadgeQuery;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class HighestRankedGymBadgeQueryDb implements HighestRankedGymBadgeQuery
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(): GymBadge
    {
        $playerInstanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($playerInstanceRow['badges'])
        );

        if (count($gymBadges) === 0) {
            return GymBadge::BOULDER;
        }

        return GymBadge::findHighestRanked($gymBadges);
    }
}
