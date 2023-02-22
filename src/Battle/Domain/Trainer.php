<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\TrainerClass;
use Exception;

final class Trainer
{
    public function __construct(
        public readonly string $id,
        public readonly ?string $name,
        public readonly string $class,
        public readonly array $team,
        public readonly bool $isBattling,
        public readonly ?CarbonImmutable $dateLastBeaten,
        public readonly int $battleCount,
        public readonly ?GymBadge $gymBadge,
    ) {}

    public function startBattle(): self
    {
        return new self(
            $this->id,
            $this->name,
            $this->class,
            $this->team,
            true,
            $this->dateLastBeaten,
            $this->battleCount + 1,
            $this->gymBadge,
        );
    }

    public function defeat(): self
    {
        return new self(
            $this->id,
            $this->name,
            $this->class,
            $this->team,
            $this->isBattling,
            CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            $this->battleCount,
            $this->gymBadge,
        );
    }

    public function endBattle(): self
    {
        return new self(
            $this->id,
            $this->name,
            $this->class,
            $this->team,
            false,
            $this->dateLastBeaten,
            $this->battleCount,
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
}
