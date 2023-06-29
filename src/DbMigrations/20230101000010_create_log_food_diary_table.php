<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLogFoodDiaryTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            CREATE TABLE `log_food_diary` (
              `id` varchar(36) NOT NULL,
              `instance_id` varchar(36) NOT NULL,
              `date_logged` datetime NOT NULL,
              PRIMARY KEY (`id`)
            )
        ");
    }
}
