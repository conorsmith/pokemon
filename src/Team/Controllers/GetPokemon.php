<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\LocationType;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use stdClass;

final class GetPokemon
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(array $args): void
    {
        $pokemonId = $args['id'];

        $pokemon = $this->pokemonRepository->find($pokemonId);

        echo $this->templateEngine->render(__DIR__ . "/../Templates/Pokemon.php", [
            'pokemon' => PokemonVm::create($pokemon),
            'capture' => $this->createCaptureVm($pokemon),
            'stats' => self::createStatsVm($pokemon),
            'typeEffectiveness' => self::createTypeEffectivenessVms($pokemon),
        ]);
    }

    private function createCaptureVm(Pokemon $pokemon): stdClass
    {
        $locationConfig = $this->locationConfigRepository->findLocation($pokemon->caughtLocation->locationId);

        return (object) [
            'location' => $locationConfig['name'],
            'region' => match ($locationConfig['region']) {
                RegionId::KANTO => "Kanto",
                RegionId::JOHTO => "Johto",
                RegionId::HOENN => "Hoenn",
            },
            'preposition' => match ($locationConfig['type']) {
                LocationType::ROUTE => "on",
                LocationType::CITY => "in",
                LocationType::CAVE => "in",
                LocationType::TOWER => "in",
                default => "on",
            },
        ];
    }

    private static function createStatsVm(Pokemon $pokemon): stdClass
    {
        return (object) [
            'physicalAttack'  => (object) [
                'total'       => $pokemon->physicalAttack->calculate($pokemon->level),
                'base'        => $pokemon->physicalAttack->baseValue,
                'ev'          => $pokemon->physicalAttack->ev,
                'ivDeviation' => self::createIvDeviationVm($pokemon->physicalAttack->iv),
            ],
            'physicalDefence' => (object) [
                'total'       => $pokemon->physicalDefence->calculate($pokemon->level),
                'base'        => $pokemon->physicalDefence->baseValue,
                'ev'          => $pokemon->physicalDefence->ev,
                'ivDeviation' => self::createIvDeviationVm($pokemon->physicalDefence->iv),
            ],
            'specialAttack'   => (object) [
                'total'       => $pokemon->specialAttack->calculate($pokemon->level),
                'base'        => $pokemon->specialAttack->baseValue,
                'ev'          => $pokemon->specialAttack->ev,
                'ivDeviation' => self::createIvDeviationVm($pokemon->specialAttack->iv),
            ],
            'specialDefence'  => (object) [
                'total'       => $pokemon->specialDefence->calculate($pokemon->level),
                'base'        => $pokemon->specialDefence->baseValue,
                'ev'          => $pokemon->specialDefence->ev,
                'ivDeviation' => self::createIvDeviationVm($pokemon->specialDefence->iv),
            ],
            'speed'           => (object) [
                'total'       => $pokemon->speed->calculate($pokemon->level),
                'base'        => $pokemon->speed->baseValue,
                'ev'          => $pokemon->speed->ev,
                'ivDeviation' => self::createIvDeviationVm($pokemon->speed->iv),
            ],
            'hp'              => (object) [
                'total'       => $pokemon->hp->calculate($pokemon->level),
                'base'        => $pokemon->hp->baseValue,
                'ev'          => $pokemon->hp->ev,
                'ivDeviation' => self::createIvDeviationVm($pokemon->hp->iv),
            ],
        ];
    }

    private static function createIvDeviationVm(int $iv): stdClass
    {
        $deviation = $iv - 16;

        return (object) [
            'class' => $deviation === 0
                ? ""
                : ($deviation > 0 ? "positive" : "negative"),
            'value' => ($deviation > 0 ? "+" : "") . round($deviation / 0.16) . "%",
        ];
    }

    private static function createTypeEffectivenessVms(Pokemon $pokemon): stdClass
    {
        return (object) [
            'primaryAttacking' => self::createTypeEffectivenessVm($pokemon->type->getPrimaryAttackingEffectiveness()),
            'secondaryAttacking' => $pokemon->hasSecondaryType()
                ? self::createTypeEffectivenessVm($pokemon->type->getSecondaryAttackingEffectiveness())
                : null,
            'defending' => self::createTypeEffectivenessVm($pokemon->type->getDefendingEffectiveness()),
        ];
    }

    private static function createTypeEffectivenessVm(array $effectiveness): stdClass
    {
        $vm = (object) [
            'increase' => [],
            'decrease' => [],
        ];

        arsort($effectiveness);

        foreach ($effectiveness as $type => $multiplier) {
            if ($multiplier > 1.0) {
                $vm->increase[ViewModelFactory::createPokemonTypeName($type)] = match ($multiplier) {
                    4.0 => "4",
                    2.0 => "2",
                };
            } elseif ($multiplier < 1.0) {
                $vm->decrease[ViewModelFactory::createPokemonTypeName($type)] = match ($multiplier) {
                    0.5 => "½",
                    0.25 => "¼",
                    0.0 => "0",
                };
            }
        }

        return $vm;
    }
}
