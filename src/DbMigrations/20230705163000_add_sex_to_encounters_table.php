<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddSexToEncountersTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `encounters` 
                ADD COLUMN `sex` VARCHAR(1) NOT NULL AFTER `level`;
        ");
    }
}
