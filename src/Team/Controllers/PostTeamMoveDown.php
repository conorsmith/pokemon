<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamMoveDown
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly CaughtPokemonRepository $caughtPokemonRepository
    ) {}

    public function __invoke(): void
    {
        $pokemonId = $_POST['pokemon'];

        $rows = $this->caughtPokemonRepository->getTeam();

        foreach ($rows as $i => $pokemonRow) {
            if ($pokemonRow['id'] === $pokemonId) {
                if ($pokemonRow['team_position'] === count($rows)) {
                    $this->session->getFlashBag()->add("errors", "Target Pokémon cannot be moved down");
                    header("Location: /team");
                    return;
                }
                $targetPokemon = $rows[$i];
                $affectedPokemon = $rows[$i + 1];
            }
        }

        if (!isset($targetPokemon)) {
            $this->session->getFlashBag()->add("errors", "Target Pokémon not found");
            header("Location: /team");
            return;
        }

        $this->db->beginTransaction();

        $this->db->update("caught_pokemon", [
            'team_position' => $targetPokemon['team_position'] + 1,
        ], [
            'id' => $targetPokemon['id'],
        ]);

        $this->db->update("caught_pokemon", [
            'team_position' => $affectedPokemon['team_position'] - 1,
        ], [
            'id' => $affectedPokemon['id'],
        ]);

        $this->db->commit();

        header("Location: /team");
    }
}