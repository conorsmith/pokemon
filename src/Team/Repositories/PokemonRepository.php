<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Repositories;

use ConorSmith\Pokemon\SharedKernel\EarnedGymBadgesQuery;
use ConorSmith\Pokemon\Team\Domain\DayCare;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\Team;
use Doctrine\DBAL\Connection;

final class PokemonRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly EarnedGymBadgesQuery $earnedGymBadgesQuery,
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
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND location = 'team' ORDER BY team_position", [
            'instanceId' => INSTANCE_ID,
        ]);

        return new Team(array_map(
            fn(array $row) => $this->createPokemonFromRow($row),
            $rows
        ));
    }

    public function getDayCare(): DayCare
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND location = 'dayCare' ORDER BY (pokemon_id * 1) ASC, level DESC", [
            'instanceId' => INSTANCE_ID,
        ]);

        return new DayCare(
            array_map(
                fn(array $row) => $this->createPokemonFromRow($row),
                $rows
            ),
            $this->earnedGymBadgesQuery->run()
        );
    }

    public function getBox(): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND location = 'box' ORDER BY (pokemon_id * 1) ASC, level DESC", [
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
                'level' => $pokemon->level,
                'team_position' => $position,
                'location' => "team",
            ], [
                'id' => $pokemon->id,
            ]);
        }
    }

    public function saveDayCare(DayCare $dayCare): void
    {
        /** @var Pokemon $pokemon */
        foreach ($dayCare->attendees as $pokemon) {
            $this->db->update("caught_pokemon", [
                'level' => $pokemon->level,
                'team_position' => null,
                'location' => "dayCare",
            ], [
                'id' => $pokemon->id,
            ]);
        }
    }

    public function savePokemon(Pokemon $pokemon): void
    {
        $this->db->update("caught_pokemon", [
            'team_position' => null,
            'location' => "box",
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

        return FriendshipCalculator::calculate($pokemonConfig, $eventRows);
    }

    private static function findPokemonConfig(string $number): array
    {
        $config = require __DIR__ . "/../../Config/Pokedex.php";

        return $config[$number];
    }
}
