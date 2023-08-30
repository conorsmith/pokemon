<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLeagueChampionsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `league_champions` (
              `instance_id` VARCHAR(36) NOT NULL,
              `region` varchar(45) NOT NULL,
              `trainer_id` VARCHAR(36) NULL,
              `updated_at` DATETIME NOT NULL,
              PRIMARY KEY (`region`, `instance_id`));
        ");
    }
}
