<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use Exception;

final class DayCare
{
    public function __construct(
        public readonly array $attendees,
        public readonly int $availablePlaces,
    ) {}

    public function count(): int
    {
        return count($this->attendees);
    }

    public function isFull(): bool
    {
        return count($this->attendees) === $this->availablePlaces;
    }

    public function hasAttendee(string $id): bool
    {
        /** @var Pokemon $attendee */
        foreach ($this->attendees as $attendee) {
            if ($attendee->id === $id) {
                return true;
            }
        }

        return false;
    }

    public function find(string $id): Pokemon
    {
        /** @var Pokemon $attendee */
        foreach ($this->attendees as $attendee) {
            if ($attendee->id === $id) {
                return $attendee;
            }
        }

        throw new Exception;
    }

    public function pickUp(string $id): self
    {
        $remainingAttendees = [];

        /** @var Pokemon $attendee */
        foreach ($this->attendees as $attendee) {
            if ($attendee->id !== $id) {
                $remainingAttendees[] = $attendee;
            }
        }

        return new self($remainingAttendees, $this->availablePlaces);
    }

    public function dropOff(Pokemon $pokemon): self
    {
        $attendees = [];

        foreach ($this->attendees as $attendee) {
            $attendees[] = $attendee;
        }

        $attendees[] = $pokemon;

        return new self($attendees, $this->availablePlaces);
    }
}
