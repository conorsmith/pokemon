<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCaughtPokemonTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `caught_pokemon` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `pokemon_id` varchar(4) NOT NULL,
              `form` varchar(255) DEFAULT NULL,
              `is_shiny` tinyint NOT NULL,
              `iv_physical_attack` int NOT NULL,
              `iv_physical_defence` int NOT NULL,
              `iv_special_attack` int NOT NULL,
              `iv_special_defence` int NOT NULL,
              `iv_speed` int NOT NULL,
              `iv_hp` int NOT NULL,
              `ev_physical_attack` int NOT NULL,
              `ev_physical_defence` int NOT NULL,
              `ev_special_attack` int NOT NULL,
              `ev_special_defence` int NOT NULL,
              `ev_speed` int NOT NULL,
              `ev_hp` int NOT NULL,
              `level` int NOT NULL,
              `team_position` int DEFAULT NULL,
              `location` varchar(45) NOT NULL,
              `remaining_hp` int DEFAULT NULL,
              `has_fainted` tinyint NOT NULL,
              `location_caught` varchar(36) NOT NULL,
              `date_caught` datetime NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
