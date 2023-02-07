<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\Team;
use Doctrine\DBAL\Connection;

final class PokemonRepository
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function find(string $id): ?Pokemon
    {
        $row = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $id,
        ]);

        if ($row === false) {
            return null;
        }

        return $this->createPokemonFromRow($row);
    }

    public function getTeam(): Team
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position IS NOT NULL ORDER BY team_position", [
            'instanceId' => INSTANCE_ID,
        ]);

        return new Team(array_map(
            fn(array $row) => $this->createPokemonFromRow($row),
            $rows
        ));
    }

    public function getBox(): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position IS NULL ORDER BY (pokemon_id * 1) ASC, level DESC", [
            'instanceId' => INSTANCE_ID,
        ]);

        return array_map(
            fn(array $row) => $this->createPokemonFromRow($row),
            $rows
        );
    }

    private function createPokemonFromRow(array $row): Pokemon
    {
        return new Pokemon(
            $row['id'],
            $row['pokemon_id'],
            intval($row['level']),
            $this->calculateFriendship($row),
            $row['is_shiny'] === 1,
            is_null($row['team_position']) ? null : intval($row['team_position']),
        );
    }

    public function saveTeam(Team $team): void
    {
        /**
         * @var int $position
         * @var Pokemon $pokemon
         */
        foreach ($team->members as $position => $pokemon) {
            $this->db->update("caught_pokemon", [
                'team_position' => $position,
            ], [
                'id' => $pokemon->id,
            ]);
        }
    }

    public function savePokemon(Pokemon $pokemon): void
    {
        $this->db->update("caught_pokemon", [
            'team_position' => null,
        ], [
            'id' => $pokemon->id,
        ]);
    }

    private function calculateFriendship(array $pokemonRow): int
    {
        $boxEventRows = $this->db->fetchAllAssociative("SELECT * FROM friendship_event_log WHERE pokemon_id = :pokemonId AND event IN ('sentToBox', 'sentToTeam') ORDER BY date_logged", [
            'pokemonId' => $pokemonRow['id'],
        ]);

        $value = 70;

        $dateCaught = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $pokemonRow['date_caught'], "Europe/Dublin");
        $now = CarbonImmutable::now("Europe/Dublin");

        $previousEventTime = $dateCaught;

        foreach ($boxEventRows as $boxEventRow) {
            $eventTime = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $boxEventRow['date_logged'], "Europe/Dublin");
            if ($boxEventRow['event'] === "sentToTeam") {
                $timeInBox = $previousEventTime->diffInHours($eventTime);
                $value = max(0, $value - intval(ceil($timeInBox / 4)));
            } elseif ($boxEventRow['event'] === "sentToBox") {
                $timeOnTeam = $previousEventTime->diffInHours($eventTime);
                $value = min(255, $value + intval(floor($timeOnTeam / 4)));
            }
            $previousEventTime = $eventTime;
        }

        if (is_null($pokemonRow['team_position'])) {
            $timeInBox = $previousEventTime->diffInHours($now);
            $value = max(0, $value - intval(ceil($timeInBox / 4)));
        } else {
            $timeOnTeam = $previousEventTime->diffInHours($now);
            $value = min(255, $value + intval(floor($timeOnTeam / 4)));
        }

        return $value;
    }
}
