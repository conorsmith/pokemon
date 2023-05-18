<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use ConorSmith\Pokemon\SharedKernel\Clock;
use ConorSmith\Pokemon\SharedKernel\Domain\Region;

final class Evolution
{
    public function __construct(
        public readonly string $evolvedPokedexNumber,
        private readonly ?int $minimumLevel,
        private readonly bool $minimumFriendship,
        private readonly ?string $specificTime,
    ) {}

    public function isTriggered(Pokemon $pokemon, int $level): bool
    {
        $requirements = [];

        if (!is_null($this->minimumLevel)) {
            $regionalLevelOffset = match ($pokemon->caughtLocation->region) {
                Region::KANTO => 0,
                Region::JOHTO => 50,
                Region::HOENN => 100,
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