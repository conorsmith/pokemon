<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use ConorSmith\Pokemon\PokemonType;
use Exception;

final class Type
{
    public function __construct(
        public readonly int $primaryType,
        public readonly ?int $secondaryType,
    ) {}

    public function getPrimaryAttackingEffectiveness(): array
    {
        return PokemonType::getAttackingMultipliers($this->primaryType);
    }

    public function getSecondaryAttackingEffectiveness(): array
    {
        if (is_null($this->secondaryType)) {
            throw new Exception;
        }

        return PokemonType::getAttackingMultipliers($this->secondaryType);
    }

    public function getDefendingEffectiveness(): array
    {
        if (is_null($this->secondaryType)) {
            return PokemonType::getDefendingMultipliers($this->primaryType);
        }

        $primaryMultipliers = PokemonType::getDefendingMultipliers($this->primaryType);
        $secondaryMultipliers = PokemonType::getDefendingMultipliers($this->secondaryType);

        $types = array_keys($primaryMultipliers);

        $combinedMultipliers = [];

        foreach ($types as $type) {
            $combinedMultipliers[$type] = $primaryMultipliers[$type] * $secondaryMultipliers[$type];
        }

        return $combinedMultipliers;
    }
}
