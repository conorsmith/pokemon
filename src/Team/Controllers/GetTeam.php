<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetTeam
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function __invoke(): void
    {
        $team = $this->pokemonRepository->getTeam();
        $box = $this->pokemonRepository->getBox();

        $successes = $this->session->getFlashBag()->get("successes");
        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Team.php", [
            'team' => array_map(
                fn(Pokemon $pokemon) => PokemonVm::create($pokemon),
                $team->members
            ),
            'box' => array_map(
                fn(Pokemon $pokemon) => PokemonVm::create($pokemon),
                $box
            ),
            'successes' => $successes,
            'errors' => $errors,
        ]);
    }
}
