<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Doctrine\DBAL\Connection;
use stdClass;

final class GetMapMove
{
    public function __construct(
        private readonly Connection $db,
        private readonly array $map,
    ) {}

    public function __invoke(): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $unusedMoves = $row['unused_moves'];

        $currentLocation = $this->createLocationViewModel($this->findLocation($row['current_location']));

        include __DIR__ . "/../Templates/Move.php";
        exit;
    }

    private function findLocation(string $id): array
    {
        /** @var array $location */
        foreach ($this->map as $location) {
            if ($location['id'] === $id) {
                return $location;
            }
        }

        throw new \Exception;
    }

    private function createLocationViewModel(array $location): stdClass
    {
        $directions = [];

        /** @var string $locationId */
        foreach ($location['directions'] as $locationId) {
            $directionLocation = $this->findLocation($locationId);
            $directions[] = (object) [
                'id' => $directionLocation['id'],
                'name' => $directionLocation['name'],
            ];
        }

        return (object) [
            'id' => $location['id'],
            'name' => $location['name'],
            'directions' => $directions,
        ];
    }
}
