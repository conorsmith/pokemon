<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostMapMove
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $map,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($instanceRow['unused_moves'] < 1) {
            $this->session->getFlashBag()->add("errors", "No unused moves remaining.");
            header("Location: /map/move");
            exit;
        }

        $currentLocation = $this->findLocation($instanceRow['current_location']);

        if (!in_array($_POST['location'], $currentLocation['directions'])) {
            $this->session->getFlashBag()->add("errors", "Cannot move there from current location.");
            header("Location: /map/move");
            exit;
        }

        $this->db->update("instances", [
            'current_location' => $_POST['location'],
            'unused_moves' => $instanceRow['unused_moves'] - 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        header("Location: /map/move");
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
}
