<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddIsCompleteColumnToSurveysTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `surveys` 
                ADD COLUMN `is_complete` TINYINT NOT NULL AFTER `encounter_type`
        ");
    }
}
