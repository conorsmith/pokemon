<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class DropColumnsFromObtainedGiftPokemonTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `obtained_gift_pokemon` 
                DROP COLUMN `pokedex_number`,
                DROP COLUMN `location_id`
        ");
    }
}
