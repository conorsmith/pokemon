<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels;

use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
use LogicException;

final class EncounterTypeVm
{
    public static function fromDomain(string $encounterType): self
    {
        return new self(
            $encounterType,
            match ($encounterType) {
                EncounterType::WALKING    => "fas fa-shoe-prints",
                EncounterType::SURFING    => "fas fa-water",
                EncounterType::FISHING    => "fas fa-fish",
                EncounterType::ROCK_SMASH => "fab fa-sith",
                EncounterType::HEADBUTT   => "fas fa-tree",
                default                   => throw new LogicException(),
            },
        );
    }

    public function __construct(
        public readonly string $id,
        public readonly string $classes,
    ) {}
}
