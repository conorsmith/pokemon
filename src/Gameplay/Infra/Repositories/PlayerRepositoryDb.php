<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\HeldItem;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Player;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Stats;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\StatsIv;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Exception;
use RuntimeException;
use WeakMap;

final class PlayerRepositoryDb implements PlayerRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly PokemonRepository $pokemonRepository,
        private readonly array $pokedex,
        private readonly ItemConfigRepository $itemConfigRepository,
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

        $party = $this->pokemonRepository->getParty();

        $partyMembersByPokemonId = [];

        /** @var \ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon $partyMember */
        foreach ($party->members as $partyMember) {
            $partyMembersByPokemonId[$partyMember->id] = $partyMember;
        }

        $party = [];

        foreach ($caughtPokemonRows as $caughtPokemonRow) {
            $partyMember = $partyMembersByPokemonId[$caughtPokemonRow['id']];

            $heldItem = null;

            if (!is_null($caughtPokemonRow['held_item_id'])) {
                $heldItemConfig = $this->itemConfigRepository->find($caughtPokemonRow['held_item_id']);
                $heldItem = new HeldItem(
                    $caughtPokemonRow['held_item_id'],
                    $heldItemConfig['effect']['typeEnhance'] ?? null,
                );
            }

            $pokedexEntry = $this->findPokedexEntry($caughtPokemonRow['pokemon_id']);
            $party[] = new Pokemon(
                $caughtPokemonRow['id'],
                $caughtPokemonRow['pokemon_id'],
                $caughtPokemonRow['form'],
                $pokedexEntry['type'][0],
                $pokedexEntry['type'][1] ?? null,
                $caughtPokemonRow['level'],
                $partyMember->friendship,
                match ($caughtPokemonRow['sex']) {
                    "F"     => Sex::FEMALE,
                    "M"     => Sex::MALE,
                    "U"     => Sex::UNKNOWN,
                    default => new RuntimeException(),
                },
                $caughtPokemonRow['is_shiny'] === 1,
                new Stats(
                    $caughtPokemonRow['level'],
                    $partyMember->hp->baseValue,
                    $partyMember->physicalAttack->baseValue,
                    $partyMember->physicalDefence->baseValue,
                    $partyMember->specialAttack->baseValue,
                    $partyMember->specialDefence->baseValue,
                    $partyMember->speed->baseValue,
                    new StatsIv(
                        $partyMember->hp->iv,
                        $partyMember->physicalAttack->iv,
                        $partyMember->physicalDefence->iv,
                        $partyMember->specialAttack->iv,
                        $partyMember->specialDefence->iv,
                        $partyMember->speed->iv,
                    ),
                    $partyMember->hp->ev,
                    $partyMember->physicalAttack->ev,
                    $partyMember->physicalDefence->ev,
                    $partyMember->specialAttack->ev,
                    $partyMember->specialDefence->ev,
                    $partyMember->speed->ev,
                ),
                $caughtPokemonRow['remaining_hp'] ?? 0,
                $caughtPokemonRow['has_fainted'] === 1,
                $heldItem,
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
