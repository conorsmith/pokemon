<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

final class TrainerClass
{
    public const BUG_CATCHER = "eeab339c-5159-451b-bc65-4b4ada50fcad";
    public const CAMPER = "7e944b8d-c8ee-4545-9391-c24b381f04a1";
    public const GYM_LEADER = "359c0b3f-e693-4260-8742-ff2f3ca09376";
    public const BLACK_BELT = "cb64d0f2-1bff-4c46-8c29-041f38927817";
    public const COOLTRAINER = "5c486678-1ba0-4a3f-87d1-71400ab9e482";
    public const TAMER = "d3089419-2049-4cd6-8d3b-a7068a2d09c7";
    public const LASS = "38d72f0d-6be9-47a3-a3f9-1d02b70790db";
    public const YOUNGSTER = "a125f3fc-687c-4b0f-94f0-66df16dd9b31";
    public const SUPER_NERD = "0b112d19-09bb-4e88-a224-d869dbbd4590";
    public const HIKER = "5bcdbc80-7550-42ab-90dc-037c8f374b97";
    public const TEAM_ROCKET_GRUNT = "ff58d913-28c6-4d64-b4bb-8fd986f1a2b4";
    public const SWIMMER = "73874300-c843-4be9-99b6-3d80cc92ba09";
    public const PICNICKER = "ce0ae171-cf0d-4d3d-973a-aca7ee1e3172";

    public static function getLabel(string $id): string
    {
        return match ($id) {
            self::BUG_CATCHER => "Bug Catcher",
            self::CAMPER => "Camper",
            self::GYM_LEADER => "Gym Leader",
            self::BLACK_BELT => "Black Belt",
            self::COOLTRAINER => "Cooltrainer",
            self::TAMER => "Tamer",
            self::LASS => "Lass",
            self::YOUNGSTER => "Youngster",
            self::SUPER_NERD => "Super Nerd",
            self::HIKER => "Hiker",
            self::TEAM_ROCKET_GRUNT => "Team Rocket Grunt",
            self::SWIMMER => "Swimmer",
            self::PICNICKER => "Picnicker",
        };
    }
}
