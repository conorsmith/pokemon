<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class PostLogFoodDiary
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function __invoke(): void
    {
        if ($_POST['date'] === "") {
            header("Location: /log/food-diary");
            exit;
        }

        $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $_POST['date']);

        if ($submittedDate->isFuture()) {
            header("Location: /log/food-diary");
            exit;
        }

        $row = $this->db->fetchOne("SELECT * FROM log_food_diary WHERE instance_id = :instanceId AND date_logged = :dateLogged", [
            'instanceId' => INSTANCE_ID,
            'dateLogged' => $submittedDate->format("Y-m-d") . " 12:00:00",
        ]);

        if ($row !== false) {
            header("Location: /log/food-diary");
            exit;
        }

        $this->db->beginTransaction();

        $this->db->insert("log_food_diary", [
            'id' => Uuid::uuid4(),
            'instance_id' => INSTANCE_ID,
            'date_logged' => $submittedDate->format("Y-m-d") . " 12:00:00",
        ]);

        $row = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $this->db->update("instances", [
            'unused_level_ups' => $row['unused_level_ups'] + 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->commit();

        header("Location: /team/level-up");
        exit;
    }
}
