<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class FriendshipLog
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function sentToBox(Pokemon $pokemon): void
    {
        $this->db->insert("friendship_event_log", [
            'id' => Uuid::uuid4(),
            'pokemon_id' => $pokemon->id,
            'event' => "sentToBox",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function sentToTeam(Pokemon $pokemon): void
    {
        $this->db->insert("friendship_event_log", [
            'id' => Uuid::uuid4(),
            'pokemon_id' => $pokemon->id,
            'event' => "sentToTeam",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function levelUp(Pokemon $pokemon): void
    {
        $this->db->insert("friendship_event_log", [
            'id' => Uuid::uuid4(),
            'pokemon_id' => $pokemon->id,
            'event' => "levelUp",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function fainted(string $pokemonId): void
    {
        $this->db->insert("friendship_event_log", [
            'id' => Uuid::uuid4(),
            'pokemon_id' => $pokemonId,
            'event' => "fainted",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function faintedToPowerfulOpponent(string $pokemonId): void
    {
        $this->db->insert("friendship_event_log", [
            'id' => Uuid::uuid4(),
            'pokemon_id' => $pokemonId,
            'event' => "faintedToPowerfulOpponent",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }
}
