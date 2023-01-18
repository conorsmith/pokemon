<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Domain\Battle;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use Exception;

final class Trainer
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly int $prizeMoney,
        private readonly array $team,
        public readonly bool $isBattling,
        public readonly ?CarbonImmutable $dateLastBeaten,
        public readonly int $battleCount,
    ) {}

    public function startBattle(): self
    {
        return new self(
            $this->id,
            $this->name,
            $this->prizeMoney,
            $this->team,
            true,
            $this->dateLastBeaten,
            $this->battleCount + 1,
        );
    }

    public function defeat(): self
    {
        return new self(
            $this->id,
            $this->name,
            $this->prizeMoney,
            $this->team,
            $this->isBattling,
            CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            $this->battleCount,
        );
    }

    public function endBattle(): self
    {
        $revivedTeam = [];

        /** @var Pokemon $pokemon */
        foreach ($this->team as $pokemon) {
            $pokemon->revive();
            $revivedTeam[] = $pokemon;
        }

        return new self(
            $this->id,
            $this->name,
            $this->prizeMoney,
            $revivedTeam,
            false,
            $this->dateLastBeaten,
            $this->battleCount,
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
}
