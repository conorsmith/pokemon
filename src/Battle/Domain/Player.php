<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use Exception;

final class Player
{
    public function __construct(
        public readonly array $party,
        public readonly array $gymBadges,
        public readonly ?string $activeBattleId,
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
            $this->party,
            $gymBadges,
            $this->activeBattleId,
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
                return $pokemon;
            }
        }

        throw new Exception;
    }

    public function startBattle(Battle $battle): self
    {
        return new self(
            $this->party,
            $this->gymBadges,
            $battle->id,
        );
    }

    public function endBattle(): self
    {
        return new self(
            $this->party,
            $this->gymBadges,
            null,
        );
    }

    public function reviveParty(): self
    {
        $revivedParty = [];

        /** @var Pokemon $pokemon */
        foreach ($this->party as $pokemon) {
            $pokemon->revive();
            $revivedParty[] = $pokemon;
        }

        return new self(
            $revivedParty,
            $this->gymBadges,
            $this->activeBattleId,
        );
    }

    private function countActivePartyMembers(): int
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

    public function hasEntirePartyFainted(): bool
    {
        return $this->countActivePartyMembers() === 0;
    }

    public function findPartyMember(string $id): Pokemon
    {
        /** @var Pokemon $pokemon */
        foreach ($this->party as $pokemon) {
            if ($pokemon->id === $id) {
                return $pokemon;
            }
        }

        throw new Exception;
    }

    public function switchPartyMembers(Pokemon $pokemonA, Pokemon $pokemonB): self
    {
        $party = [];

        foreach ($this->party as $pokemon) {
            if ($pokemon->id === $pokemonA->id) {
                $party[] = $pokemonB;
            } elseif ($pokemon->id === $pokemonB->id) {
                $party[] = $pokemonA;
            } else {
                $party[] = $pokemon;
            }
        }

        return new self(
            $party,
            $this->gymBadges,
            $this->activeBattleId,
        );
    }
}
