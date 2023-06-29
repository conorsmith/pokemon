<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLegendaryCapturesTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `legendary_captures` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `pokemon_id` varchar(4) NOT NULL,
              `date_caught` datetime NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
