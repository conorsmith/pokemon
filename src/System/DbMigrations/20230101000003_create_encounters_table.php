<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateEncountersTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `encounters` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `pokemon_id` varchar(4) NOT NULL,
              `form` varchar(255) DEFAULT NULL,
              `level` int NOT NULL,
              `is_shiny` tinyint NOT NULL,
              `is_legendary` tinyint NOT NULL,
              `iv_physical_attack` int NOT NULL,
              `iv_physical_defence` int NOT NULL,
              `iv_special_attack` int NOT NULL,
              `iv_special_defence` int NOT NULL,
              `iv_speed` int NOT NULL,
              `iv_hp` int NOT NULL,
              `remaining_hp` int NOT NULL,
              `has_started` tinyint NOT NULL,
              `was_caught` tinyint NOT NULL,
              `strength_indicator_progress` int NOT NULL,
              `generated_at` datetime NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
