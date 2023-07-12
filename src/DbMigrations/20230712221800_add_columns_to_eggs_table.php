<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddColumnsToEggsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `eggs` 
                ADD COLUMN `pokedex_number` VARCHAR(4) NOT NULL AFTER `instance_id`,
                ADD COLUMN `form` VARCHAR(255) NULL AFTER `pokedex_number`,
                ADD COLUMN `iv_hp` INT NOT NULL AFTER `form`,
                ADD COLUMN `iv_physical_attack` INT NOT NULL AFTER `iv_hp`,
                ADD COLUMN `iv_physical_defence` INT NOT NULL AFTER `iv_physical_attack`,
                ADD COLUMN `iv_special_attack` INT NOT NULL AFTER `iv_physical_defence`,
                ADD COLUMN `iv_special_defence` INT NOT NULL AFTER `iv_special_attack`,
                ADD COLUMN `iv_speed` INT NOT NULL AFTER `iv_special_defence`;
        ");
    }
}
