<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

final class PostLogExercise
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function __invoke(): void
    {
        if ($_POST['date'] === "") {
            header("Location: /log/exercise");
            exit;
        }

        $submittedDate = CarbonImmutable::createFromFormat("Y-m-d", $_POST['date']);

        if ($submittedDate->isFuture()) {
            header("Location: /log/exercise");
            exit;
        }

        $this->db->beginTransaction();

        $this->db->insert("log_exercise", [
            'id' => Uuid::uuid4(),
            'instance_id' => INSTANCE_ID,
            'date_logged' => $submittedDate->format("Y-m-d") . " 12:00:00",
        ]);

        $row = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $this->db->update("instances", [
            'unused_encounters' => $row['unused_encounters'] + 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->commit();

        header("Location: /map/encounter");
        exit;
    }
}
