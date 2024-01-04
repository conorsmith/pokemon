<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateGeneratedTrainersTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `generated_trainers` (
              `id` varchar(36) NOT NULL,
              `name` varchar(45) NOT NULL,
              `class` varchar(36) NOT NULL,
              `gender` VARCHAR(1) NOT NULL,
              `location_id` varchar(36) NOT NULL,
              `party` JSON NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
