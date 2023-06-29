<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTrainerBattlePokemonTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `trainer_battle_pokemon` (
              `id` varchar(36) NOT NULL,
              `trainer_battle_id` varchar(36) NOT NULL,
              `team_order` int NOT NULL,
              `pokemon_number` varchar(45) NOT NULL,
              `remaining_hp` int NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
