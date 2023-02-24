<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\PokemonType;

final class Round
{
    public static function execute(Pokemon $playerPokemon, Pokemon $opponentPokemon, string $playerAttackType): self
    {
        if ($opponentPokemon->calculateAttack() > $opponentPokemon->calculateSpecialAttack()) {
            $opponentAttackType = "physical";
        } elseif ($opponentPokemon->calculateAttack() < $opponentPokemon->calculateSpecialAttack()) {
            $opponentAttackType = "special";
        } else {
            $opponentAttackType = mt_rand(0, 1) === 0 ? "physical" : "special";
        }

        if ($playerPokemon->calculateSpeed() > $opponentPokemon->calculateSpeed()) {
            $playerGoesFirst = true;
        } elseif ($playerPokemon->calculateSpeed() < $opponentPokemon->calculateSpeed()) {
            $playerGoesFirst = false;
        } else {
            $playerGoesFirst = mt_rand(0, 1) === 0;
        }

        if ($playerGoesFirst) {
            $firstPokemon = $playerPokemon;
            $secondPokemon = $opponentPokemon;
            $firstAttackType = $playerAttackType;
            $secondAttackType = $opponentAttackType;
        } else {
            $firstPokemon = $opponentPokemon;
            $secondPokemon = $playerPokemon;
            $firstAttackType = $opponentAttackType;
            $secondAttackType = $playerAttackType;
        }

        $firstAttackOutcome = self::attack($firstPokemon, $secondPokemon, $firstAttackType);
        $secondAttackOutcome = self::attack($secondPokemon, $firstPokemon, $secondAttackType);

        return new self($playerGoesFirst, $firstPokemon, $secondPokemon, $firstAttackOutcome, $secondAttackOutcome);
    }

    private static function attack(Pokemon $attacker, Pokemon $defender, string $attackType): AttackOutcome
    {
        $typeMultiplier = 1.0;

        $hit = !$attacker->hasFainted
            && mt_rand(1, 100) <= self::calculateAccuracy($attacker, $defender);

        if ($hit) {
            $criticalHit = self::calculateCriticalHit($attacker, $defender);
            $typeMultiplier = self::calculateTypeMultiplier($attacker, $defender);
            $damageTaken = min(
                $defender->remainingHp,
                self::calculateDamage($attacker, $defender, $attackType, $criticalHit, $typeMultiplier),
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
        return match (true) {
            $defender->friendship < 180   => false,
            $defender->friendship < 220   => mt_rand(1, 100) <= 10,
            $defender->friendship < 255   => mt_rand(1, 100) <= 15,
            $defender->friendship === 255 => mt_rand(1, 100) <= 20,
        };
    }

    private static function calculateDamage(
        Pokemon $attacker,
        Pokemon $defender,
        string $attackType,
        bool $isCriticalHit,
        float $typeMultiplier,
    ): int {
        $power = 40;

        $levelFactor = (2 * $attacker->level / 5) + 2;
        if ($attackType === "physical") {
            $statFactor = $attacker->calculateAttack() / $defender->calculateDefence();
        } else {
            $statFactor = $attacker->calculateSpecialAttack() / $defender->calculateSpecialDefence();
        }

        $baseDamage = ($levelFactor * $power * $statFactor / 50) + 2;

        $randomFactor = mt_rand(85, 100) / 100;

        $criticalFactor = $isCriticalHit ? 1.5 : 1;

        return intval(round($baseDamage * $randomFactor * $typeMultiplier * $criticalFactor));
    }

    private static function calculateCriticalHit(Pokemon $attacker, Pokemon $defender): bool
    {
        return mt_rand(1, 24) === 1;
    }

    private static function calculateTypeMultiplier(Pokemon $attacker, Pokemon $defender): float
    {
        $primaryTypeMultiplier = self::calculatePrimaryTypeMultiplier($attacker, $defender);
        $secondaryTypeMultiplier = 0.0;

        if (!is_null($attacker->secondaryType)) {
            $secondaryTypeMultiplier = self::calculateSecondaryTypeMultiplier($attacker, $defender);
        }

        return max($primaryTypeMultiplier, $secondaryTypeMultiplier);
    }

    private static function calculatePrimaryTypeMultiplier(Pokemon $attacker, Pokemon $defender): float
    {
        $multiplier = 1.0;

        $multiplier *= PokemonType::getMultiplier($attacker->primaryType, $defender->primaryType);

        if (!is_null($defender->secondaryType)) {
            $multiplier *= PokemonType::getMultiplier($attacker->primaryType, $defender->secondaryType);
        }

        return $multiplier;
    }

    private static function calculateSecondaryTypeMultiplier(Pokemon $attacker, Pokemon $defender): float
    {
        $multiplier = 1.0;

        $multiplier *= PokemonType::getMultiplier($attacker->secondaryType, $defender->primaryType);

        if (!is_null($defender->secondaryType)) {
            $multiplier *= PokemonType::getMultiplier($attacker->secondaryType, $defender->secondaryType);
        }

        return $multiplier;
    }

    public function __construct(
        public readonly bool $playerFirst,
        public readonly Pokemon $firstPokemon,
        public readonly Pokemon $secondPokemon,
        public readonly AttackOutcome $firstAttack,
        public readonly AttackOutcome $secondAttack,
    ) {}
}
