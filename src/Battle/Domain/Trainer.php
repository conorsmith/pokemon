<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use Exception;

final class Trainer
{
    public function __construct(
        public readonly string $id,
        public readonly ?string $name,
        public readonly string $class,
        public readonly Gender $gender,
        public readonly array $party,
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
            $this->party,
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
            $this->party,
            $this->locationId,
            false,
            $this->gymBadge,
        );
    }

    public function getLeadPokemon(): Pokemon
    {
        /** @var Pokemon $pokemon */
        foreach ($this->party as $pokemon) {
            if (!$pokemon->hasFainted) {
                return $pokemon;
            }
        }

        throw new Exception;
    }

    public function getLastFaintedPokemon(): Pokemon
    {
        /** @var Pokemon $pokemon */
        foreach (array_reverse($this->party) as $pokemon) {
            if ($pokemon->hasFainted) {
                $pokemon->remainingHp = 0;
                return $pokemon;
            }
        }

        throw new Exception;
    }

    public function countActivePartyMembers(): int
    {
        $count = 0;

        /** @var Pokemon $pokemon */
        foreach ($this->party as $pokemon) {
            if (!$pokemon->hasFainted) {
                $count++;
            }
        }

        return $count;
    }

    public function countFaintedPartyMembers(): int
    {
        $count = 0;

        /** @var Pokemon $pokemon */
        foreach ($this->party as $pokemon) {
            if ($pokemon->hasFainted) {
                $count++;
            }
        }

        return $count;
    }

    public function hasEntirePartyFainted(): bool
    {
        return $this->countActivePartyMembers() === 0;
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

    public function reviveParty(): self
    {
        $revivedParty = [];

        /** @var Pokemon $pokemon */
        foreach ($this->party as $pokemon) {
            $revivedPokemon = clone $pokemon;
            $revivedPokemon->revive();
            $revivedParty[] = $revivedPokemon;
        }

        return new self(
            $this->id,
            $this->name,
            $this->class,
            $this->gender,
            $revivedParty,
            $this->locationId,
            $this->isBattling,
            $this->gymBadge,
        );
    }
}
