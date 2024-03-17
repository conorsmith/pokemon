<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\ObtainedGiftPokemon;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\ObtainedGiftPokemonRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class ObtainedGiftPokemonRepositoryDb implements ObtainedGiftPokemonRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function findMostRecent(string $giftPokemonId): ?ObtainedGiftPokemon
    {
        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM obtained_gift_pokemon
            WHERE instance_id = :instanceId
                AND gift_pokemon_id = :giftPokemonId
            ORDER BY obtained_at DESC
            ", [
                'instanceId' => $this->instanceId->value,
                'giftPokemonId' => $giftPokemonId,
            ]
        );

        if (count($rows) === 0) {
            return null;
        }

        $row = $rows[0];

        return new ObtainedGiftPokemon(
            $row['id'],
            $row['gift_pokemon_id'],
            $row['pokedex_number'],
            $row['location_id'],
            CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['obtained_at'], "Europe/Dublin"),
        );
    }

    public function save(ObtainedGiftPokemon $obtainedGiftPokemon): void
    {
        $this->db->insert("obtained_gift_pokemon", [
            'id'              => $obtainedGiftPokemon->id,
            'instance_id'     => $this->instanceId->value,
            'gift_pokemon_id' => $obtainedGiftPokemon->giftPokemonId,
            'location_id'     => $obtainedGiftPokemon->locationId,
            'pokedex_number'  => $obtainedGiftPokemon->pokedexNumber,
            'obtained_at'     => $obtainedGiftPokemon->obtainedAt->format("Y-m-d H:i:s"),
        ]);
    }
}
