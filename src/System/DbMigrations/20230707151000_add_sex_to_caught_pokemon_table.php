<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddSexToCaughtPokemonTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `caught_pokemon` 
                ADD COLUMN `sex` VARCHAR(1) NOT NULL AFTER `form`;
        ");
    }
}
