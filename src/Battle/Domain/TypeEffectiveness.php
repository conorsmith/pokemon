<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;

final class TypeEffectiveness
{
    public static function calculate(Attack $attack, Pokemon $attacker, Pokemon $defender): float
    {
        $primaryTypeMultiplier = self::calculatePrimaryTypeMultiplier($attacker, $defender);
        $secondaryTypeMultiplier = 0.0;

        if (!is_null($attacker->secondaryType)) {
            $secondaryTypeMultiplier = self::calculateSecondaryTypeMultiplier($attacker, $defender);
        }

        if ($attack->isPrimaryType()) {
            return $primaryTypeMultiplier;

        } elseif ($attack->isSecondaryType()) {
            return $secondaryTypeMultiplier;

        } else {
            return max($primaryTypeMultiplier, $secondaryTypeMultiplier);
        }
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
}
