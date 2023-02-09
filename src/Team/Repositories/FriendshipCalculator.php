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

        $previousMovementEvent = $events[0]['type'];

        foreach ($events as $i => $event) {
            if ($event['type'] === "calculation") {
                break;
            }
            if ($event['type'] === "sentToTeam") {
                $value = self::calculateTimeOnTeam($value, $event['date'], $events[$i + 1]['date']);
                $previousMovementEvent = $event['type'];

            } elseif ($event['type'] === "sentToBox") {
                $value = self::calculateTimeInBox($value, $event['date'], $events[$i + 1]['date']);
                $previousMovementEvent = $event['type'];

            } elseif ($row['event'] === "levelUp") {

                $value += match (true) {
                    $value < 100 => 5,
                    $value < 200 => 3,
                    default      => 2,
                };

                if ($previousMovementEvent === "sentToTeam") {
                    $value = self::calculateTimeOnTeam($value, $event['date'], $events[$i + 1]['date']);
                } elseif ($previousMovementEvent === "sentToBox") {
                    $value = self::calculateTimeInBox($value, $event['date'], $events[$i + 1]['date']);
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
