<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\AttackOutcome;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Encounter;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;

final class EventFactory
{
    public function __construct(
        private readonly ViewModelFactory $viewModelFactory,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function createBattleRoundEvents(
        AttackOutcome $attack,
        Pokemon $attacker,
        Pokemon $defender,
        bool $isPlayerDefending,
        ?Pokemon $nextDefender,
        string $attackerDescriptor,
        string $defenderDescriptor,
        string $defenderName,
    ): array {
        $events = [];

        $attackerVm = $this->viewModelFactory->createPokemonInBattle($attacker);
        $defenderVm = $this->viewModelFactory->createPokemonInBattle($defender);

        if ($attack->hit) {

            $events[] = $this->createMessageEvent("{$attackerDescriptor} {$attackerVm->name}'s attack hit!");

            if ($attack->superEffective) {
                $events[] = $this->createMessageEvent("It's super effective!");
            } elseif ($attack->notVeryEffective) {
                $events[] = $this->createMessageEvent("It's not very effective");
            }
            if ($attack->criticalHit) {
                $events[] = $this->createMessageEvent("It's a critical hit!");
            }

            $events[] = $this->createDamageEvent(
                $defender->id,
                $attack->damageDealt,
                $defender->remainingHp,
                $defender->calculateHp()
            );

            $events[] = $this->createMessageEvent("{$defenderDescriptor} {$defenderVm->name} took {$attack->damageDealt} damage");

            if ($attack->enduredHit) {
                $events[] = $this->createMessageEvent("{$defenderDescriptor} {$defenderVm->name} endured through the power of friendship!");

            } elseif ($defender->hasFainted) {
                $events[] = $this->createMessageEvent("{$defenderDescriptor} {$defenderVm->name} fainted");

                $events[] = $this->createFaintingEvent($defender->id, $isPlayerDefending, $nextDefender, $attacker);

                if ($nextDefender) {
                    $nextDefenderVm = $this->viewModelFactory->createPokemonInBattle($nextDefender);
                    $events[] = $this->createMessageEvent("{$defenderName} sent out {$nextDefenderVm->name}");
                }
            }
        } elseif (!$attacker->hasFainted) {
            $events[] = $this->createMessageEvent("{$attackerDescriptor} {$attackerVm->name}'s attack missed!");
        }

        return $events;
    }

    public function createEncounterRoundEvents(
        AttackOutcome $attack,
        Pokemon $attacker,
        Pokemon $defender,
        bool $isPlayerDefending,
        ?Pokemon $nextDefender,
    ): array {
        $events = [];

        $attackerVm = $this->viewModelFactory->createPokemonInBattle($attacker);
        $attackerDescriptor = $isPlayerDefending ? ($attackerVm->isLegendary ? "Legendary" : "Wild") : "Your";

        $defenderVm = $this->viewModelFactory->createPokemonInBattle($defender);
        $defenderDescriptor = $isPlayerDefending ? "Your" : ($defenderVm->isLegendary ? "Legendary" : "Wild");

        if ($attack->hit) {

            $events[] = $this->createMessageEvent("{$attackerDescriptor} {$attackerVm->name}'s attack hit!");

            if ($attack->superEffective) {
                $events[] = $this->createMessageEvent("It's super effective!");
            } elseif ($attack->notVeryEffective) {
                $events[] = $this->createMessageEvent("It's not very effective");
            }
            if ($attack->criticalHit) {
                $events[] = $this->createMessageEvent("It's a critical hit!");
            }

            $events[] = $this->createDamageEvent(
                $defender->id,
                $attack->damageDealt,
                $defender->remainingHp,
                $defender->calculateHp()
            );

            $events[] = $this->createMessageEvent("{$defenderDescriptor} {$defenderVm->name} took {$attack->damageDealt} damage");

            if ($attack->enduredHit) {
                $events[] = $this->createMessageEvent("{$defenderDescriptor} {$defenderVm->name} endured through the power of friendship!");

            } elseif ($defender->hasFainted) {
                $events[] = $this->createMessageEvent("{$defenderDescriptor} {$defenderVm->name} fainted");

                $events[] = $this->createFaintingEvent($defender->id, $isPlayerDefending, $nextDefender, $attacker);

                if ($nextDefender) {
                    $nextDefenderVm = $this->viewModelFactory->createPokemonInBattle($nextDefender);
                    if ($isPlayerDefending) {
                        $events[] = $this->createMessageEvent("Go {$nextDefenderVm->name}!");
                    }
                }
            }
        } elseif (!$attacker->hasFainted) {
            $events[] = $this->createMessageEvent("{$attackerDescriptor} {$attackerVm->name}'s attack missed!");
        }

        return $events;
    }

    public function createMessageEvent(string $message): array
    {
        return [
            'type'  => "message",
            'value' => $message,
        ];
    }

    private function createDamageEvent(string $id, int $damage, int $remaining, int $total): array
    {
        return [
            'type'   => "damage",
            'target' => $id,
            'value'  => [
                'damage'    => $damage,
                'remaining' => $remaining,
                'total'     => $total,
            ],
        ];
    }

    private function createFaintingEvent(string $id, bool $isPlayerPokemon, ?Pokemon $nextPokemon, Pokemon $attacker): array
    {
        return [
            'type'            => "fainting",
            'target'          => $id,
            'isPlayerPokemon' => $isPlayerPokemon,
            'next'            => !$nextPokemon
                ? null
                : [
                    'pokemon'                    => $this->viewModelFactory->createPokemonInBattle($nextPokemon),
                    'primaryTypeEffectiveness'   => $isPlayerPokemon
                        ? TypeEffectiveness::create("primary", $nextPokemon, $attacker)
                        : TypeEffectiveness::create("primary", $attacker, $nextPokemon),
                    'secondaryTypeEffectiveness' => $isPlayerPokemon
                        ? TypeEffectiveness::create("secondary", $nextPokemon, $attacker)
                        : TypeEffectiveness::create("secondary", $attacker, $nextPokemon),
                ],
        ];
    }

    public function createEncounterDefeatEvent(Encounter $encounter): array
    {
        $pokemonVm = $this->viewModelFactory->createPokemonInBattle($encounter->pokemon);
        $name = $pokemonVm->isLegendary
            ? "the legendary Pokémon {$pokemonVm->name}"
            : "a wild {$pokemonVm->name}";
        return $this->createMessageEvent("You were defeated by {$name}");
    }

    public function createCatchSuccessEvent(Encounter $encounter, float $catchRate): array
    {
        $pokemonVm = $this->viewModelFactory->createPokemonInBattle($encounter->pokemon);
        $name = $pokemonVm->isLegendary
            ? "the legendary Pokémon {$pokemonVm->name}"
            : "the wild {$pokemonVm->name}";
        return [
            'type'  => "caught",
            'value' => "You caught {$name}!",
            'rate'  => $catchRate,
        ];
    }

    public function createCatchFailureEvent(Encounter $encounter): array
    {
        $pokemonVm = $this->viewModelFactory->createPokemonInBattle($encounter->pokemon);
        $name = $pokemonVm->isLegendary
            ? "the legendary Pokémon {$pokemonVm->name}"
            : "the wild {$pokemonVm->name}";
        return $this->createMessageEvent("You failed to catch {$name}");
    }

    public function createCaughtPokemonSentToBoxEvent(Encounter $encounter): array
    {
        $pokemonVm = $this->viewModelFactory->createPokemonInBattle($encounter->pokemon);
        return $this->createMessageEvent("{$pokemonVm->name} was sent to your box");
    }

    public function createShakeEvent(float $catchRate, float $shakeProbability, int $shakeRoll): array
    {
        return [
            'type'  => "shake",
            'rate'  => $catchRate,
            'shake' => $shakeProbability,
            'roll'  => $shakeRoll,
        ];
    }

    public function createPokedexRegistrationEvent(Encounter $encounter): array
    {
        $pokemonVm = $this->viewModelFactory->createPokemonInBattle($encounter->pokemon);
        return $this->createMessageEvent("{$pokemonVm->name} has been registered in your Pokédex");
    }

    public function createLegendaryUnlockEvent(string $pokedexNumber): array
    {
        $pokedexConfig = $this->pokedexConfigRepository->find($pokedexNumber);
        return $this->createMessageEvent("The legendary Pokémon {$pokedexConfig['name']} has been sighted!");
    }

    public function createStrengthIndicatorProgressesEvent(Encounter $encounter): array
    {
        $pokemonVm = $this->viewModelFactory->createPokemonInBattle($encounter->pokemon);

        $descriptor = $pokemonVm->isLegendary ? "legendary Pokémon" : "wild";

        return [
            'type'     => "strengthIndicatorProgresses",
            'value'    => "You learn more about the strengths of the {$descriptor} {$pokemonVm->name}",
            'progress' => $encounter->strengthIndicatorProgress,
        ];
    }
}
