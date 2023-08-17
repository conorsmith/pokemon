<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\Gender;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\TrainerClass;
use Exception;

final class Trainer
{
    public function __construct(
        public readonly string $id,
        public readonly ?string $name,
        public readonly string $class,
        public readonly Gender $gender,
        public readonly array $team,
        public readonly string $locationId,
        public readonly bool $isBattling,
        public readonly ?GymBadge $gymBadge,
    ) {}

    public function startBattle(): self
    {
        return new self(
            $this->id,
            $this->name,
            $this->class,
            $this->gender,
            $this->team,
            $this->locationId,
            true,
            $this->gymBadge,
        );
    }

    public function endBattle(): self
    {
        return new self(
            $this->id,
            $this->name,
            $this->class,
            $this->gender,
            $this->team,
            $this->locationId,
            false,
            $this->gymBadge,
        );
    }

    public function getLeadPokemon(): Pokemon
    {
        /** @var Pokemon $pokemon */
        foreach ($this->team as $pokemon) {
            if (!$pokemon->hasFainted) {
                return $pokemon;
            }
        }

        throw new Exception;
    }

    public function getLastFaintedPokemon(): Pokemon
    {
        /** @var Pokemon $pokemon */
        foreach (array_reverse($this->team) as $pokemon) {
            if ($pokemon->hasFainted) {
                $pokemon->remainingHp = 0;
                return $pokemon;
            }
        }

        throw new Exception;
    }

    public function countActiveTeamMembers(): int
    {
        $count = 0;

        /** @var Pokemon $pokemon */
        foreach ($this->team as $pokemon) {
            if (!$pokemon->hasFainted) {
                $count++;
            }
        }

        return $count;
    }

    public function countFaintedTeamMembers(): int
    {
        $count = 0;

        /** @var Pokemon $pokemon */
        foreach ($this->team as $pokemon) {
            if ($pokemon->hasFainted) {
                $count++;
            }
        }

        return $count;
    }

    public function hasEntireTeamFainted(): bool
    {
        return $this->countActiveTeamMembers() === 0;
    }

    public function isGymLeader(): bool
    {
        return !is_null($this->gymBadge);
    }

    public function isEliteFourOrEquivalent(): bool
    {
        return $this->class === TrainerClass::ELITE_FOUR
            || $this->class === TrainerClass::CHAMPION
            || $this->class === TrainerClass::RETIRED_TRAINER;
    }
}
