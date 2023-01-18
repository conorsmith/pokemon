<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Repositories\Battle;

use ConorSmith\Pokemon\Domain\Battle\Player;
use ConorSmith\Pokemon\Domain\Battle\Pokemon;
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

        return new Player($team, $teamIds);
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
