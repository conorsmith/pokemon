<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Support;

final class Instance
{
    public const DEFAULT_ID = "8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1";

    public static function setup(): string
    {
        $db = Database::createDatabaseConnection();

        $db->insert("instances", [
            'id'                => self::DEFAULT_ID,
            'current_location'  => "dontcare",
            'money'             => 0,
            'unused_level_ups'  => 0,
            'unused_moves'      => 0,
            'unused_encounters' => 0,
            'badges'            => "[]",
            'active_battle_id'  => null,
        ]);

        return self::DEFAULT_ID;
    }
}
