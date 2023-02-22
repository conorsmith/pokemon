<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\GymBadge;
use Exception;

final class Player
{
    public function __construct(
        public readonly array $team,
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

    public function getLastFaintedPokemon(): Pokemon
    {
        /** @var Pokemon $pokemon */
        foreach (array_reverse($this->team) as $pokemon) {
            if ($pokemon->hasFainted) {
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

    public function findTeamMember(string $id): Pokemon
    {
        /** @var Pokemon $pokemon */
        foreach ($this->team as $pokemon) {
            if ($pokemon->id === $id) {
                return $pokemon;
            }
        }

        throw new Exception;
    }

    public function switchTeamMembers(Pokemon $pokemonA, Pokemon $pokemonB): self
    {
        $team = [];

        foreach ($this->team as $pokemon) {
            if ($pokemon->id === $pokemonA->id) {
                $team[] = $pokemonB;
            } elseif ($pokemon->id === $pokemonB->id) {
                $team[] = $pokemonA;
            } else {
                $team[] = $pokemon;
            }
        }

        return new self(
            $team,
            $this->gymBadges,
        );
    }
}
