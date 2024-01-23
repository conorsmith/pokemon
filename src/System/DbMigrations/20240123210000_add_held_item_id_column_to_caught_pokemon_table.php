<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddHeldItemIdColumnToCaughtPokemonTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `caught_pokemon` 
                ADD COLUMN `held_item_id` varchar(36) NULL AFTER `location`
        ");
    }
}
