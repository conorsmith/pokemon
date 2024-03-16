<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Domain\Battle;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\Trainer;
use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;

final class TrainerFactory
{
    public static function create(
        string $id = "dontcare",
        ?string $name = null,
        string $class = "dontcare",
        Gender $gender = Gender::IMMATERIAL,
        array $party = [],
        string $locationId = "dontcare",
        bool $isBattling = false,
        ?GymBadge $gymBadge = null,
    ): Trainer {
        return new Trainer(
            $id,
            $name,
            $class,
            $gender,
            $party,
            $locationId,
            $isBattling,
            $gymBadge,
        );
    }

    public static function any(): Trainer
    {
        return self::create();
    }
}
