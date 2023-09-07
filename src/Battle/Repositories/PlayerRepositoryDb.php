<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Player;
use ConorSmith\Pokemon\Battle\Domain\PlayerRepository;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryParameters;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryProperty;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryResult;
use Doctrine\DBAL\Connection;
use Exception;
use RuntimeException;

final class PlayerRepositoryDb implements PlayerRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly CapturedPokemonQuery $capturedPokemonQuery,
        private readonly array $pokedex,
        private readonly InstanceId $instanceId,
    ) {}

    public function findPlayer(): Player
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $caughtPokemonRows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND location = 'team' ORDER BY party_position", [
            'instanceId' => $this->instanceId->value,
        ]);

        $party = [];

        $queryResults = $this->capturedPokemonQuery->run(CapturedPokemonQueryParameters::partyMembers([
            CapturedPokemonQueryProperty::FRIENDSHIP,
            CapturedPokemonQueryProperty::BASE_STATS,
            CapturedPokemonQueryProperty::IV_STATS,
            CapturedPokemonQueryProperty::EV_STATS,
        ]));

        $queryResultsByPokemonId = [];

        /** @var CapturedPokemonQueryResult $queryResult */
        foreach ($queryResults as $queryResult) {
            $queryResultsByPokemonId[$queryResult->id] = $queryResult;
        }

        foreach ($caughtPokemonRows as $caughtPokemonRow) {
            $queryResult = $queryResultsByPokemonId[$caughtPokemonRow['id']];

            $pokedexEntry = $this->findPokedexEntry($caughtPokemonRow['pokemon_id']);
            $party[] = new Pokemon(
                $caughtPokemonRow['id'],
                $caughtPokemonRow['pokemon_id'],
                $caughtPokemonRow['form'],
                $pokedexEntry['type'][0],
                $pokedexEntry['type'][1] ?? null,
                $caughtPokemonRow['level'],
                $queryResult->get(CapturedPokemonQueryProperty::FRIENDSHIP),
                match ($caughtPokemonRow['sex']) {
                    "F"     => Sex::FEMALE,
                    "M"     => Sex::MALE,
                    "U"     => Sex::UNKNOWN,
                    default => new RuntimeException(),
                },
                $caughtPokemonRow['is_shiny'] === 1,
                new Stats(
                    $caughtPokemonRow['level'],
                    $queryResult->get(CapturedPokemonQueryProperty::BASE_STATS)->hp,
                    $queryResult->get(CapturedPokemonQueryProperty::BASE_STATS)->physicalAttack,
                    $queryResult->get(CapturedPokemonQueryProperty::BASE_STATS)->physicalDefence,
                    $queryResult->get(CapturedPokemonQueryProperty::BASE_STATS)->specialAttack,
                    $queryResult->get(CapturedPokemonQueryProperty::BASE_STATS)->specialDefence,
                    $queryResult->get(CapturedPokemonQueryProperty::BASE_STATS)->speed,
                    $queryResult->get(CapturedPokemonQueryProperty::IV_STATS)->hp,
                    $queryResult->get(CapturedPokemonQueryProperty::IV_STATS)->physicalAttack,
                    $queryResult->get(CapturedPokemonQueryProperty::IV_STATS)->physicalDefence,
                    $queryResult->get(CapturedPokemonQueryProperty::IV_STATS)->specialAttack,
                    $queryResult->get(CapturedPokemonQueryProperty::IV_STATS)->specialDefence,
                    $queryResult->get(CapturedPokemonQueryProperty::IV_STATS)->speed,
                    $queryResult->get(CapturedPokemonQueryProperty::EV_STATS)->hp,
                    $queryResult->get(CapturedPokemonQueryProperty::EV_STATS)->physicalAttack,
                    $queryResult->get(CapturedPokemonQueryProperty::EV_STATS)->physicalDefence,
                    $queryResult->get(CapturedPokemonQueryProperty::EV_STATS)->specialAttack,
                    $queryResult->get(CapturedPokemonQueryProperty::EV_STATS)->specialDefence,
                    $queryResult->get(CapturedPokemonQueryProperty::EV_STATS)->speed,
                ),
                $caughtPokemonRow['remaining_hp'] ?? 0,
                $caughtPokemonRow['has_fainted'] === 1,
            );
        }

        $gymBadges = array_map(
            fn(int $value) => GymBadge::from($value),
            json_decode($instanceRow['badges']),
        );

        return new Player($party, $gymBadges, $instanceRow['active_battle_id']);
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
            'badges'           => json_encode($player->gymBadges),
            'active_battle_id' => $player->activeBattleId,
        ], [
            'id' => $this->instanceId->value,
        ]);

        /** @var Pokemon $pokemon */
        foreach ($player->party as $i => $pokemon) {
            $this->db->update("caught_pokemon", [
                'party_position' => $i + 1,
                'remaining_hp'   => $pokemon->remainingHp,
                'has_fainted'    => $pokemon->hasFainted ? "1" : "0",
            ], [
                'id' => $pokemon->id,
            ]);
        }
    }
}
