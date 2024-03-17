<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ModifyParentIdColumnsToBeNullableInEggsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `eggs` 
                CHANGE COLUMN `first_parent_id` `first_parent_id` VARCHAR(36) NULL,
                CHANGE COLUMN `second_parent_id` `second_parent_id` VARCHAR(36) NULL
        ");
    }
}
