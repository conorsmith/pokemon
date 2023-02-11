<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Repositories;

use Carbon\CarbonImmutable;

final class FriendshipCalculator
{
    public static function calculate(array $pokemonConfig, array $pokemonRow, array $eventRows): int
    {
        $value = $pokemonConfig['friendship'] ?? 70;

        $dateCaught = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $pokemonRow['date_caught'], "Europe/Dublin");
        $now = CarbonImmutable::now("Europe/Dublin");

        $events = [
            [
                'type' => "UNKNOWN",
                'date' => $dateCaught,
            ],
        ];

        foreach ($eventRows as $row) {
            $events[] = [
                'type' => $row['event'],
                'date' => CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['date_logged'], "Europe/Dublin")
            ];
        }

        $firstEvent = self::determineFirstEvent($events);

        if (is_null($firstEvent)) {
            $events[0]['type'] = is_null($pokemonRow['team_position']) ? "sentToBox" : "sentToTeam";
        } else {
            $events[0]['type'] = $firstEvent;
        }

        $events[] = [
            'type' => "calculation",
            'date' => $now,
        ];

        $previousMovementEvent = $events[0];

        foreach ($events as $event) {
            if ($event['type'] === "calculation") {
                if ($previousMovementEvent['type'] === "sentToTeam") {
                    $value = self::calculateTimeOnTeam($value, $event['date'], $previousMovementEvent['date']);
                } elseif ($previousMovementEvent['type'] === "sentToBox") {
                    $value = self::calculateTimeInBox($value, $event['date'], $previousMovementEvent['date']);
                }
            } elseif ($event['type'] === "sentToTeam"
                || $event['type'] === "sentToBox"
            ) {
                if ($previousMovementEvent['type'] === "sentToTeam") {
                    $value = self::calculateTimeOnTeam($value, $event['date'], $previousMovementEvent['date']);
                } elseif ($previousMovementEvent['type'] === "sentToBox") {
                    $value = self::calculateTimeInBox($value, $event['date'], $previousMovementEvent['date']);
                }
                $previousMovementEvent = $event;

            } else {
                if ($previousMovementEvent['type'] === "sentToTeam") {
                    $preliminaryValue = self::calculateTimeOnTeam($value, $event['date'], $previousMovementEvent['date']);
                } elseif ($previousMovementEvent['type'] === "sentToBox") {
                    $preliminaryValue = self::calculateTimeInBox($value, $event['date'], $previousMovementEvent['date']);
                }

                if ($row['event'] === "levelUp") {
                    $value += match (true) {
                        $preliminaryValue < 100 => 5,
                        $preliminaryValue < 200 => 3,
                        default      => 2,
                    };
                } elseif ($row['event'] === "fainted") {
                    $value += -1;
                } elseif ($row['event'] === "faintedToPowerfulOpponent") {
                    $value += match (true) {
                        $preliminaryValue < 200 => -5,
                        default      => -10,
                    };
                }
            }
        }

        return $value;
    }

    private static function determineFirstEvent(array $events): ?string
    {
        foreach ($events as $event) {
            if ($event['type'] === "sentToBox") {
                return "sentToTeam";
            } elseif ($event['type'] === "sentToTeam") {
                return "sentToBox";
            }
        }

        return null;
    }

    private static function calculateTimeOnTeam(int $value, CarbonImmutable $from, CarbonImmutable $to): int
    {
        return min(255, $value + intval(floor($from->diffInHours($to) / 3)));
    }

    private static function calculateTimeInBox(int $value, CarbonImmutable $from, CarbonImmutable $to): int
    {
        return max(0, $value - intval(floor($from->diffInHours($to) / 6)));
    }
}
