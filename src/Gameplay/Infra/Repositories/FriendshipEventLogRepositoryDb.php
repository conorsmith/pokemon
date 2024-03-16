<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipCalculator;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEvent;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class FriendshipEventLogRepositoryDb implements FriendshipEventLogRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function calculate(string $pokemonId, string $pokedexNumber): int
    {
        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM friendship_event_log
            WHERE instance_id = :instanceId
                AND pokemon_id = :pokemonId
            ORDER BY date_logged
        ", [
            'instanceId' => $this->instanceId->value,
            'pokemonId'  => $pokemonId,
        ]);

        $pokemonConfig = $this->pokedexConfigRepository->find($pokedexNumber);

        return FriendshipCalculator::calculate(
            $pokemonConfig,
            array_map(
                fn(array $row) => new FriendshipEvent(
                    $row['event'],
                    CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['date_logged'], "Europe/Dublin"),
                ),
                $rows,
            ),
        );
    }

    public function sentToBox(Pokemon $pokemon): void
    {
        $this->db->insert("friendship_event_log", [
            'id'          => Uuid::uuid4(),
            'instance_id' => $this->instanceId->value,
            'pokemon_id'  => $pokemon->id,
            'event'       => "sentToBox",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function sentToParty(Pokemon $pokemon): void
    {
        $this->db->insert("friendship_event_log", [
            'id'          => Uuid::uuid4(),
            'instance_id' => $this->instanceId->value,
            'pokemon_id'  => $pokemon->id,
            'event'       => "sentToTeam",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function sentToDayCare(Pokemon $pokemon): void
    {
        $this->db->insert("friendship_event_log", [
            'id'          => Uuid::uuid4(),
            'instance_id' => $this->instanceId->value,
            'pokemon_id'  => $pokemon->id,
            'event'       => "sentToDayCare",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function levelUp(Pokemon $pokemon): void
    {
        $this->db->insert("friendship_event_log", [
            'id'          => Uuid::uuid4(),
            'instance_id' => $this->instanceId->value,
            'pokemon_id'  => $pokemon->id,
            'event'       => "levelUp",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function fainted(string $pokemonId): void
    {
        $this->db->insert("friendship_event_log", [
            'id'          => Uuid::uuid4(),
            'instance_id' => $this->instanceId->value,
            'pokemon_id'  => $pokemonId,
            'event'       => "fainted",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function faintedToPowerfulOpponent(string $pokemonId): void
    {
        $this->db->insert("friendship_event_log", [
            'id'          => Uuid::uuid4(),
            'instance_id' => $this->instanceId->value,
            'pokemon_id'  => $pokemonId,
            'event'       => "faintedToPowerfulOpponent",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }

    public function battleWithGymLeader(string $pokemonId): void
    {
        $this->db->insert("friendship_event_log", [
            'id'          => Uuid::uuid4(),
            'instance_id' => $this->instanceId->value,
            'pokemon_id'  => $pokemonId,
            'event'       => "battleWithGymLeader",
            'date_logged' => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }
}
