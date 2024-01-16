<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddIsPlayerChallengerColumnToTrainerBattlesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `trainer_battles` 
                ADD COLUMN `is_player_challenger` TINYINT NOT NULL AFTER `is_battling`
        ");
    }
}
