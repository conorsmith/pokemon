<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\EntryType;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Domain\UnlimitedHabitLog;
use ConorSmith\Pokemon\Habit\Domain\UnlimitedHabitLogEntry;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

final class UnlimitedHabitLogRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function find(Habit $habit): UnlimitedHabitLog
    {
        if ($habit !== Habit::EXERCISE) {
            throw new Exception;
        }

        $rows = $this->db->fetchAllAssociative("SELECT * FROM log_exercise WHERE instance_id = :instanceId ORDER BY date_logged DESC", [
            'instanceId' => $this->instanceId->value,
        ]);

        return new UnlimitedHabitLog(
            $habit,
            array_map(
                fn(array $row) => new UnlimitedHabitLogEntry(
                    Uuid::fromString($row['id']),
                    CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['date_logged'], "Europe/Dublin"),
                    EntryType::from($row['type']),
                ),
                $rows
            )
        );
    }

    public function save(UnlimitedHabitLog $savedHabitLog): void
    {
        if ($savedHabitLog->habit !== Habit::EXERCISE) {
            throw new Exception;
        }

        $existingHabitLog = $this->find($savedHabitLog->habit);

        $newEntries = $savedHabitLog->diff($existingHabitLog);

        /** @var UnlimitedHabitLogEntry $newEntry */
        foreach ($newEntries as $newEntry) {
            $this->db->insert(
                "log_exercise",
                [
                    'id'          => $newEntry->id->toString(),
                    'instance_id' => $this->instanceId->value,
                    'type'        => $newEntry->entryType->value,
                    'date_logged' => $newEntry->date->format("Y-m-d") . " 12:00:00",
                ]
            );
        }
    }
}
