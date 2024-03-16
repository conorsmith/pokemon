<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use Carbon\Carbon;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Evolution\EvolutionaryLineRepository;
use ConorSmith\Pokemon\Gameplay\Domain\GymBadgeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\CaughtLocation;
use ConorSmith\Pokemon\Gameplay\Domain\Party\DayCare;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggGroups;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Hp;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Party;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Stat;
use ConorSmith\Pokemon\Gameplay\Domain\PartyAssessment\Type;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Exception;
use LogicException;
use stdClass;

final class PokemonRepositoryDb implements PokemonRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly EvolutionaryLineRepository $evolutionaryLineRepository,
        private readonly FriendshipEventLogRepository $friendshipEventLogRepository,
        private readonly GymBadgeRepository $gymBadgeRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function find(string $id): ?Pokemon
    {
        $row = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => $this->instanceId->value,
            'id'         => $id,
        ]);

        if ($row === false) {
            return null;
        }

        return $this->createPokemonFromRow($row);
    }

    public function getParty(): Party
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND location = 'team' ORDER BY party_position", [
            'instanceId' => $this->instanceId->value,
        ]);

        return new Party(array_map(
            fn(array $row) => $this->createPokemonFromRow($row),
            $rows
        ));
    }

    public function getDayCare(): DayCare
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND location = 'dayCare' ORDER BY (pokemon_id * 1) ASC, level DESC", [
            'instanceId' => $this->instanceId->value,
        ]);

        $earnedGymBadges = $this->gymBadgeRepository->all();

        return new DayCare(
            array_map(
                fn(array $row) => $this->createPokemonFromRow($row),
                $rows
            ),
            count($earnedGymBadges),
        );
    }

    public function getBox(): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND location = 'box' ORDER BY (pokemon_id * 1) ASC, level DESC", [
            'instanceId' => $this->instanceId->value,
        ]);

        return array_map(
            fn(array $row) => $this->createPokemonFromRow($row),
            $rows
        );
    }

    public function getAll(stdClass $query): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId ORDER BY (pokemon_id * 1) ASC, level DESC", [
            'instanceId' => $this->instanceId->value,
        ]);

        $all = array_map(
            fn(array $row) => $this->createPokemonFromRow($row),
            $rows
        );

        /** @var Carbon[] $caughtAtMap */
        $caughtAtMap = [];

        foreach ($rows as $row) {
            $caughtAtMap[$row['id']] = new Carbon($row['date_caught']);
        }

        if (array_key_exists('type', $query->filter)) {
            $all = array_filter($all, function (Pokemon $pokemon) use ($query) {
                return $pokemon->type->primaryType == $query->filter['type']
                    || $pokemon->type->secondaryType == $query->filter['type'];
            });
        }

        if (array_key_exists('family', $query->filter)) {
            $all = array_filter($all, function (Pokemon $pokemon) use ($query) {
                return in_array(
                    $query->filter['family'],
                    $this->evolutionaryLineRepository->find($pokemon->number)
                        ->getPokedexNumbers(),
                );
            });
        }

        usort($all, function(Pokemon $a, Pokemon $b) use ($query, $caughtAtMap) {
            return match($query->sort) {
                "number" => 0,
                "time"   => $caughtAtMap[$a->id]->isBefore($caughtAtMap[$b->id]),
                "lv"     => $a->level > $b->level ? -1 : 1,
                "hp"     => match($query->show) {
                    "effective-stats" => $a->hp->calculate($a->level) > $b->hp->calculate($b->level) ? -1 : 1,
                    "base-stats"      => $a->hp->baseValue > $b->hp->baseValue ? -1 : 1,
                    "genetic-stats"   => $a->hp->iv > $b->hp->iv ? -1 : 1,
                    default           => throw new LogicException(),
                },
                "pa"     => match($query->show) {
                    "effective-stats" => $a->physicalAttack->calculate($a->level) > $b->physicalAttack->calculate($b->level) ? -1 : 1,
                    "base-stats"      => $a->physicalAttack->baseValue > $b->physicalAttack->baseValue ? -1 : 1,
                    "genetic-stats"   => $a->physicalAttack->iv > $b->physicalAttack->iv ? -1 : 1,
                    default           => throw new LogicException(),
                },
                "sa"     => match($query->show) {
                    "effective-stats" => $a->specialAttack->calculate($a->level) > $b->specialAttack->calculate($b->level) ? -1 : 1,
                    "base-stats"      => $a->specialAttack->baseValue > $b->specialAttack->baseValue ? -1 : 1,
                    "genetic-stats"   => $a->specialAttack->iv > $b->specialAttack->iv ? -1 : 1,
                    default           => throw new LogicException(),
                },
                "pd"     => match($query->show) {
                    "effective-stats" => $a->physicalDefence->calculate($a->level) > $b->physicalDefence->calculate($b->level) ? -1 : 1,
                    "base-stats"      => $a->physicalDefence->baseValue > $b->physicalDefence->baseValue ? -1 : 1,
                    "genetic-stats"   => $a->physicalDefence->iv > $b->physicalDefence->iv ? -1 : 1,
                    default           => throw new LogicException(),
                },
                "sd"     => match($query->show) {
                    "effective-stats" => $a->specialDefence->calculate($a->level) > $b->specialDefence->calculate($b->level) ? -1 : 1,
                    "base-stats"      => $a->specialDefence->baseValue > $b->specialDefence->baseValue ? -1 : 1,
                    "genetic-stats"   => $a->specialDefence->iv > $b->specialDefence->iv ? -1 : 1,
                    default           => throw new LogicException(),
                },
                "sp"     => match($query->show) {
                    "effective-stats" => $a->speed->calculate($a->level) > $b->speed->calculate($b->level) ? -1 : 1,
                    "base-stats"      => $a->speed->baseValue > $b->speed->baseValue ? -1 : 1,
                    "genetic-stats"   => $a->speed->iv > $b->speed->iv ? -1 : 1,
                    default           => throw new LogicException(),
                },
                default  => throw new LogicException(),
            };
        });

        return $all;
    }

    public function findAllInEggGroups(EggGroups $eggGroups): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId ORDER BY (pokemon_id * 1) ASC, level DESC", [
            'instanceId' => $this->instanceId->value,
        ]);

        $allCaughtPokemon = array_map(
            fn(array $row) => $this->createPokemonFromRow($row),
            $rows
        );

        return array_filter(
            $allCaughtPokemon,
            fn(Pokemon $pokemon) => $eggGroups->compatibleWith($pokemon->eggGroups)
        );
    }

    private function createPokemonFromRow(array $row): Pokemon
    {
        $baseStats = self::createBaseStats($row['pokemon_id']);
        $caughtLocationConfig = $this->locationConfigRepository->findLocation($row['location_caught']);
        $pokedexConfig = $this->pokedexConfigRepository->find($row['pokemon_id']);

        return new Pokemon(
            $row['id'],
            $row['pokemon_id'],
            $row['form'],
            new Type(
                $pokedexConfig['type'][0],
                $pokedexConfig['type'][1] ?? null,
            ),
            new EggGroups(
                $pokedexConfig['eggGroups'][0],
                $pokedexConfig['eggGroups'][1] ?? null,
            ),
            intval($row['level']),
            $this->friendshipEventLogRepository->calculate($row['id'], $row['pokemon_id']),
            match ($row['sex']) {
                "F"     => Sex::FEMALE,
                "M"     => Sex::MALE,
                "U"     => Sex::UNKNOWN,
                default => throw new LogicException(),
            },
            $row['is_shiny'] === 1,
            new Hp($baseStats['hp'], $row['iv_hp'], $row['ev_hp']),
            new Stat($baseStats['attack'], $row['iv_physical_attack'], $row['ev_physical_attack']),
            new Stat($baseStats['defence'], $row['iv_physical_defence'], $row['ev_physical_defence']),
            new Stat($baseStats['spAttack'], $row['iv_special_attack'], $row['ev_special_attack']),
            new Stat($baseStats['spDefence'], $row['iv_special_defence'], $row['ev_special_defence']),
            new Stat($baseStats['speed'], $row['iv_speed'], $row['ev_speed']),
            new CaughtLocation(
                $row['location_caught'],
                $caughtLocationConfig['region'],
            ),
            $row['held_item_id'],
        );
    }

    private static function createBaseStats(string $number): array
    {
        $config = require __DIR__ . "/../../../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return $entry;
            }
        }

        throw new Exception;
    }

    public function saveParty(Party $party): void
    {
        /**
         * @var int $position
         * @var Pokemon $pokemon
         */
        foreach ($party->members as $position => $pokemon) {
            $this->db->update("caught_pokemon", [
                'pokemon_id'     => $pokemon->number,
                'level'          => $pokemon->level,
                'party_position' => $position,
                'location'       => "team",
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
                'level'          => $pokemon->level,
                'party_position' => null,
                'location'       => "dayCare",
            ], [
                'id' => $pokemon->id,
            ]);
        }
    }

    public function savePokemon(Pokemon $pokemon): void
    {
        $this->db->update("caught_pokemon", [
            'party_position' => null,
            'location'       => "box",
        ], [
            'id' => $pokemon->id,
        ]);
    }

    public function save(Pokemon $pokemon): void
    {
        $this->db->update("caught_pokemon", [
            'pokemon_id'          => $pokemon->number,
            'form'                => $pokemon->form,
            'level'               => $pokemon->level,
            'ev_hp'               => $pokemon->hp->ev,
            'ev_physical_attack'  => $pokemon->physicalAttack->ev,
            'ev_physical_defence' => $pokemon->physicalDefence->ev,
            'ev_special_attack'   => $pokemon->specialAttack->ev,
            'ev_special_defence'  => $pokemon->specialDefence->ev,
            'ev_speed'            => $pokemon->speed->ev,
            'held_item_id'        => $pokemon->heldItemId,
        ], [
            'id' => $pokemon->id,
        ]);
    }
}
