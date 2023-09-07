<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTrainerBattlesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `trainer_battles` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `trainer_id` varchar(36) NOT NULL,
              `is_battling` tinyint NOT NULL,
              `date_last_beaten` datetime DEFAULT NULL,
              `battle_count` int NOT NULL,
              `active_pokemon` int NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
