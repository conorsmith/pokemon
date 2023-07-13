<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ModifyParentColumnsInEggsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `eggs` 
                DROP COLUMN `second_parent_sex`,
                DROP COLUMN `second_parent_pokedex_number`,
                DROP COLUMN `first_parent_sex`,
                DROP COLUMN `first_parent_pokedex_number`,
                ADD COLUMN `first_parent_id` VARCHAR(36) NOT NULL AFTER `iv_speed`,
                ADD COLUMN `second_parent_id` VARCHAR(36) NOT NULL AFTER `first_parent_id`
        ");
    }
}
