<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddCumulativeTimeColumnToSurveysTable extends AbstractMigration
{
    public function up(): void
    {
        $this->execute("
            ALTER TABLE `surveys` 
                ADD COLUMN `cumulative_time` INT NOT NULL AFTER `started_at`
        ");
    }
}
