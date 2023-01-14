<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamSendToBox
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
    ) {}

    public function __invoke(): void
    {
        $pokemonId = $_POST['pokemon'];

        $row = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND id = :pokemonId AND team_position IS NOT NULL", [
            'instanceId' => INSTANCE_ID,
            'pokemonId' => $pokemonId,
        ]);

        if ($row === false) {
            $this->session->getFlashBag()->add("errors", "Pokémon not on team.");
            header("Location: /team");
            return;
        }

        $team = $this->caughtPokemonRepository->getTeam();

        $this->db->beginTransaction();

        $this->db->update("caught_pokemon", [
            'team_position' => null,
        ], [
            'id' => $pokemonId,
        ]);

        foreach ($team as $pokemon) {
            if ($pokemon['id'] === $pokemonId) {
                continue;
            }

            if ($pokemon['team_position'] > $row['team_position']) {
                $this->db->update("caught_pokemon", [
                    'team_position' => $pokemon['team_position'] - 1,
                ], [
                    'id' => $pokemon['id'],
                ]);
            }
        }

        $this->db->commit();

        header("Location: /team");
    }
}
