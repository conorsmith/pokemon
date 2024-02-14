<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateSurveysTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `surveys` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `location_id` varchar(36) NOT NULL,
              `encounter_type` varchar(16) NOT NULL,
              `in_progress` TINYINT NOT NULL,
              `started_at` DATETIME NOT NULL,
              `results` JSON NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
