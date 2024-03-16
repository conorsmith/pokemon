<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Party;

use Carbon\CarbonImmutable;
use LogicException;

final class FriendshipCalculator
{
    private const TEAM_RATE = 3;
    private const DAY_CARE_RATE = 24;
    private const BOX_RATE = -6;

    public static function calculate(array $pokemonConfig, array $events): int
    {
        $value = $pokemonConfig['friendship'] ?? 70;

        if (count($events) === 0) {
            return $value;
        }

        $now = CarbonImmutable::now("Europe/Dublin");

        $events[] = new FriendshipEvent("calculation", $now);

        // First event is always a movement event
        $previousMovementEvent = $events[0];

        /** @var FriendshipEvent $event */
        foreach ($events as $event) {
            if ($event->type === "calculation") {
                $value = self::addPointsForPartyLocation(
                    $value,
                    $event,
                    $previousMovementEvent,
                    match ($previousMovementEvent->type) {
                        "sentToTeam"    => self::TEAM_RATE,
                        "sentToDayCare" => self::DAY_CARE_RATE,
                        "sentToBox"     => self::BOX_RATE,
                        default         => throw new LogicException("Invalid movement event type '{$previousMovementEvent->type}'"),
                    },
                );
            } elseif ($event->type === "sentToTeam"
                || $event->type === "sentToDayCare"
                || $event->type === "sentToBox"
            ) {
                $value = self::addPointsForPartyLocation(
                    $value,
                    $event,
                    $previousMovementEvent,
                    match ($previousMovementEvent->type) {
                        "sentToTeam"    => self::TEAM_RATE,
                        "sentToDayCare" => self::DAY_CARE_RATE,
                        "sentToBox"     => self::BOX_RATE,
                        default         => throw new LogicException("Invalid movement event type '{$previousMovementEvent->type}'"),
                    },
                );
                $previousMovementEvent = $event;

            } else {
                $preliminaryValue = self::addPointsForPartyLocation(
                    $value,
                    $event,
                    $previousMovementEvent,
                    match ($previousMovementEvent->type) {
                        "sentToTeam"    => self::TEAM_RATE,
                        "sentToDayCare" => self::DAY_CARE_RATE,
                        "sentToBox"     => self::BOX_RATE,
                        default         => throw new LogicException("Invalid movement event type '{$previousMovementEvent->type}'"),
                    },
                );

                if ($event->type === "levelUp") {
                    $value += match (true) {
                        $preliminaryValue < 100 => 5,
                        $preliminaryValue < 200 => 3,
                        default                 => 2,
                    };
                } elseif ($event->type === "fainted") {
                    $value += -1;
                } elseif ($event->type === "faintedToPowerfulOpponent") {
                    $value += match (true) {
                        $preliminaryValue < 200 => -5,
                        default                 => -10,
                    };
                } elseif ($event->type === "battleWithGymLeader") {
                    $value += match (true) {
                        $preliminaryValue < 100 => 3,
                        $preliminaryValue < 200 => 2,
                        default                 => 1,
                    };
                }

                $value = min($value, 255);
                $value = max($value, 0);
            }
        }

        return $value;
    }

    private static function addPointsForPartyLocation(
        int $currentValue,
        FriendshipEvent $currentMovementEvent,
        FriendshipEvent $previousMovementEvent,
        int $hoursPerFriendshipPoint,
    ): int {
        $fromTime = new CarbonImmutable($currentMovementEvent->loggedAt);
        $toTime = new CarbonImmutable($previousMovementEvent->loggedAt);

        $additionalPoints = $fromTime->diffInHours($toTime) / $hoursPerFriendshipPoint;

        if ($additionalPoints > 0) {
            $additionalPoints = floor($additionalPoints);

        } elseif ($additionalPoints < 0) {
            $additionalPoints = ceil($additionalPoints);
        }

        $newValue = $currentValue + intval($additionalPoints);

        $newValue = min($newValue, 255);
        $newValue = max($newValue, 0);

        return $newValue;
    }
}
