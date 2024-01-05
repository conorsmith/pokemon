<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateNotificationsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `notifications` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `notified_at` DATETIME NOT NULL,
              `message` TEXT NOT NULL,
              `is_read` TINYINT NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
