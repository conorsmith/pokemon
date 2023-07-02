<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLogStretchesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `log_stretches` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `date_logged` datetime NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
