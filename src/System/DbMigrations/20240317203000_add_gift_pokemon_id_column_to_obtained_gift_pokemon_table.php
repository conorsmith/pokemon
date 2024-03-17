<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddGiftPokemonIdColumnToObtainedGiftPokemonTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `obtained_gift_pokemon` 
                ADD COLUMN `gift_pokemon_id` VARCHAR(36) NOT NULL AFTER `instance_id`
        ");
    }
}
