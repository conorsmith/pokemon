<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\LocationConfigRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostMapMove
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly LocationConfigRepository $locationConfigRepository,
    ) {}

    public function __invoke(): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $currentLocation = $this->findLocation($instanceRow['current_location']);

        if (!in_array($_POST['location'], $currentLocation['directions'])) {
            $this->session->getFlashBag()->add("errors", "Cannot move there from current location.");
            header("Location: /map/move");
            exit;
        }

        $this->db->update("instances", [
            'current_location' => $_POST['location'],
        ], [
            'id' => INSTANCE_ID,
        ]);

        header("Location: /map");
        exit;
    }

    private function findLocation(string $id): array
    {
        $location = $this->locationConfigRepository->findLocation($id);

        if (is_null($location)) {
            throw new \Exception;
        }

        return $location;
    }
}
