<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use LogicException;

final class Round
{
    public static function execute(
        Pokemon $pokemonA,
        Pokemon $pokemonB,
        Attack $pokemonAAttack,
        Attack $pokemonBAttack,
    ): self {
        if ($pokemonA->calculateSpeed() > $pokemonB->calculateSpeed()) {
            $pokemonAGoesFirst = true;
        } elseif ($pokemonA->calculateSpeed() < $pokemonB->calculateSpeed()) {
            $pokemonAGoesFirst = false;
        } else {
            $pokemonAGoesFirst = RandomNumberGenerator::coinToss();
        }

        if ($pokemonAGoesFirst) {
            $firstPokemon = $pokemonA;
            $secondPokemon = $pokemonB;
            $firstAttack = $pokemonAAttack;
            $secondAttack = $pokemonBAttack;
        } else {
            $firstPokemon = $pokemonB;
            $secondPokemon = $pokemonA;
            $firstAttack = $pokemonBAttack;
            $secondAttack = $pokemonAAttack;
        }

        $firstAttackOutcome = self::attack($firstPokemon, $secondPokemon, $firstAttack);
        $secondAttackOutcome = self::attack($secondPokemon, $firstPokemon, $secondAttack);

        return new self(
            $pokemonAGoesFirst,
            $firstPokemon,
            $secondPokemon,
            $firstAttackOutcome,
            $secondAttackOutcome,
        );
    }

    private static function attack(Pokemon $attacker, Pokemon $defender, Attack $attack): AttackOutcome
    {
        $typeMultiplier = 1.0;

        $hit = !$attacker->hasFainted
            && mt_rand(1, 100) <= self::calculateAccuracy($attacker, $defender);

        if ($hit) {
            $criticalHit = self::calculateCriticalHit($attacker, $defender);
            $typeMultiplier = TypeEffectiveness::calculate($attack, $attacker, $defender);
            $damageTaken = min(
                $defender->remainingHp,
                self::calculateDamage($attacker, $defender, $attack, $criticalHit, $typeMultiplier),
            );
            if ($damageTaken === $defender->remainingHp) {
                $survivedHit = self::calculateHitSurvival($defender);
                if ($survivedHit) {
                    $damageTaken = $defender->remainingHp - 1;
                }
            }
            $defender->hitFor($damageTaken);
        }

        return new AttackOutcome(
            $hit,
            $criticalHit ?? false,
            $typeMultiplier > 1.0,
            $typeMultiplier < 1.0,
            $survivedHit ?? false,
            $damageTaken ?? 0
        );
    }

    private static function calculateAccuracy(Pokemon $attacker, Pokemon $defender): int
    {
        $baseAccuracy = 95;

        $friendshipFactor = $defender->friendship === 255 ? 4 : 0;

        return $baseAccuracy + $friendshipFactor;
    }

    private static function calculateHitSurvival(Pokemon $defender): bool
    {
        if ($defender->remainingHp === 1) {
            return false;
        }

        return match (true) {
            $defender->friendship < 180   => false,
            $defender->friendship < 220   => mt_rand(1, 100) <= 10,
            $defender->friendship < 255   => mt_rand(1, 100) <= 15,
            $defender->friendship === 255 => mt_rand(1, 100) <= 20,
            default                       => new LogicException(),
        };
    }

    private static function calculateDamage(
        Pokemon $attacker,
        Pokemon $defender,
        Attack $attack,
        bool $isCriticalHit,
        float $typeMultiplier,
    ): int {
        $power = 40;

        $levelFactor = (2 * $attacker->level / 5) + 2;
        if ($attack->isPhysical()) {
            $statFactor = $attacker->calculateAttack() / $defender->calculateDefence();
        } else {
            $statFactor = $attacker->calculateSpecialAttack() / $defender->calculateSpecialDefence();
        }

        $baseDamage = ($levelFactor * $power * $statFactor / 50) + 2;

        $randomFactor = mt_rand(85, 100) / 100;

        $typeEnhancingItemFactor = self::calculateTypeEnhancingItemFactor($attacker, $attack);

        $criticalFactor = $isCriticalHit ? 1.5 : 1;

        return intval(round(
            $baseDamage
            * $randomFactor
            * $typeMultiplier
            * $typeEnhancingItemFactor
            * $criticalFactor
        ));
    }

    private static function calculateTypeEnhancingItemFactor(Pokemon $attacker, Attack $attack): float
    {
        $value = 1.0;

        if (($attack->isPrimaryType() && $attacker->doesHeldItemEnhancePrimaryType())
            || ($attack->isSecondaryType() && $attacker->doesHeldItemEnhanceSecondaryType())) {
            $value *= 1.2;
        }

        return $value;
    }

    private static function calculateCriticalHit(Pokemon $attacker, Pokemon $defender): bool
    {
        return mt_rand(1, 24) === 1;
    }

    public function __construct(
        public readonly bool $playerFirst,
        public readonly Pokemon $firstPokemon,
        public readonly Pokemon $secondPokemon,
        public readonly AttackOutcome $firstAttack,
        public readonly AttackOutcome $secondAttack,
    ) {}
}
