<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Party\Domain\FixedEncounterCaptureEvent;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use LogicException;

final class FixedEncounterCaptureEventRepositoryDb
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function save(FixedEncounterCaptureEvent $legendaryCaptureEvent): void
    {
        $row = $this->db->fetchAssociative("
            SELECT *
            FROM legendary_captures
            WHERE instance_id = :instanceId
                AND id = :id
        ", [
            'instanceId' => $this->instanceId->value,
            'id'         => $legendaryCaptureEvent->id,
        ]);

        if ($row === false) {
            $this->db->insert("legendary_captures", [
                'id'          => $legendaryCaptureEvent->id,
                'instance_id' => $this->instanceId->value,
                'location_id' => $legendaryCaptureEvent->locationId,
                'pokemon_id'  => $legendaryCaptureEvent->pokedexNumber,
                'date_caught' => $legendaryCaptureEvent->capturedAt->format("Y-m-d H:i:s"),
            ]);
        } else {
            throw new LogicException("Legendary Capture Events are append only");
        }
    }

    public function findForPokemonInReverseChronologicalOrder(string $locationId, string $pokedexNumber): array
    {
        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM legendary_captures
            WHERE instance_id = :instanceId
                AND location_id = :locationId
                AND pokemon_id = :pokedexNumber
            ORDER BY date_caught DESC
        ", [
            'instanceId'    => $this->instanceId->value,
            'locationId'    => $locationId,
            'pokedexNumber' => $pokedexNumber,
        ]);

        $events = [];

        /** @var array $row */
        foreach ($rows as $row) {
            $events[] = new FixedEncounterCaptureEvent(
                $row['id'],
                $row['location_id'],
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
