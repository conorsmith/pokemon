<?php

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

class PostTeamSendToTeam
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
    ) {}

    public function __invoke(): void
    {
        $pokemonId = $_POST['pokemon'];

        $row = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND id = :pokemonId AND team_position IS NULL", [
            'instanceId' => INSTANCE_ID,
            'pokemonId' => $pokemonId,
        ]);

        if ($row === false) {
            $this->session->getFlashBag()->add("errors", "Pokémon not in box.");
            header("Location: /team");
            return;
        }

        $team = $this->caughtPokemonRepository->getTeam();

        if (count($team) === 6) {
            $this->session->getFlashBag()->add("errors", "Team is full.");
            header("Location: /team");
            return;
        }

        $freePosition = 1;

        foreach ($team as $pokemon) {
            if ($pokemon['team_position'] >= $freePosition) {
                $freePosition = $pokemon['team_position'] + 1;
            }
        }

        $this->db->update("caught_pokemon", [
            'team_position' => $freePosition,
        ], [
            'id' => $pokemonId,
        ]);

        header("Location: /team");
    }

}