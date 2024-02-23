<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddInstanceIdColumnToFriendshipEventLogTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `friendship_event_log` 
                ADD COLUMN `instance_id` VARCHAR(36) NOT NULL AFTER `id`
        ");
    }
}
