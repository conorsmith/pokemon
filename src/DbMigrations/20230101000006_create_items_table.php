<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateItemsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `items` (
              `item_id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `quantity` int NOT NULL,
              PRIMARY KEY (`item_id`)
            )
        ");
    }
}
