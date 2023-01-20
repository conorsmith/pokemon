<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Direction;
use ConorSmith\Pokemon\TemplateEngine;
use Doctrine\DBAL\Connection;
use stdClass;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetMapMove
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $map,
    ) {}

    public function __invoke(): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $currentLocation = $this->createLocationViewModel($this->findLocation($row['current_location']));

        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Move.php", [
            'currentLocation' => $currentLocation,
            'errors' => $errors,
        ]);
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
        $viewModel = (object) [
            'id' => $location['id'],
            'name' => $location['name'],
            'hasCardinalDirections' => false,
            'directions' => [],
        ];

        /** @var string $locationId */
        foreach ($location['directions'] as $key => $locationId) {
            $directionLocation = $this->findLocation($locationId);
            if (Direction::isCardinal($key)) {
                $viewModel->hasCardinalDirections = true;
                $viewModel->{Direction::toSlug($key)} = (object) [
                    'id'   => $directionLocation['id'],
                    'name' => $directionLocation['name'],
                ];
            } else {
                $viewModel->directions[] = (object) [
                    'id'   => $directionLocation['id'],
                    'name' => $directionLocation['name'],
                ];
            }
        }

        return $viewModel;
    }
}
