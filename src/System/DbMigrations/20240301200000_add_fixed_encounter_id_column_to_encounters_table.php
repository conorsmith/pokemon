<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddFixedEncounterIdColumnToEncountersTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `encounters` 
                ADD COLUMN `fixed_encounter_id` VARCHAR(36) NULL AFTER `is_legendary`
        ");
    }
}
