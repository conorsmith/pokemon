<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddLocationIdColumnToLegendaryCapturesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `legendary_captures` 
                ADD COLUMN `location_id` VARCHAR(36) NOT NULL AFTER `instance_id`
        ");
    }
}
