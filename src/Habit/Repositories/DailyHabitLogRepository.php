<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\DailyHabitLog;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use LogicException;
use Ramsey\Uuid\Uuid;

final class DailyHabitLogRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function find(Habit $habit): DailyHabitLog
    {
        $instanceRow = $this->db->fetchAssociative("
            SELECT *
            FROM instances
            WHERE id = :instanceId
        ", [
            'instanceId' => $this->instanceId->value,
        ]);

        $logRows = $this->db->createQueryBuilder()
            ->select("*")
            ->from(match ($habit) {
                Habit::FOOD_DIARY_COMPLETED  => "log_food_diary",
                Habit::CALORIE_GOAL_ATTAINED => "log_calorie_goal",
                Habit::STRETCHES_COMPLETED   => "log_stretches",
                default                      => throw new LogicException(),
            })
            ->where("instance_id = :instanceId")
            ->setParameter('instanceId', $this->instanceId->value)
            ->orderBy("date_logged", "DESC")
            ->executeQuery()
            ->fetchAllAssociative();

        return new DailyHabitLog(
            $habit,
            array_map(
                fn(array $logRow) => CarbonImmutable::createFromFormat("Y-m-d H:i:s", $logRow['date_logged'], "Europe/Dublin"),
                $logRows
            ),
            CarbonImmutable::createFromFormat(
                "Y-m-d H:i:s",
                $instanceRow['started_at'],
                "Europe/Dublin",
            ),
        );
    }

    public function save(DailyHabitLog $savedHabitLog): void
    {
        $existingHabitLog = $this->find($savedHabitLog->habit);

        $newDates = $savedHabitLog->diff($existingHabitLog);

        /** @var CarbonImmutable $newDate */
        foreach ($newDates as $newDate) {
            $this->db->insert(
                match ($savedHabitLog->habit) {
                    Habit::FOOD_DIARY_COMPLETED  => "log_food_diary",
                    Habit::CALORIE_GOAL_ATTAINED => "log_calorie_goal",
                    Habit::STRETCHES_COMPLETED   => "log_stretches",
                    default                      => throw new LogicException(),
                },
                [
                    'id'          => Uuid::uuid4(),
                    'instance_id' => $this->instanceId->value,
                    'date_logged' => $newDate->format("Y-m-d") . " 12:00:00",
                ]
            );
        }
    }
}
