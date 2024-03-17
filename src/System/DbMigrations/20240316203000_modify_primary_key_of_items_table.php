<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ModifyPrimaryKeyOfItemsTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `items` 
                DROP PRIMARY KEY,
                ADD PRIMARY KEY (`item_id`, `instance_id`);
        ");
    }
}
