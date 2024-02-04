<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Party\Domain\ObtainedGiftPokemon;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class ObtainedGiftPokemonRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function findMostRecent(string $pokedexNumber, string $locationId): ?ObtainedGiftPokemon
    {
        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM obtained_gift_pokemon
            WHERE instance_id = :instanceId
                AND location_id = :locationId
                AND pokedex_number = :pokedexNumber
            ORDER BY obtained_at DESC
            ", [
                'instanceId' => $this->instanceId->value,
                'locationId' => $locationId,
                'pokedexNumber' => $pokedexNumber,
            ]
        );

        if (count($rows) === 0) {
            return null;
        }

        $row = $rows[0];

        return new ObtainedGiftPokemon(
            $row['id'],
            $row['pokedex_number'],
            $row['location_id'],
            CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['obtained_at'], "Europe/Dublin"),
        );
    }

    public function save(ObtainedGiftPokemon $obtainedGiftPokemon): void
    {
        $this->db->insert("obtained_gift_pokemon", [
            'id'             => $obtainedGiftPokemon->id,
            'instance_id'    => $this->instanceId->value,
            'location_id'    => $obtainedGiftPokemon->locationId,
            'pokedex_number' => $obtainedGiftPokemon->pokedexNumber,
            'obtained_at'    => $obtainedGiftPokemon->obtainedAt->format("Y-m-d H:i:s"),
        ]);
    }
}