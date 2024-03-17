<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddStartedAtColumnToInstancesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `instances` 
                ADD COLUMN `started_at` DATETIME NULL AFTER `id`
        ");
    }
}
