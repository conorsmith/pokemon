<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Domain\DailyHabitLog;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class DailyHabitLogRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function find(Habit $habit): DailyHabitLog
    {
        $rows = $this->db->createQueryBuilder()
            ->select("*")
            ->from(match ($habit) {
                Habit::FOOD_DIARY_COMPLETED => "log_food_diary",
                Habit::CALORIE_GOAL_ATTAINED => "log_calorie_goal",
                Habit::STRETCHES_COMPLETED => "log_stretches",
            })
            ->where("instance_id = :instanceId")
            ->setParameter('instanceId', $this->instanceId->value)
            ->orderBy("date_logged", "DESC")
            ->executeQuery()
            ->fetchAllAssociative();

        return new DailyHabitLog(
            $habit,
            array_map(
                fn(array $row) => CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['date_logged']),
                $rows
            )
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
                    Habit::FOOD_DIARY_COMPLETED => "log_food_diary",
                    Habit::CALORIE_GOAL_ATTAINED => "log_calorie_goal",
                    Habit::STRETCHES_COMPLETED => "log_stretches",
                },
                [
                    'id' => Uuid::uuid4(),
                    'instance_id' => $this->instanceId->value,
                    'date_logged' => $newDate->format("Y-m-d") . " 12:00:00",
                ]
            );
        }
    }
}
