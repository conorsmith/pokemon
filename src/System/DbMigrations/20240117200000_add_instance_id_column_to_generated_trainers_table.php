<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddInstanceIdColumnToGeneratedTrainersTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `generated_trainers` 
                ADD COLUMN `instance_id` varchar(36) NOT NULL AFTER `id`
        ");
    }
}
