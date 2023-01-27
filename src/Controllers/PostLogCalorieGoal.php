<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostLogCalorieGoal
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
    ) {}

    public function __invoke(): void
    {
        if ($_POST['date'] === "") {
            $this->session->getFlashBag()->add("errors", "Given date is empty.");
            header("Location: /log/calorie-goal");
            exit;
        }

        $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $_POST['date']);

        if ($submittedDate->isFuture()) {
            $this->session->getFlashBag()->add("errors", "Given date is in the future.");
            header("Location: /log/calorie-goal");
            exit;
        }

        $row = $this->db->fetchOne("SELECT * FROM log_calorie_goal WHERE instance_id = :instanceId AND date_logged = :dateLogged", [
            'instanceId' => INSTANCE_ID,
            'dateLogged' => $submittedDate->format("Y-m-d") . " 12:00:00",
        ]);

        if ($row !== false) {
            $formattedDate = $submittedDate->format("Y-m-d");
            $this->session->getFlashBag()->add("errors", "Date '{$formattedDate}' has already been logged");
            header("Location: /log/calorie-goal");
            exit;
        }

        $this->db->beginTransaction();

        $this->db->insert("log_calorie_goal", [
            'id' => Uuid::uuid4(),
            'instance_id' => INSTANCE_ID,
            'date_logged' => $submittedDate->format("Y-m-d") . " 12:00:00",
        ]);

        $row = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $this->db->update("instances", [
            'unused_moves' => $row['unused_moves'] + 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->commit();

        $this->session->getFlashBag()->add("successes", "You earned 1 Challenge Token!");

        header("Location: /");
        exit;
    }
}
