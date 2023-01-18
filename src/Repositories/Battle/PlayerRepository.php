<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Repositories\Battle;

use ConorSmith\Pokemon\Domain\Battle\Player;
use ConorSmith\Pokemon\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\GymBadge;
use Doctrine\DBAL\Connection;
use Exception;

final class PlayerRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly array $pokedex,
    ) {}

    public function findPlayer(): Player
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $caughtPokemonRows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position IS NOT NULL ORDER BY team_position", [
            'instanceId' => INSTANCE_ID,
        ]);

        $team = [];
        $teamIds = [];

        foreach ($caughtPokemonRows as $caughtPokemonRow) {
            $pokedexEntry = $this->findPokedexEntry($caughtPokemonRow['pokemon_id']);
            $team[] = new Pokemon(
                $caughtPokemonRow['pokemon_id'],
                $pokedexEntry['type'][0],
                $pokedexEntry['type'][1] ?? null,
                $caughtPokemonRow['level'],
                $caughtPokemonRow['has_fainted'] === 1,
            );
            $teamIds[] = $caughtPokemonRow['id'];
        }

        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($instanceRow['badges'])
        );

        return new Player($team, $teamIds, $gymBadges);
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
                'has_fainted' => $pokemon->hasFainted ? "1" : "0",
            ], [
                'id' => $player->teamIds[$i],
            ]);
        }
    }
}
