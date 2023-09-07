<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLogWeeklyReviewTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `log_weekly_review` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `date_logged` datetime NOT NULL,
              `total` int NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
