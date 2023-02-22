<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Player;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\SharedKernel\TeamPokemonQuery;
use Doctrine\DBAL\Connection;
use Exception;

final class PlayerRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly TeamPokemonQuery $teamPokemonQuery,
        private readonly array $pokedex,
    ) {}

    public function findPlayer(): Player
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $caughtPokemonRows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND location = 'team' ORDER BY team_position", [
            'instanceId' => INSTANCE_ID,
        ]);

        $team = [];

        foreach ($caughtPokemonRows as $caughtPokemonRow) {
            $teamPokemon = $this->teamPokemonQuery->run($caughtPokemonRow['id']);
            $pokedexEntry = $this->findPokedexEntry($caughtPokemonRow['pokemon_id']);
            $team[] = new Pokemon(
                $caughtPokemonRow['id'],
                $caughtPokemonRow['pokemon_id'],
                $pokedexEntry['type'][0],
                $pokedexEntry['type'][1] ?? null,
                $caughtPokemonRow['level'],
                $teamPokemon->friendship,
                $caughtPokemonRow['is_shiny'] === 1,
                self::createStats($caughtPokemonRow['pokemon_id']),
                $caughtPokemonRow['remaining_hp'] ?? 0,
                $caughtPokemonRow['has_fainted'] === 1,
            );
        }

        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($instanceRow['badges'])
        );

        return new Player($team, $gymBadges);
    }

    private function findPokedexEntry(string $number): array
    {
        if (!array_key_exists($number, $this->pokedex)) {
            throw new Exception;
        }

        return $this->pokedex[$number];
    }

    public function savePlayer(Player $player): void
    {
        $this->db->update("instances", [
            'badges' => json_encode($player->gymBadges),
        ], [
            'id' => INSTANCE_ID,
        ]);

        /** @var Pokemon $pokemon */
        foreach ($player->team as $i => $pokemon) {
            $this->db->update("caught_pokemon", [
                'team_position' => $i + 1,
                'remaining_hp' => $pokemon->remainingHp,
                'has_fainted' => $pokemon->hasFainted ? "1" : "0",
            ], [
                'id' => $pokemon->id,
            ]);
        }
    }

    private static function createStats(string $number): Stats
    {
        $config = require __DIR__ . "/../../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return new Stats(
                    $entry['hp'],
                    $entry['attack'],
                    $entry['defence'],
                    $entry['spAttack'],
                    $entry['spDefence'],
                    $entry['speed'],
                );
            }
        }

        throw new Exception;
    }
}
