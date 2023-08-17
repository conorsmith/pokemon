<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Domain;

use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Gender;
use ConorSmith\Pokemon\GymBadge;

final class TrainerFactory
{
    public static function create(
        string $id = "dontcare",
        ?string $name = null,
        string $class = "dontcare",
        Gender $gender = Gender::IMMATERIAL,
        array $team = [],
        string $locationId = "dontcare",
        bool $isBattling = false,
        ?GymBadge $gymBadge = null,
    ): Trainer {
        return new Trainer(
            $id,
            $name,
            $class,
            $gender,
            $team,
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
