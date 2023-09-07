<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateInstancesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `instances` (
              `id` varchar(36) NOT NULL,
              `current_location` varchar(36) NOT NULL,
              `money` int NOT NULL,
              `unused_level_ups` int NOT NULL,
              `unused_moves` int NOT NULL,
              `unused_encounters` int NOT NULL,
              `badges` json NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
