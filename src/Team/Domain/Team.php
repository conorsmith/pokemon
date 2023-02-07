<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use Exception;

final class Team
{
    public function __construct(
        public readonly array $members,
    ) {}

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
}
