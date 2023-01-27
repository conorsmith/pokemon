<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostLogWeeklyReview
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
    ) {}

    public function __invoke(): void
    {
        $total = intval($_POST['total']);
        $weekOf = CarbonImmutable::createFromFormat("Y-m-d", $_POST['date']);

        if (!$weekOf->isMonday()) {
            $this->session->getFlashBag()->add("errors", "Given date must be a Monday.");
            header("Location: /log/weekly-review");
            return;
        }

        if ($weekOf->isFuture()) {
            $this->session->getFlashBag()->add("errors", "Given date cannot be in the future.");
            header("Location: /log/weekly-review");
            return;
        }

        $firstDay = $weekOf;
        $lastDay = $weekOf->addDays(6);

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $weeklyReviewRow = $this->db->fetchAssociative("SELECT * FROM log_weekly_review WHERE instance_id = :instanceId AND date_logged = :weekOf", [
            'instanceId' => INSTANCE_ID,
            'weekOf' => $weekOf->format("Y-m-d 00:00:00"),
        ]);

        if ($weeklyReviewRow !== false) {
            $formattedDate = $weekOf->format("Y-m-d");
            $this->session->getFlashBag()->add("errors", "Week of '{$formattedDate}' has already been logged");
            header("Location: /log/weekly-review");
            return;
        }

        $foodDiaryRows = $this->db->fetchAllAssociative("SELECT * FROM log_food_diary WHERE instance_id = :instanceId AND date_logged >= :firstDay AND date_logged <= :lastDay", [
            'instanceId' => INSTANCE_ID,
            'firstDay' => $firstDay->format("Y-m-d 12:00:00"),
            'lastDay' => $lastDay->format("Y-m-d 12:00:00"),
        ]);

        $calorieGoalRows = $this->db->fetchAllAssociative("SELECT * FROM log_calorie_goal WHERE instance_id = :instanceId AND date_logged >= :firstDay AND date_logged <= :lastDay", [
            'instanceId' => INSTANCE_ID,
            'firstDay' => $firstDay->format("Y-m-d 12:00:00"),
            'lastDay' => $lastDay->format("Y-m-d 12:00:00"),
        ]);

        $grossBonus = count($foodDiaryRows) + count($calorieGoalRows);

        $penalty = ceil($total / 500);

        $netBonus = max(0, $grossBonus - $penalty);

        $unusedLevelUps = $instanceRow['unused_level_ups'] + $netBonus;

        $this->db->beginTransaction();

        $this->db->insert("log_weekly_review", [
            'id' => Uuid::uuid4(),
            'instance_id' => INSTANCE_ID,
            'date_logged' => $weekOf->format("Y-m-d 00:00:00"),
            'total' => $total,
        ]);

        $this->db->update("instances", [
            'unused_level_ups' => $unusedLevelUps,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "You earned {$netBonus} Rare Candy!");

        header("Location: /");
    }
}
