<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Domain\DailyHabitLog;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class DailyHabitLogRepository
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function find(Habit $habit): DailyHabitLog
    {
        $rows = $this->db->createQueryBuilder()
            ->select("*")
            ->from(match ($habit) {
                Habit::FOOD_DIARY_COMPLETED => "log_food_diary",
                Habit::CALORIE_GOAL_ATTAINED => "log_calorie_goal",
            })
            ->where("instance_id = :instanceId")
            ->setParameter('instanceId', INSTANCE_ID)
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
                },
                [
                    'id' => Uuid::uuid4(),
                    'instance_id' => INSTANCE_ID,
                    'date_logged' => $newDate->format("Y-m-d") . " 12:00:00",
                ]
            );
        }
    }
}
