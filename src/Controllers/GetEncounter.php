<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetEncounter
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $id = substr($_SERVER['REQUEST_URI'], strlen("/encounter/"));

        $encounterRow = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $id,
        ]);

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($instanceRow['unused_encounters'] < 1) {
            $this->session->getFlashBag()->add("errors", "No unused encounters remaining.");
            header("Location: /map/encounter");
            exit;
        }

        $encounteredPokemon = $this->pokedex[$encounterRow['pokemon_id']];

        $pokemon = (object) [
            'name'     => $encounteredPokemon['name'],
            'imageUrl' => TeamMember::createImageUrl($encounterRow['pokemon_id']),
            'level'    => $encounterRow['level'],
        ];

        echo TemplateEngine::render(__DIR__ . "/../Templates/Encounter.php", [
            'id' => $id,
            'pokemon' => $pokemon,
            'pokeballs' => $instanceRow['unused_encounters'],
        ]);
    }
}
