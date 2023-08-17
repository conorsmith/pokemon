<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use ConorSmith\Pokemon\SharedKernel\Clock;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class Evolution
{
    public function __construct(
        public readonly string $evolvedPokedexNumber,
        private readonly ?int $minimumLevel,
        private readonly bool $minimumFriendship,
        private readonly ?string $specificTime,
        private readonly ?string $stats,
    ) {}

    public function isTriggered(Pokemon $pokemon, int $level): bool
    {
        $requirements = [];

        if (!is_null($this->minimumLevel)) {
            $regionalLevelOffset = match ($pokemon->caughtLocation->region) {
                RegionId::KANTO => 0,
                RegionId::JOHTO => 50,
                RegionId::HOENN => 100,
            };

            $requirements[] = $this->minimumLevel + $regionalLevelOffset <= $level;
        }

        if ($this->minimumFriendship) {
            $requirements[] = $pokemon->friendship >= 220;
        }

        if (!is_null($this->specificTime)) {

            $clock = new Clock();

            $requirements[] = match ($this->specificTime) {
                "day"   => $clock->isDay(),
                "night" => $clock->isNight(),
            };
        }

        if (!is_null($this->stats)) {
            $requirements[] = match ($this->stats) {
                "Physical Attack > Physical Defence" => $pokemon->physicalAttack->calculate($pokemon->level) > $pokemon->physicalDefence->calculate($pokemon->level),
                "Physical Attack < Physical Defence" => $pokemon->physicalAttack->calculate($pokemon->level) < $pokemon->physicalDefence->calculate($pokemon->level),
                "Physical Attack = Physical Defence" => $pokemon->physicalAttack->calculate($pokemon->level) === $pokemon->physicalDefence->calculate($pokemon->level),
            };
        }

        if (count($requirements) === 0) {
            return false;
        }

        return array_reduce(
            $requirements,
            fn(bool $requirement, bool $carry) => $requirement && $carry,
            true
        );
    }
}