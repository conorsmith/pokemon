<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Domain\Party;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEvent;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipCalculator;
use PHPUnit\Framework\Attributes\AfterClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\identicalTo;

final class FriendshipCalculatorTest extends TestCase
{
    #[AfterClass]
    public static function resetNow()
    {
        CarbonImmutable::setTestNow();
    }

    #[Test]
    function it_has_a_base_value_of_70_by_default()
    {
        CarbonImmutable::setTestNow(new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"));

        $value = FriendshipCalculator::calculate(
            $pokemonConfig = [],
            $events = [
                new FriendshipEvent(
                    "sentToBox",
                    new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"),
                ),
            ],
        );

        assertThat(
            $value,
            identicalTo(70)
        );
    }

    #[Test]
    function it_uses_a_base_value_from_config_if_available()
    {
        CarbonImmutable::setTestNow(new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"));

        $value = FriendshipCalculator::calculate(
            $pokemonConfig = [
                'friendship' => 101,
            ],
            $events = [
                new FriendshipEvent(
                    "sentToBox",
                    new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"),
                ),
            ],
        );

        assertThat(
            $value,
            identicalTo(101)
        );
    }

    #[Test]
    function it_gains_a_point_every_3_hours_it_is_in_the_party()
    {
        CarbonImmutable::setTestNow(new CarbonImmutable("2014-04-05 12:00:00", "Europe/Dublin"));

        $value = FriendshipCalculator::calculate(
            $pokemonConfig = [],
            $events = [
                new FriendshipEvent(
                    "sentToTeam",
                    new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"),
                ),
            ],
        );

        assertThat(
            $value,
            identicalTo(78)
        );
    }

    #[Test]
    function it_loses_a_point_every_6_hours_it_is_in_the_box()
    {
        CarbonImmutable::setTestNow(new CarbonImmutable("2014-04-05 12:00:00", "Europe/Dublin"));

        $value = FriendshipCalculator::calculate(
            $pokemonConfig = [],
            $events = [
                new FriendshipEvent(
                    "sentToBox",
                    new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"),
                ),
            ],
        );

        assertThat(
            $value,
            identicalTo(66)
        );
    }

    #[Test]
    function it_gains_5_points_when_levelled_up_with_fewer_than_100_points()
    {
        CarbonImmutable::setTestNow(new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"));

        $value = FriendshipCalculator::calculate(
            $pokemonConfig = [],
            $events = [
                new FriendshipEvent(
                    "sentToTeam",
                    new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"),
                ),
                new FriendshipEvent(
                    "levelUp",
                    new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"),
                ),
            ],
        );

        assertThat(
            $value,
            identicalTo(75)
        );
    }

    #[Test]
    function it_gains_3_points_when_levelled_up_with_fewer_than_200_points()
    {
        CarbonImmutable::setTestNow(new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"));

        $value = FriendshipCalculator::calculate(
            $pokemonConfig = [],
            $events = [
                new FriendshipEvent(
                    "sentToTeam",
                    new CarbonImmutable("2014-03-25 12:00:00", "Europe/Dublin"),
                ),
                new FriendshipEvent(
                    "levelUp",
                    new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"),
                ),
            ],
        );

        assertThat(
            $value,
            identicalTo(153)
        );
    }

    #[Test]
    function it_gains_2_points_when_levelled_up_with_200_or_more_points()
    {
        CarbonImmutable::setTestNow(new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"));

        $value = FriendshipCalculator::calculate(
            $pokemonConfig = [],
            $events = [
                new FriendshipEvent(
                    "sentToTeam",
                    new CarbonImmutable("2014-03-15 12:00:00", "Europe/Dublin"),
                ),
                new FriendshipEvent(
                    "levelUp",
                    new CarbonImmutable("2014-04-04 12:00:00", "Europe/Dublin"),
                ),
            ],
        );

        assertThat(
            $value,
            identicalTo(232)
        );
    }

    #[Test]
    #[DataProvider('providerOfEvents')]
    function it_calculates_friendship(array $events, int $expectedValue)
    {
        // Remove 'in{Location}' event from end of array
        $now = array_splice($events, -1, 1);

        CarbonImmutable::setTestNow(new CarbonImmutable(key($now), "Europe/Dublin"));

        $value = FriendshipCalculator::calculate(
            $pokemonConfig = [],
            $events = array_map(
                fn($key, $value) => new FriendshipEvent(
                    $value,
                    new CarbonImmutable($key, "Europe/Dublin"),
                ),
                array_keys($events),
                array_values($events),
            ),
        );

        assertThat(
            $value,
            identicalTo($expectedValue)
        );
    }

    public static function providerOfEvents(): array
    {
        return [
            // Points gained being in the party
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-01 01:00:00" => "inParty",
                ],
                70,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-04 18:00:00" => "inParty",
                ],
                100,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-17 06:00:00" => "inParty",
                ],
                200,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-24 00:00:00" => "inParty",
                ],
                254,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-24 03:00:00" => "inParty",
                ],
                255,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-12-31 00:00:00" => "inParty",
                ],
                255,
            ],
            // Points lost being in the box
            [
                [
                    "2014-01-01 00:00:00" => "sentToBox",
                    "2014-01-01 01:00:00" => "inBox",
                ],
                70,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToBox",
                    "2014-01-06 00:00:00" => "inBox",
                ],
                50,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToBox",
                    "2014-01-18 06:00:00" => "inBox",
                ],
                1,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToBox",
                    "2014-01-18 12:00:00" => "inBox",
                ],
                0,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToBox",
                    "2014-12-31 00:00:00" => "inBox",
                ],
                0,
            ],
            // Moved immediately after capture
            [
                [
                    "2014-01-01 00:00:00" => "sentToBox",
                    "2014-01-01 00:01:00" => "sentToTeam",
                    "2014-01-01 03:01:00" => "inParty",
                ],
                71,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-01 00:01:00" => "sentToBox",
                    "2014-01-01 06:01:00" => "inBox",
                ],
                69,
            ],
            // Sent to box and back quickly stops 1 point being gained
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-02 01:01:00" => "sentToBox",
                    "2014-01-02 01:01:01" => "sentToTeam",
                    "2014-01-04 18:00:00" => "inParty",
                ],
                99,
            ],
            // Levelling up
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-02 00:00:00" => "levelUp",
                    "2014-01-04 18:00:00" => "inParty",
                ],
                105,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-02 00:00:00" => "levelUp",
                    "2014-01-17 06:00:00" => "inParty",
                ],
                205,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-05 00:00:00" => "levelUp",
                    "2014-01-17 06:00:00" => "inParty",
                ],
                203,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-18 06:00:00" => "levelUp",
                    "2014-01-21 00:00:00" => "inParty",
                ],
                232,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-02 00:00:00" => "levelUp",
                    "2014-01-05 00:00:00" => "levelUp",
                    "2014-01-18 06:00:00" => "levelUp",
                    "2014-01-21 00:00:00" => "inParty",
                ],
                240,
            ],
            // Sent to box and back again multiple times
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-02 00:00:00" => "sentToBox",
                    "2014-01-02 01:00:00" => "sentToTeam",
                    "2014-01-10 00:00:00" => "sentToBox",
                    "2014-01-16 00:00:00" => "sentToTeam",
                    "2014-01-31 00:00:00" => "inParty",
                ],
                237,
            ],
            [
                [
                    "2014-01-01 00:00:00" => "sentToTeam",
                    "2014-01-02 00:00:00" => "sentToBox",
                    "2014-01-02 01:00:00" => "sentToTeam",
                    "2014-01-04 00:00:00" => "levelUp",
                    "2014-01-10 00:00:00" => "sentToBox",
                    "2014-01-16 00:00:00" => "sentToTeam",
                    "2014-01-18 06:00:00" => "levelUp",
                    "2014-01-19 06:00:00" => "levelUp",
                    "2014-01-20 06:00:00" => "levelUp",
                    "2014-01-31 00:00:00" => "inParty",
                ],
                251,
            ],
            // Variety of events
            [
                [
                    "2014-01-01 00:00:00" => "sentToBox",                 // 70
                    "2014-01-02 00:00:00" => "sentToTeam",                // 66 (-4)
                    "2014-01-02 01:00:00" => "levelUp",                   // 71 (+5)
                    "2014-01-02 02:00:00" => "fainted",                   // 70 (-1)
                    "2014-01-02 03:00:00" => "faintedToPowerfulOpponent", // 65 (-5)
                    "2014-01-02 04:00:00" => "battleWithGymLeader",       // 68 (+3)
                    // 2014-01-06 00:00:00    inParty                     // 100 (+32)
                    "2014-01-06 01:00:00" => "levelUp",                   // 103 (+3)
                    "2014-01-06 02:00:00" => "battleWithGymLeader",       // 105 (+2)
                    // 2014-01-18 00:00:00    inParty                     // 201 (+96)
                    "2014-01-18 01:00:00" => "levelUp",                   // 203 (+2)
                    "2014-01-18 02:00:00" => "faintedToPowerfulOpponent", // 193 (-10)
                    // 2014-01-19 00:00:00    inParty                     // 201 (+8)
                    "2014-01-19 01:00:00" => "battleWithGymLeader",       // 202 (+1)
                    "2014-01-20 00:00:00" => "inParty",                    // 210 (+8)
                ],
                210,
            ],
        ];
    }
}
