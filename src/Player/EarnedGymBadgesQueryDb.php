<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player;

use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Queries\EarnedGymBadgesQuery;
use Doctrine\DBAL\Connection;

final class EarnedGymBadgesQueryDb implements EarnedGymBadgesQuery
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(): int
    {
        $playerInstanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($playerInstanceRow['badges'])
        );

        return count($gymBadges);
    }
}
