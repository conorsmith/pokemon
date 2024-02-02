<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Party\Domain\LegendaryCaptureEvent;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class LegendaryCaptureEventRepositoryDb
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function findForPokemonInReverseChronologicalOrder(string $pokedexNumber): array
    {
        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM legendary_captures
            WHERE instance_id = :instanceId
                AND pokemon_id = :pokedexNumber
            ORDER BY date_caught DESC
        ", [
            'instanceId'    => $this->instanceId->value,
            'pokedexNumber' => $pokedexNumber,
        ]);

        $events = [];

        /** @var array $row */
        foreach ($rows as $row) {
            $events[] = new LegendaryCaptureEvent(
                $row['id'],
                $row['pokemon_id'],
                CarbonImmutable::createFromFormat(
                    "Y-m-d H:i:s",
                    $row['date_caught'],
                    "Europe/Dublin",
                ),
            );
        }

        return $events;
    }
}
