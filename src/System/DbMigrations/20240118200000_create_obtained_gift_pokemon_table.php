<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateObtainedGiftPokemonTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `obtained_gift_pokemon` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `pokedex_number` varchar(4) NOT NULL,
              `location_id` varchar(36) NOT NULL,
              `obtained_at` DATETIME NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
