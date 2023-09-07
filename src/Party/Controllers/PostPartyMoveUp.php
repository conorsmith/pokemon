<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\Party\Repositories\CaughtPokemonRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostPartyMoveUp
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly CaughtPokemonRepository $caughtPokemonRepository
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');

        $rows = $this->caughtPokemonRepository->getParty();

        foreach ($rows as $i => $pokemonRow) {
            if ($pokemonRow['id'] === $pokemonId) {
                if ($pokemonRow['party_position'] === 0) {
                    $this->session->getFlashBag()->add("errors", "Target Pokémon cannot be moved up");
                    return new RedirectResponse("/{$args['instanceId']}/party");
                }
                $targetPokemon = $rows[$i];
                $affectedPokemon = $rows[$i - 1];
            }
        }

        if (!isset($targetPokemon)) {
            $this->session->getFlashBag()->add("errors", "Target Pokémon not found");
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        if (!isset($affectedPokemon)) {
            $this->session->getFlashBag()->add("errors", "Affected Pokémon not found");
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $this->db->beginTransaction();

        $this->db->update("caught_pokemon", [
            'party_position' => $targetPokemon['party_position'] - 1,
        ], [
            'id' => $targetPokemon['id'],
        ]);

        $this->db->update("caught_pokemon", [
            'party_position' => $affectedPokemon['party_position'] + 1,
        ], [
            'id' => $affectedPokemon['id'],
        ]);

        $this->db->commit();

        return new RedirectResponse("/{$args['instanceId']}/party");
    }
}