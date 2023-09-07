<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RenameTeamColumnsInTables extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `caught_pokemon` 
                CHANGE COLUMN `team_position` `party_position` INT NULL DEFAULT NULL ;
        ");

        $this->execute("
            ALTER TABLE `elite_four_challenges` 
                CHANGE COLUMN `team` `party` JSON NOT NULL
        ");

        $this->execute("
            ALTER TABLE `trainer_battle_pokemon` 
                CHANGE COLUMN `team_order` `party_order` INT NOT NULL
        ");
    }
}
