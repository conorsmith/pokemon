<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddInstanceIdColumnToTrainerBattlePokemonTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `trainer_battle_pokemon` 
                ADD COLUMN `instance_id` VARCHAR(36) NOT NULL AFTER `id`
        ");
    }
}
