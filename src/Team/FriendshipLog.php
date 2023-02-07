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
}
