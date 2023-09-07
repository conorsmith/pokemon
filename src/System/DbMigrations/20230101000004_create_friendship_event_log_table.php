<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateFriendshipEventLogTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `friendship_event_log` (
              `id` varchar(36) NOT NULL,
              `pokemon_id` varchar(36) NOT NULL,
              `event` varchar(255) NOT NULL,
              `date_logged` datetime NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
