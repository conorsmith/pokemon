<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePokedexEntriesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `pokedex_entries` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `number` int NOT NULL,
              `form` varchar(255) DEFAULT NULL,
              `date_added` datetime NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
