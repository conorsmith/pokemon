<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Domain\AttackOutcome;
use ConorSmith\Pokemon\Battle\Domain\Encounter;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\ViewModelFactory;

final class EventFactory
{
    public function __construct(
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function createBattleRoundEvents(
        AttackOutcome $attack,
        Pokemon $attacker,
        Pokemon $defender,
        bool $isPlayerDefending,
        ?Pokemon $nextDefender,
        string $opponentName
    ): array {
        $events = [];

        $attackerVm = $this->viewModelFactory->createPokemonInBattle($attacker);
        $attackerDescriptor = $isPlayerDefending ? "Foe" : "Your";

        $defenderVm = $this->viewModelFactory->createPokemonInBattle($defender);
        $defenderDescriptor = $isPlayerDefending ? "Your" : "Foe";

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
                $events[] =  $this->createMessageEvent("{$defenderDescriptor} {$defenderVm->name} fainted");

                $events[] = $this->createFaintingEvent($defender->id, $isPlayerDefending, $nextDefender);

                if ($nextDefender) {
                    $nextDefenderVm = $this->viewModelFactory->createPokemonInBattle($nextDefender);
                    if ($isPlayerDefending) {
                        $events[] = $this->createMessageEvent("Go {$nextDefenderVm->name}!");
                    } else {
                        $events[] = $this->createMessageEvent("{$opponentName} sent out {$nextDefenderVm->name}");
                    }
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
        bool $isLegendary,
    ): array {
        $events = [];

        $attackerVm = $this->viewModelFactory->createPokemonInBattle($attacker);
        $attackerDescriptor = $isPlayerDefending ? ($isLegendary ? "Legendary" : "Wild") : "Your";

        $defenderVm = $this->viewModelFactory->createPokemonInBattle($defender);
        $defenderDescriptor = $isPlayerDefending ? "Your" : ($isLegendary ? "Legendary" : "Wild");

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
                $events[] =  $this->createMessageEvent("{$defenderDescriptor} {$defenderVm->name} fainted");

                $events[] = $this->createFaintingEvent($defender->id, $isPlayerDefending, $nextDefender);

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
            'type' => "message",
            'value' => $message,
        ];
    }

    private function createDamageEvent(string $id, int $damage, int $remaining, int $total): array
    {
        return [
            'type' => "damage",
            'target' => $id,
            'value' => [
                'damage' => $damage,
                'remaining' => $remaining,
                'total' => $total,
            ],
        ];
    }

    private function createFaintingEvent(string $id, bool $isPlayerPokemon, ?Pokemon $nextPokemon): array
    {
        return [
            'type' => "fainting",
            'target' => $id,
            'isPlayerPokemon' => $isPlayerPokemon,
            'next' => $nextPokemon ? $this->viewModelFactory->createPokemonInBattle($nextPokemon) : null,
        ];
    }

    public function createEncounterDefeatEvent(Encounter $encounter): array
    {
        $pokemonVm = $this->viewModelFactory->createPokemonInBattle($encounter->pokemon);
        $name = $encounter->isLegendary
            ? "the legendary Pokémon {$pokemonVm->name}"
            : "a wild {$pokemonVm->name}";
        return $this->createMessageEvent("You were defeated by {$name}");
    }
}
