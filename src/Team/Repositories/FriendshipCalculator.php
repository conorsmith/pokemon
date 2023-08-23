<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Repositories;

use Carbon\CarbonImmutable;
use LogicException;

final class FriendshipCalculator
{
    public static function calculate(array $pokemonConfig, array $eventRows): int
    {
        $value = $pokemonConfig['friendship'] ?? 70;

        $now = CarbonImmutable::now("Europe/Dublin");

        $events = [];

        foreach ($eventRows as $row) {
            $events[] = [
                'type' => $row['event'],
                'date' => CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['date_logged'], "Europe/Dublin")
            ];
        }

        $events[] = [
            'type' => "calculation",
            'date' => $now,
        ];

        // First event is always a movement event
        $previousMovementEvent = $events[0];

        foreach ($events as $event) {
            if ($event['type'] === "calculation") {
                if ($previousMovementEvent['type'] === "sentToTeam") {
                    $value = self::calculateTimeOnTeam($value, $event['date'], $previousMovementEvent['date']);
                } elseif ($previousMovementEvent['type'] === "sentToDayCare") {
                    $value = self::calculateTimeInDayCare($value, $event['date'], $previousMovementEvent['date']);
                } elseif ($previousMovementEvent['type'] === "sentToBox") {
                    $value = self::calculateTimeInBox($value, $event['date'], $previousMovementEvent['date']);
                }
            } elseif ($event['type'] === "sentToTeam"
                || $event['type'] === "sentToDayCare"
                || $event['type'] === "sentToBox"
            ) {
                if ($previousMovementEvent['type'] === "sentToTeam") {
                    $value = self::calculateTimeOnTeam($value, $event['date'], $previousMovementEvent['date']);
                } elseif ($previousMovementEvent['type'] === "sentToDayCare") {
                    $value = self::calculateTimeInDayCare($value, $event['date'], $previousMovementEvent['date']);
                } elseif ($previousMovementEvent['type'] === "sentToBox") {
                    $value = self::calculateTimeInBox($value, $event['date'], $previousMovementEvent['date']);
                }
                $previousMovementEvent = $event;

            } else {
                if ($previousMovementEvent['type'] === "sentToTeam") {
                    $preliminaryValue = self::calculateTimeOnTeam($value, $event['date'], $previousMovementEvent['date']);
                } elseif ($previousMovementEvent['type'] === "sentToDayCare") {
                    $preliminaryValue = self::calculateTimeInDayCare($value, $event['date'], $previousMovementEvent['date']);
                } elseif ($previousMovementEvent['type'] === "sentToBox") {
                    $preliminaryValue = self::calculateTimeInBox($value, $event['date'], $previousMovementEvent['date']);
                } else {
                    throw new LogicException;
                }

                if ($event['type'] === "levelUp") {
                    $value += match (true) {
                        $preliminaryValue < 100 => 5,
                        $preliminaryValue < 200 => 3,
                        default      => 2,
                    };
                } elseif ($event['type'] === "fainted") {
                    $value += -1;
                } elseif ($event['type'] === "faintedToPowerfulOpponent") {
                    $value += match (true) {
                        $preliminaryValue < 200 => -5,
                        default      => -10,
                    };
                } elseif ($event['type'] === "battleWithGymLeader") {
                    $value += match (true) {
                        $preliminaryValue < 100 => 3,
                        $preliminaryValue < 200 => 2,
                        default      => 1,
                    };
                }

                $value = min($value, 255);
                $value = max($value, 0);
            }
        }

        return $value;
    }

    private static function calculateTimeOnTeam(int $value, CarbonImmutable $from, CarbonImmutable $to): int
    {
        return min(255, $value + intval(floor($from->diffInHours($to) / 3)));
    }

    private static function calculateTimeInDayCare(int $value, CarbonImmutable $from, CarbonImmutable $to): int
    {
        return min(255, $value + intval(floor($from->diffInHours($to) / 24)));
    }

    private static function calculateTimeInBox(int $value, CarbonImmutable $from, CarbonImmutable $to): int
    {
        return max(0, $value - intval(floor($from->diffInHours($to) / 6)));
    }
}
