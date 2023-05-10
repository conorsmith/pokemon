<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use Exception;

final class Team
{
    public function __construct(
        public readonly array $members,
    ) {}

    public function levelUpAllMembersWithMaxFriendship(): self
    {
        $processedTeamMembers = [];

        /** @var Pokemon $member */
        foreach ($this->members as $member) {
            if ($member->hasMaxFriendship()) {
                $processedTeamMembers[] = $member->levelUp();
            } else {
                $processedTeamMembers[] = $member;
            }
        }

        return new Team($processedTeamMembers);
    }

    public function diff(self $other): array
    {
        $diff = [];

        foreach ($this->members as $i => $member) {
            if (!array_key_exists($i, $other->members)) {
                $diff[] = [$member, null];
            } elseif (!$member->identicalTo($other->members[$i])) {
                $diff[] = [$member, $other->members[$i]];
            }
        }

        if ($other->members > $this->members) {
            foreach (array_slice($other->members, count($this->members)) as $otherMember) {
                $diff[] = [null, $otherMember];
            }
        }

        return $diff;
    }

    public function isFull(): bool
    {
        return count($this->members) === 6;
    }

    public function contains(string $id): bool
    {
        /** @var Pokemon $member */
        foreach ($this->members as $member) {
            if ($member->id === $id) {
                return true;
            }
        }

        return false;
    }

    public function find(string $id): Pokemon
    {
        /** @var Pokemon $member */
        foreach ($this->members as $member) {
            if ($member->id === $id) {
                return $member;
            }
        }

        throw new Exception;
    }

    public function remove(string $id): self
    {
        $remainingMembers = [];

        /** @var Pokemon $member */
        foreach ($this->members as $member) {
            if ($member->id !== $id) {
                $remainingMembers[] = $member;
            }
        }

        return new self($remainingMembers);
    }

    public function add(Pokemon $pokemon): self
    {
        $members = [];

        foreach ($this->members as $member) {
            $members[] = $member;
        }

        $members[] = $pokemon;

        return new self($members);
    }

    public function replace(Pokemon $pokemon): self
    {
        $members = [];

        /** @var Pokemon $member */
        foreach ($this->members as $member) {
            if ($member->id === $pokemon->id) {
                $members[] = $pokemon;
            } else {
                $members[] = $member;
            }
        }

        return new self($members);
    }
}
