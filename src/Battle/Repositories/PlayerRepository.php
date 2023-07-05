<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Player;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\TeamPokemonQuery;
use Doctrine\DBAL\Connection;
use Exception;

final class PlayerRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly TeamPokemonQuery $teamPokemonQuery,
        private readonly array $pokedex,
        private readonly InstanceId $instanceId,
    ) {}

    public function findPlayer(): Player
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $caughtPokemonRows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND location = 'team' ORDER BY team_position", [
            'instanceId' => $this->instanceId->value,
        ]);

        $team = [];

        foreach ($caughtPokemonRows as $caughtPokemonRow) {
            $teamPokemon = $this->teamPokemonQuery->run($caughtPokemonRow['id']);
            $pokedexEntry = $this->findPokedexEntry($caughtPokemonRow['pokemon_id']);
            $team[] = new Pokemon(
                $caughtPokemonRow['id'],
                $caughtPokemonRow['pokemon_id'],
                $caughtPokemonRow['form'],
                $pokedexEntry['type'][0],
                $pokedexEntry['type'][1] ?? null,
                $caughtPokemonRow['level'],
                $teamPokemon->friendship,
                Sex::UNKNOWN,
                $caughtPokemonRow['is_shiny'] === 1,
                new Stats(
                    $caughtPokemonRow['level'],
                    $teamPokemon->baseHp,
                    $teamPokemon->basePhysicalAttack,
                    $teamPokemon->basePhysicalDefence,
                    $teamPokemon->baseSpecialAttack,
                    $teamPokemon->baseSpecialDefence,
                    $teamPokemon->baseSpeed,
                    $teamPokemon->ivHp,
                    $teamPokemon->ivPhysicalAttack,
                    $teamPokemon->ivPhysicalDefence,
                    $teamPokemon->ivSpecialAttack,
                    $teamPokemon->ivSpecialDefence,
                    $teamPokemon->ivSpeed,
                    $teamPokemon->evHp,
                    $teamPokemon->evPhysicalAttack,
                    $teamPokemon->evPhysicalDefence,
                    $teamPokemon->evSpecialAttack,
                    $teamPokemon->evSpecialDefence,
                    $teamPokemon->evSpeed,
                ),
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
            'id' => $this->instanceId->value,
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
}
