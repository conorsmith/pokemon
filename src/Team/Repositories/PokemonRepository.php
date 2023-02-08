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
        $eventRows = $this->db->fetchAllAssociative("SELECT * FROM friendship_event_log WHERE pokemon_id = :pokemonId ORDER BY date_logged", [
            'pokemonId' => $pokemonRow['id'],
        ]);

        $pokemonConfig = self::findPokemonConfig($pokemonRow['pokemon_id']);

        $value = $pokemonConfig['friendship'] ?? 70;

        $dateCaught = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $pokemonRow['date_caught'], "Europe/Dublin");
        $now = CarbonImmutable::now("Europe/Dublin");

        $previousEventTime = $dateCaught;

        foreach ($eventRows as $row) {
            $eventTime = CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['date_logged'], "Europe/Dublin");

            if ($row['event'] === "sentToTeam") {
                $timeInBox = $previousEventTime->diffInHours($eventTime);
                $value = max(0, $value - intval(ceil($timeInBox / 6)));

            } elseif ($row['event'] === "sentToBox") {
                $timeOnTeam = $previousEventTime->diffInHours($eventTime);
                $value = min(255, $value + intval(floor($timeOnTeam / 3)));

            } elseif ($row['event'] === "levelUp") {

                if (is_null($pokemonRow['team_position'])) {
                    $timeInBox = $previousEventTime->diffInHours($now);
                    $value = max(0, $value - intval(ceil($timeInBox / 6)));
                } else {
                    $timeOnTeam = $previousEventTime->diffInHours($now);
                    $value = min(255, $value + intval(floor($timeOnTeam / 3)));
                }

                $value += match (true) {
                    $value < 100 => 5,
                    $value < 200 => 3,
                    default      => 2,
                };
            }

            $previousEventTime = $eventTime;
        }

        if (is_null($pokemonRow['team_position'])) {
            $timeInBox = $previousEventTime->diffInHours($now);
            $value = max(0, $value - intval(ceil($timeInBox / 6)));
        } else {
            $timeOnTeam = $previousEventTime->diffInHours($now);
            $value = min(255, $value + intval(floor($timeOnTeam / 3)));
        }

        return $value;
    }

    private static function findPokemonConfig(string $number): array
    {
        $config = require __DIR__ . "/../../Config/Pokedex.php";

        return $config[$number];
    }
}
