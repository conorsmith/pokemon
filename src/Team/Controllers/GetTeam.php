<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\Type;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
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
        $dayCare = $this->pokemonRepository->getDayCare();
        $box = $this->pokemonRepository->getBox();

        $coverage = Type::aggregateAttackingEffectiveness(
            array_map(fn(Pokemon $pokemon) => $pokemon->type, $team->members)
        );

        $successes = $this->session->getFlashBag()->get("successes");
        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Team.php", [
            'team' => array_map(
                fn(Pokemon $pokemon) => PokemonVm::create($pokemon),
                $team->members
            ),
            'dayCare' => array_map(
                fn(Pokemon $pokemon) => PokemonVm::create($pokemon),
                $dayCare->attendees
            ),
            'box' => array_map(
                fn(Pokemon $pokemon) => PokemonVm::create($pokemon),
                $box
            ),
            'dayCareLimit' => $dayCare->availablePlaces,
            'teamIsFull' => $team->isFull(),
            'dayCareIsFull' => $dayCare->isFull(),
            'teamHasSingleRemainingMember' => count($team->members) === 1,
            'coverage' => self::createCoverageVms($coverage),
            'successes' => $successes,
            'errors' => $errors,
        ]);
    }

    private static function createCoverageVms(array $coverage): array
    {
        $vms = [];

        foreach ($coverage as $typeId => $multiplier) {
            if ($multiplier !== 1.0) {
                $vms[ViewModelFactory::createPokemonTypeName($typeId)] = $multiplier;
            }
        }

        return $vms;
    }
}
