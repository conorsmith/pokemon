<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Domain\Battle;

use ConorSmith\Pokemon\GymBadge;
use Exception;

final class Player
{
    public function __construct(
        public readonly array $team,
        public readonly array $teamIds,
        public readonly array $gymBadges,
    ) {}

    public function hasGymBadge(GymBadge $gymBadge): bool
    {
        return in_array($gymBadge, $this->gymBadges);
    }

    public function earn(GymBadge $gymBadge): self
    {
        $gymBadges = $this->gymBadges;

        $gymBadges[] = $gymBadge;

        return new self(
            $this->team,
            $this->teamIds,
            $gymBadges
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

    public function reviveTeam(): self
    {
        $revivedTeam = [];

        /** @var Pokemon $pokemon */
        foreach ($this->team as $pokemon) {
            $pokemon->revive();
            $revivedTeam[] = $pokemon;
        }

        return new self(
            $revivedTeam,
            $this->teamIds,
            $this->gymBadges,
        );
    }

    private function countActiveTeamMembers(): int
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

    public function hasEntireTeamFainted(): bool
    {
        return $this->countActiveTeamMembers() === 0;
    }
}