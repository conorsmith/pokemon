<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Repositories;

use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Domain\WeeklyHabitLog;
use ConorSmith\Pokemon\Habit\Domain\WeeklyHabitLogEntry;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

final class WeeklyHabitLogRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function find(Habit $habit): WeeklyHabitLog
    {
        if ($habit !== Habit::CALORIE_EXCESS) {
            throw new Exception;
        }

        $instanceRow = $this->db->fetchAssociative("
            SELECT *
            FROM instances
            WHERE id = :instanceId
        ", [
            'instanceId' => $this->instanceId->value,
        ]);

        $logRows = $this->db->fetchAllAssociative("SELECT * FROM log_weekly_review WHERE instance_id = :instanceId ORDER BY date_logged DESC", [
            'instanceId' => $this->instanceId->value,
        ]);

        return new WeeklyHabitLog(
            $habit,
            array_map(
                fn(array $logRow) => new WeeklyHabitLogEntry(
                    Uuid::fromString($logRow['id']),
                    CarbonPeriod::between(
                        CarbonImmutable::createFromFormat("Y-m-d H:i:s", $logRow['date_logged'], new CarbonTimeZone("Europe/Dublin")),
                        CarbonImmutable::createFromFormat("Y-m-d H:i:s", $logRow['date_logged'], new CarbonTimeZone("Europe/Dublin"))->addDays(6),
                    ),
                    intval($logRow['total']),
                ),
                $logRows
            ),
            CarbonImmutable::createFromFormat(
                "Y-m-d H:i:s",
                $instanceRow['started_at'],
                "Europe/Dublin",
            ),
        );
    }

    public function save(WeeklyHabitLog $savedHabitLog): void
    {
        if ($savedHabitLog->habit !== Habit::CALORIE_EXCESS) {
            throw new Exception;
        }

        $existingHabitLog = $this->find($savedHabitLog->habit);

        $newEntries = $savedHabitLog->diff($existingHabitLog);

        /** @var WeeklyHabitLogEntry $newEntry */
        foreach ($newEntries as $newEntry) {
            $this->db->insert(
                "log_weekly_review",
                [
                    'id'          => $newEntry->id->toString(),
                    'instance_id' => $this->instanceId->value,
                    'date_logged' => $newEntry->week->first()->format("Y-m-d") . " 12:00:00",
                    'total'       => $newEntry->value,
                ]
            );
        }
    }
}
