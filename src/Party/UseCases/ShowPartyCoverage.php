<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\UseCases;

use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\Domain\Type;
use ConorSmith\Pokemon\Party\ViewModels\PartyCoverage;
use ConorSmith\Pokemon\ViewModelFactory;
use stdClass;

final class ShowPartyCoverage
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): PartyCoverage
    {
        $party = $this->pokemonRepository->getParty();

        $coverage = Type::aggregateAttackingEffectiveness(
            array_map(fn(Pokemon $pokemon) => $pokemon->type, $party->members)
        );

        $coverage = self::createCoverageVms($coverage);

        return new PartyCoverage(
            $coverage->increase,
            $coverage->unmodified,
            $coverage->decrease,
            $coverage->zero,
            $coverage->counts,
        );
    }

    private static function createCoverageVms(array $coverage): stdClass
    {
        $vm = (object) [
            'increase'   => [],
            'unmodified' => [],
            'decrease'   => [],
            'zero'       => [],
            'counts'     => (object) [
                'increase'   => 0,
                'unmodified' => 0,
                'decrease'   => 0,
                'zero'       => 0,
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
