<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateEggsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `eggs` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `first_parent_pokedex_number` varchar(4) NOT NULL,
              `first_parent_sex` varchar(1) NOT NULL,
              `second_parent_pokedex_number` varchar(4) NOT NULL,
              `second_parent_sex` varchar(1) NOT NULL,
              `remaining_cycles` int NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
