<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\LocationConfigRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostMapMove
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly LocationConfigRepository $locationConfigRepository,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $args['instanceId'],
        ]);

        $currentLocation = $this->findLocation($instanceRow['current_location']);

        if (!in_array($request->request->get('location'), $currentLocation['directions'])) {
            $this->session->getFlashBag()->add("errors", "Cannot move there from current location.");
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $this->db->update("instances", [
            'current_location' => $request->request->get('location'),
        ], [
            'id' => $args['instanceId'],
        ]);

        return new RedirectResponse("/{$args['instanceId']}/map");
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
