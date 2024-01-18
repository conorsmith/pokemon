<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\Domain\DayCare;
use ConorSmith\Pokemon\Party\Domain\Party;
use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationType;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use LogicException;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPokemon
{
    public function __construct(
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $args['id'];

        $pokemon = $this->pokemonRepository->find($pokemonId);

        $party = $this->pokemonRepository->getParty();
        $dayCare = $this->pokemonRepository->getDayCare();

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Pokemon.php", [
            'pokemon'           => PokemonVm::create($pokemon),
            'capture'           => $this->createCaptureVm($pokemon),
            'location'          => $this->createLocationVm($pokemon, $party, $dayCare),
            'stats'             => self::createStatsVm($pokemon),
            'typeEffectiveness' => self::createTypeEffectivenessVms($pokemon),
        ]));
    }

    private function createLocationVm(Pokemon $pokemon, Party $party, DayCare $dayCare): stdClass
    {
        return (object) [
            'isInParty'        => $party->contains($pokemon->id),
            'isInDayCare'      => $dayCare->hasAttendee($pokemon->id),
            'isInBox'          => !$party->contains($pokemon->id) && !$dayCare->hasAttendee($pokemon->id),
            'canSendToParty'   => !$party->isFull(),
            'canSendToDayCare' => !$dayCare->isFull(),
            'canSendToBox'     => true,
        ];
    }

    private function createCaptureVm(Pokemon $pokemon): stdClass
    {
        $locationConfig = $this->locationConfigRepository->findLocation($pokemon->caughtLocation->locationId);

        return (object) [
            'location'    => $locationConfig['name'],
            'region'      => match ($locationConfig['region']) {
                RegionId::KANTO => "Kanto",
                RegionId::JOHTO => "Johto",
                RegionId::HOENN => "Hoenn",
                default         => throw new LogicException(),
            },
            'preposition' => match ($locationConfig['type'] ?? null) {
                LocationType::ROUTE => "on",
                LocationType::CITY  => "in",
                LocationType::CAVE  => "in",
                LocationType::TOWER => "in",
                default             => "at",
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

        if ($deviation >= 0) {
            $deviation++;
        }

        return (object) [
            'class' => $deviation > 0 ? "positive" : "negative",
            'value' => ($deviation > 0 ? "+" : "") . round($deviation / 0.16) . "%",
        ];
    }

    private static function createTypeEffectivenessVms(Pokemon $pokemon): stdClass
    {
        return (object) [
            'primaryAttacking'   => self::createTypeEffectivenessVm($pokemon->type->getPrimaryAttackingEffectiveness()),
            'secondaryAttacking' => $pokemon->hasSecondaryType()
                ? self::createTypeEffectivenessVm($pokemon->type->getSecondaryAttackingEffectiveness())
                : null,
            'defending'          => self::createTypeEffectivenessVm($pokemon->type->getDefendingEffectiveness()),
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
                    4.0     => "4",
                    2.0     => "2",
                    default => throw new LogicException(),
                };
            } elseif ($multiplier < 1.0) {
                $vm->decrease[ViewModelFactory::createPokemonTypeName($type)] = match ($multiplier) {
                    0.5     => "½",
                    0.25    => "¼",
                    0.0     => "0",
                    default => throw new LogicException(),
                };
            }
        }

        return $vm;
    }
}
