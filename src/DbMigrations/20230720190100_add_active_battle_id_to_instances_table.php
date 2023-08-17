<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddActiveBattleIdToInstancesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `instances` 
                ADD COLUMN `active_battle_id` VARCHAR(36) NULL AFTER `badges`
        ");
    }
}
