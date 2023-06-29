<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateEliteFourChallengesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `elite_four_challenges` (
              `id` varchar(36) NOT NULL,
              `region` varchar(45) NOT NULL,
              `team` json NOT NULL,
              `stage` int NOT NULL,
              `victory` tinyint NOT NULL,
              `date_started` datetime NOT NULL,
              `date_completed` datetime DEFAULT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
