<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;
use Doctrine\DBAL\Connection;

final class PostEncounterRun
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function __invoke(): void
    {
        $id = substr(substr($_SERVER['REQUEST_URI'], strlen("/encounter/")), 0, -strlen("/run"));

        $this->db->delete("encounters", [
            'instance_id' => INSTANCE_ID,
            'id' => $id,
        ]);

        header("Location: /map");
    }
}
