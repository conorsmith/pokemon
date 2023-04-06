<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\Type;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use stdClass;

final class GetTeam
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(): void
    {
        $team = $this->pokemonRepository->getTeam();
        $dayCare = $this->pokemonRepository->getDayCare();
        $box = $this->pokemonRepository->getBox();

        $coverage = Type::aggregateAttackingEffectiveness(
            array_map(fn(Pokemon $pokemon) => $pokemon->type, $team->members)
        );

        echo $this->templateEngine->render(__DIR__ . "/../Templates/Team.php", [
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
        ]);
    }

    private static function createCoverageVms(array $coverage): stdClass
    {
        $vm = (object) [
            'increase' => [],
            'unmodified' => [],
            'decrease' => [],
            'zero' => [],
            'counts' => (object) [
                'increase' => 0,
                'unmodified' => 0,
                'decrease' => 0,
                'zero' => 0,
            ],
        ];

        foreach ($coverage as $typeId => $multiplier) {
            if ($multiplier > 1.0) {
                $vm->increase[ViewModelFactory::createPokemonTypeName($typeId)] = $multiplier;
                $vm->counts->increase++;
            } elseif ($multiplier === 1.0) {
                $vm->unmodified[ViewModelFactory::createPokemonTypeName($typeId)] = $multiplier;
                $vm->counts->unmodified++;
            } elseif ($multiplier === 0.0) {
                $vm->zero[ViewModelFactory::createPokemonTypeName($typeId)] = $multiplier;
                $vm->counts->zero++;
            } else {
                $vm->decrease[ViewModelFactory::createPokemonTypeName($typeId)] = $multiplier;
                $vm->counts->decrease++;
            }
        }

        return $vm;
    }
}
